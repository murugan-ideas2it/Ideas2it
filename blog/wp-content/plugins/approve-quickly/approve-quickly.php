<?php 
/*
Plugin Name: Approve Quickly
Plugin URI: http://approvequickly.natko.com
Description: Approve, delete or mark as spam comments in <strong>AJAX from your admin bar</strong>. Also checks for new comments every minute and if you're idle every three minutes.
Author: Natko Hasić
Author URI: http://natko.com
Version: 1.2
*/

class ApproveQuickly{

	public $show_comments = 3;

	/////////////////////////////////////////////////////////////
	// Include all scripts and style
	/////////////////////////////////////////////////////////////

	function __construct() {

		// Include scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'appq_include_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'appq_include_scripts' ) );

		// Create the admin bar item
		add_action( 'admin_bar_menu', array( $this, 'appq_approve_quickly' ), 65);

		// AJAX actions
		add_action( 'wp_ajax_load_comments', array( $this, 'appq_load_comments' ) );
		add_action( 'wp_ajax_moderate_comment', array( $this, 'appq_moderate_comment' ) );
		add_action( 'wp_ajax_check_comments', array( $this, 'appq_check_comments' ) );
		add_action( 'wp_ajax_next_comment', array( $this, 'appq_next_comment' ) );

	}

	public function appq_include_scripts(){

		if(!current_user_can('moderate_comments')){
			return 0;
		}

		$show_admin_bar = get_user_meta( get_current_user_id(), 'show_admin_bar_front' );

		if(is_admin() || $show_admin_bar[0] == 'true'){
			wp_register_script('approve-quickly-script', plugins_url( '/script/approve-quickly.js', __FILE__ ), array('jquery') ); 
			wp_enqueue_script('approve-quickly-script');

			wp_localize_script( 'approve-quickly-script', 'appq_ajax', array( 
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'appq-nonce-check' ),
				)
			);

			wp_register_style('approve-quickly-style', plugins_url( '/style/approve-quickly.css', __FILE__ ), null, null, 'all' ); 
			wp_enqueue_style('approve-quickly-style');
		}

	}


	/////////////////////////////////////////////////////////////
	// Load first set of comments on hover, AJAX-ed
	/////////////////////////////////////////////////////////////

	public function appq_load_comments(){

		$show_comments = $this->show_comments;

		$args = array(
			'status' => 'hold',
			'number' => $show_comments,
		);

		$view_all = __('View all');

		$comments = get_comments($args);
		$count_new = get_comments( array( 'status' => 'hold', 'count' => true ) );
		$edit_comments_url = get_admin_url() . 'edit-comments.php';

		$comments_html = '<ul id="appq-comments-list">';

		foreach($comments as $comment){
			if ( current_user_can( 'edit_comment', $comment->comment_ID ) ){
				$comments_html .= '<li class="appq_single_comment comment-'. $comment->comment_ID. '">';
				$comments_html .= get_avatar($comment->comment_author_email, 80);
				$comments_html .= '<p class="appq_comment_author">';

				if($comment->comment_author_url){
					$comments_html .= sprintf( __( 'From %1$s on %2$s%3$s' ), '<a href="'.$comment->comment_author_url.'">' .$comment->comment_author. '</a>', '<a href="' . get_permalink($comment->comment_post_ID) . '">' . get_the_title($comment->comment_post_ID) . '</a>','');
				} else {
					$comments_html .= sprintf( __( 'From %1$s on %2$s%3$s' ), $comment->comment_author, '<a href="' . get_permalink($comment->comment_post_ID) . '">' . get_the_title($comment->comment_post_ID) . '</a>','');
				}

				$comments_html .= '</p><p class="appq_comment_content">' . $comment->comment_content . '</p>';
				$comments_html .= '<div class="appq_comment_panel">';
				$comments_html .= '<a href="" class="approve" rel="'.$comment->comment_ID.'"></a>';
				$comments_html .= '<a href="" class="trash" rel="'.$comment->comment_ID.'"></a>';
				$comments_html .= '<a href="" class="spam" rel="'.$comment->comment_ID.'"></a></div></li>';
			} else {

			}
		}

		$comments_html .= '</ul><div class="appq_comments_bottom"><a href="" class="approve_all">';

		if($count_new >= $show_comments){
			$max_approve = $show_comments;
			$comments_html .= __('Approve');
			$comments_html .= '<span> ('.$max_approve.' ';
			$comments_html .= _n('Comment', 'Comments', $count_new) . ')';
		} else if ($count_new == 1) {
			$comments_html .= __('Approve this comment');
		} else {
			$max_approve = $count_new;
			$comments_html .= __('Approve');
			$comments_html .= '<span> ('.$max_approve.' ';
			$comments_html .= _n('Comment', 'Comments', $count_new) . ')';
		}

		$comments_html .= '</span></a><a href="'. $edit_comments_url .'" class="view_all">'.$view_all.'</a></div>';

		echo json_encode(array('html'=>$comments_html, 'comments_left'=>$count_new));

		die();
	}


	/////////////////////////////////////////////////////////////
	// Function that handles comments moderation, AJAX-ed
	/////////////////////////////////////////////////////////////

	public function appq_moderate_comment(){

		check_ajax_referer( 'appq-nonce-check', 'security' );

		/////////////////////////////////////////////////////////////
		// If the nonce is valid then change comment status.
		/////////////////////////////////////////////////////////////

		$comment_ids = $_POST['comment_ids'];
		$comment_action = $_POST['comment_action'];

		if($comment_action == 'approve' || $comment_action == 'trash' || $comment_action == 'spam' && (int)$comment_ids == $comment_ids){

			$comment_unapproved_to_xy_hook = 'comment_unapproved_to_' . $comment_action;
			
			foreach ($comment_ids as $comment_id) {
				do_action($comment_unapproved_to_xy_hook);
				do_action('wp_set_comment_status');
				wp_set_comment_status($comment_id, $comment_action);
			}

		} else {

			echo json_encode(array('valid'=>false));

		}

		/////////////////////////////////////////////////////////////
		// Now check if there are any new comments to load...
		/////////////////////////////////////////////////////////////

		$count_new = get_comments( array( 'status' => 'hold', 'count' => true ) );
		$comments_moderated = count($comment_ids);
		$show_comments = $this->show_comments;

		$approve_all = '';

		if($count_new >= $show_comments){
			$max_approve = $show_comments;
			$approve_all .= __('Approve');
			$approve_all .= '<span> ('.$max_approve.' ';
			$approve_all .= _n('Comment', 'Comments', $count_new) . ')';
		} else if ($count_new == 1) {
			$approve_all .= __('Approve this comment');
		} else {
			$max_approve = $count_new;
			$approve_all .= __('Approve');
			$approve_all .= '<span> ('.$max_approve.' ';
			$approve_all .= _n('Comment', 'Comments', $count_new) . ')';
		}

		if($show_comments == $comments_moderated){
			$offset = 0;
		} else {
			$offset = $show_comments - 1;
		}

		$args = array(
			'status' => 'hold',
			'number' => $comments_moderated,
			'offset' => $offset
		);

		$comments = get_comments($args);

		$comments_html = '';

		foreach($comments as $comment){
			$comments_html .= '<li class="appq_single_comment appq_hidden comment-'. $comment->comment_ID. '">';
			$comments_html .= get_avatar($comment->comment_author_email, 80);

			if($comment->comment_author_url){
				$comments_html .= '<p class="appq_comment_author">From <a href="'.$comment->comment_author_url.'">' .$comment->comment_author. '</a> on <a href="' . get_permalink($comment->comment_post_ID) . '">' . get_the_title($comment->comment_post_ID) . '</a></p>';
			} else {
				$comments_html .= '<p class="appq_comment_author">From ' .$comment->comment_author. ' on <a href="' . get_permalink($comment->comment_post_ID) . '">' . get_the_title($comment->comment_post_ID) . '</a></p>';
			}

			$comments_html .= '<p class="appq_comment_content">' . $comment->comment_content . '</p>';
			$comments_html .= '<div class="appq_comment_panel">';
			$comments_html .= '<a href="" class="approve" rel="'.$comment->comment_ID.'"></a>';
			$comments_html .= '<a href="" class="trash" rel="'.$comment->comment_ID.'"></a>';
			$comments_html .= '<a href="" class="spam" rel="'.$comment->comment_ID.'"></a></div></li>';
		}

		echo json_encode(array('comments_left'=>$count_new, 'new_comment'=>$comments_html, 'approve_all'=>$approve_all, 'valid'=> true));

		die();
	}

	/////////////////////////////////////////////////////////////
	// Function that loads the next comment
	/////////////////////////////////////////////////////////////

	public function appq_next_comment(){
		$count_new = get_comments( array( 'status' => 'hold', 'count' => true ) ) - 1;
		$appq_from = __('From');

		$approve_all = '';
		$comments_html = '';

		$show_comments = $this->show_comments;
		$offset = $show_comments;

		if($count_new >= $show_comments){
			$max_approve = $show_comments;
			$approve_all .= __('Approve');
			$approve_all .= '<span> ('.$max_approve.' ';
			$approve_all .= _n('Comment', 'Comments', $count_new) . ')';
		} else if ($count_new == 1) {
			$approve_all .= __('Approve this comment');
		} else {
			$max_approve = $count_new;
			$approve_all .= __('Approve');
			$approve_all .= '<span> ('.$max_approve.' ';
			$approve_all .= _n('Comment', 'Comments', $count_new) . ')';
		}

		$args = array(
			'status' => 'hold',
			'number' => 1,
			'offset' => $offset
		);

		$comments = get_comments($args);

		foreach($comments as $comment){
			$comments_html .= '<li class="appq_single_comment appq_hidden comment-'. $comment->comment_ID. '">';
			$comments_html .= get_avatar($comment->comment_author_email, 80);


			if($comment->comment_author_url){
				$comments_html .= '<p class="appq_comment_author">'.$appq_from.' <a href="'.$comment->comment_author_url.'">' .$comment->comment_author. '</a> on <a href="' . get_permalink($comment->comment_post_ID) . '">' . get_the_title($comment->comment_post_ID) . '</a></p>';
			} else {
				$comments_html .= '<p class="appq_comment_author">'.$appq_from.' ' .$comment->comment_author. ' on <a href="' . get_permalink($comment->comment_post_ID) . '">' . get_the_title($comment->comment_post_ID) . '</a></p>';
			}

			$comments_html .= '<p class="appq_comment_content">' . $comment->comment_content . '</p>';
			$comments_html .= '<div class="appq_comment_panel">';
			$comments_html .= '<a href="" class="approve" rel="'.$comment->comment_ID.'"></a>';
			$comments_html .= '<a href="" class="trash" rel="'.$comment->comment_ID.'"></a>';
			$comments_html .= '<a href="" class="spam" rel="'.$comment->comment_ID.'"></a></div></li>';
		}

		echo json_encode(array('comments_left'=>$count_new, 'new_comment'=>$comments_html, 'approve_all'=>$approve_all));

		die();
	}

	/////////////////////////////////////////////////////////////
	// Function that checks the number of comments left
	/////////////////////////////////////////////////////////////

	public function appq_check_comments(){
		$count_new = get_comments( array( 'status' => 'hold', 'count' => true ) );
		echo json_encode(array('comments_left'=>$count_new));

		die();
	}

	/////////////////////////////////////////////////////////////
	// Main function, creates the admin bar node
	/////////////////////////////////////////////////////////////

	public function appq_approve_quickly( $wp_admin_bar ) {

		$count = get_comments( array( 'status' => 'hold', 'count' => true ) );
		$loading_comments = __('Loading...');

		if($count == 0){
			$count_html = '<span class="ab-icon"></span><span class="ab-label"></span>';
			$menupop = null;
		} else {
			$count_html = '<span class="ab-icon"></span><span class="ab-label">'.$count.'</span>';
			$menupop = 'menupop';
		}

		$edit_comments_url = get_admin_url() . 'edit-comments.php';

		$comments_html = '<div id="appq-comments-submenu"><p class="appq_loading">'.$loading_comments.'</p></div>';

		$args = array(
			'id' => 'approve-quickly',
			'title' => $count_html,
			'href' => $edit_comments_url,
			'meta' => array(
				'class' => $menupop .' appq-not-loaded',
				'html' => $comments_html
			)
		);

		$wp_admin_bar->remove_node('comments');
		$wp_admin_bar->add_node($args);
	}

}

new ApproveQuickly();

?>