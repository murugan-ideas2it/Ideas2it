<?php 

// This theme supports a variety of post formats.
add_theme_support( 'post-formats', array( 'status', 'image', 'gallery', 'video', 'quote', 'link' ) );

// This theme uses wp_nav_menu() in two locations.
register_nav_menu( 'header', __( 'Header Menu', 'persona' ) );
register_nav_menu( 'footer', __( 'Footer Menu', 'persona' ) );

// This theme supports custom background.
add_theme_support( 'custom-background' );

// This theme supports featured image.
add_theme_support( 'post-thumbnails' );

update_option('medium_size_w', 373);
update_option('medium_size_h', 250);
update_option('medium_crop', 1);

add_image_size( 'sidebar-thumbnail', 250 );
add_image_size( 'gallery-thumbnail', 135, 100, true );

// Remove automatic <p> from excerpt
remove_filter( 'the_excerpt', 'wpautop' );

// Set content width and automatic feed links
$persona_options = get_option('persona_theme_options');

if($persona_options['content_width'] == 'full-size' && $persona_options['show_sidebar'] == false){
	if (!isset( $content_width )) $content_width = 1170;
} else if ($persona_options['content_width'] == 'full-size' && $persona_options['show_sidebar'] == true){
	if (!isset( $content_width )) $content_width = 850;
} else if($persona_options['content_width'] == 'compact' && $persona_options['show_sidebar'] == true){
	if (!isset( $content_width )) $content_width = 620;
} else {
	if (!isset( $content_width )) $content_width = 900;
}

add_theme_support( 'automatic-feed-links' );

// Load textdomain
add_action('after_setup_theme', 'persona_setup');
function persona_setup(){
    load_theme_textdomain('persona', get_template_directory() . '/languages');
}

if ( is_singular() ) wp_enqueue_script( 'comment-reply' );


///////////////////////////////////////////////////////////////////////////////////////
// Persona JS and CSS includes
///////////////////////////////////////////////////////////////////////////////////////

function persona_actions(){
	add_action( 'wp_ajax_persona_add_comment', 'persona_add_comment' );
	add_action( 'wp_ajax_nopriv_persona_add_comment', 'persona_add_comment' );

	add_action( 'wp_ajax_persona_load_comments', 'persona_load_comments' );
	add_action( 'wp_ajax_nopriv_persona_load_comments', 'persona_load_comments' );

	add_action( 'wp_ajax_persona_trash_post', 'persona_trash_post' );
	add_action( 'wp_ajax_persona_untrash_post', 'persona_untrash_post' );
	add_action( 'wp_ajax_persona_update_post_title', 'persona_update_post_title' );
	
	if (current_user_can('publish_posts')){
		add_action( 'wp_ajax_persona_new_status_post', 'persona_new_status_post' );
	}

	if (current_user_can('edit_theme_options')){
		add_action( 'wp_ajax_persona_background_pattern', 'persona_background_pattern' );
	}
}

add_action( 'init', 'persona_actions' );


function persona_scripts(){

	///////////////////////////////////////////////////////////////////////////////////////
	// Frontend Scripts
	///////////////////////////////////////////////////////////////////////////////////////
    	
	if(!is_admin()){
		wp_enqueue_script( 'jquery' );

		if (current_user_can('edit_theme_options')){
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-sortable' );
		}

		wp_register_script( 'persona-imagesloaded', get_template_directory_uri() . '/script/jquery.imagesloaded.min.js' );
		wp_register_script( 'persona-flexslider', get_template_directory_uri() . '/script/jquery.flexslider-min.js' );
		wp_register_script( 'persona-scrollintoview', get_template_directory_uri() . '/script/jquery.scrollintoview.min.js' );
		wp_register_script( 'persona-script', get_template_directory_uri() . '/script/script.js' );

		wp_enqueue_script( 'persona-imagesloaded' );
		wp_enqueue_script( 'persona-flexslider' );
		wp_enqueue_script( 'persona-scrollintoview' );
		wp_enqueue_script( 'persona-script' );
	}

	///////////////////////////////////////////////////////////////////////////////////////
	// Inline Edit Scripts
	///////////////////////////////////////////////////////////////////////////////////////

	if (!is_admin() && current_user_can('edit_posts')){
		wp_register_script( 'persona-script-admin', get_template_directory_uri() . '/script/script-admin.js' );
		wp_enqueue_script( 'persona-script-admin' );
	}

	///////////////////////////////////////////////////////////////////////////////////////
	// Portfolio Scripts
	///////////////////////////////////////////////////////////////////////////////////////

	if ( is_page_template('template-portfolio.php') ) {
		wp_register_script( 'persona-easing', get_template_directory_uri() . '/script/jquery.easing.1.3.js' );
		wp_register_script( 'persona-quicksand', get_template_directory_uri() . '/script/jquery.quicksand.js' );
		wp_register_script( 'persona-portfolio', get_template_directory_uri() . '/script/script-portfolio.js' );

		wp_enqueue_script( 'persona-easing' );
		wp_enqueue_script( 'persona-quicksand' );
		wp_enqueue_script( 'persona-portfolio' );
	}

	wp_localize_script( 'persona-script', 'persona', array( 
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'persona-nonce-check' ),
		'themeurl' => get_template_directory_uri() .'/images/patterns/',
		)
	);

}

add_action( 'wp_enqueue_scripts', 'persona_scripts' );
add_action( 'admin_enqueue_scripts', 'persona_scripts' );


function persona_styles(){

	if(!is_admin()){
		wp_register_style( 'persona-sans-font', 'http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700' );
		wp_register_style( 'persona-style', get_stylesheet_uri() );

		wp_enqueue_style( 'persona-sans-font' );
		wp_enqueue_style( 'persona-style' );

		if (current_user_can( 'edit_posts' )){
			wp_register_style( 'persona-admin-style', get_template_directory_uri() . '/style/admin-style.css' );
			wp_enqueue_style( 'persona-admin-style' );
		}
	}

}

add_action( 'wp_enqueue_scripts', 'persona_styles' );
add_action( 'admin_head', 'persona_styles' );


///////////////////////////////////////////////////////////////////////////////////////
// Theme Customizer
///////////////////////////////////////////////////////////////////////////////////////

require_once('theme-options/customizer.php');


///////////////////////////////////////////////////////////////////////////////////////
// Unlimited Sidebars
///////////////////////////////////////////////////////////////////////////////////////

require_once('theme-options/unlimited-sidebars.php');


///////////////////////////////////////////////////////////////////////////////////////
// Ad Unit, Image, Portfolio and Social Widget
///////////////////////////////////////////////////////////////////////////////////////

require_once('theme-options/widget-ad-250.php');
require_once('theme-options/widget-image.php');
require_once('theme-options/widget-portfolio.php');
require_once('theme-options/widget-social.php');


///////////////////////////////////////////////////////////////////////////////////////
// Slider Manager
///////////////////////////////////////////////////////////////////////////////////////

require_once('theme-options/slider-manager.php');

///////////////////////////////////////////////////////////////////////////////////////
// Shortcodes
///////////////////////////////////////////////////////////////////////////////////////

require_once('theme-options/shortcodes.php');


///////////////////////////////////////////////////////////////////////////////////////
// Add 'submenu-parent' class to menu items
///////////////////////////////////////////////////////////////////////////////////////

function add_submenu_parent_class( $items ) {
	
	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'submenu-parent'; 
		}
	}
	
	return $items;    
}

add_filter( 'wp_nav_menu_objects', 'add_submenu_parent_class' );


///////////////////////////////////////////////////////////////////////////////////////
// Portfolio
///////////////////////////////////////////////////////////////////////////////////////

add_action('init', 'portfolio');

function portfolio() {

	$labels = array(
		'name' => _x('Portfolio', 'portfolio general name', 'persona'),
		'singular_name' => _x('Portfolio Item', 'portfolio singular name', 'persona'),
		'add_new' => _x('Add New', 'portfolio', 'persona'),
		'add_new_item' => __('Add New Portfolio Item', 'persona'),
		'edit_item' => __('Edit Portfolio Item', 'persona'),
		'new_item' => __('New Portfolio Item', 'persona'),
		'view_item' => __('View Portfolio Item', 'persona'),
		'search_items' => __('Search Portfolio', 'persona'),
		'not_found' =>  __('No items found', 'persona'),
		'not_found_in_trash' => __('No items found in Trash', 'persona'), 
		'parent_item_colon' => '',
		'menu_name' => __('Portfolio', 'persona')
	);

	$args = array(  
		'labels' => $labels,
		'public' => true,  
		'show_ui' => true,  
		'capability_type' => 'post',  
		'hierarchical' => false,  
		'rewrite' => true,  
		'taxonomies' => array('portfolio_category', 'post_tag'),
		'supports' => array('title', 'editor', 'thumbnail', 'comments', 'excerpt'),
		'rewrite' => array('slug' => '', 'with_front' => false)
	);  

	register_post_type('portfolio', $args);
}


///////////////////////////////////////////////////////////////////////////////////////
// Register Widgetized Areas
///////////////////////////////////////////////////////////////////////////////////////

if(current_user_can ('edit_theme_options') ){
	$widget_order_handler = '<a href="" class="widget-order-handle"></a>';
} else {
	$widget_order_handler = '';
}

register_sidebar(array(
	'name' => __( 'Main Sidebar', 'persona' ),
	'id' => 'sidebar-main',
	'description' => __( 'Widgets in this area will be shown in the main sidebar.', 'persona' ),
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">'.$widget_order_handler,
	'after_widget'  => '</aside>',
));


$unlimited_sidebars_options = get_option('unlimited_sidebars_settings'); 

if(isset($persona_options['show_sidebar'])){
	if($unlimited_sidebars_options && $persona_options['show_sidebar'] == true){
		foreach ($unlimited_sidebars_options as $sidebar_id => $sidebar_name) {
			register_sidebar(array(
				'name' => $sidebar_name['name'],
				'id' => $sidebar_id,
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">'.$widget_order_handler,
				'after_widget'  => '</aside>',
			));
		}
	}
}

register_sidebar(array(
	'name' => __( 'Footer Left', 'persona' ),
	'id' => 'footer-1',
	'description' => __( 'Widgets in this area will be shown on the left side of the footer.', 'persona' ),
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
));

register_sidebar(array(
	'name' => __( 'Footer Middle', 'persona' ),
	'id' => 'footer-2',
	'description' => __( 'Widgets in this area will be shown in the middle of the footer.', 'persona' ),
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
));

register_sidebar(array(
	'name' => __( 'Footer Right', 'persona' ),
	'id' => 'footer-3',
	'description' => __( 'Widgets in this area will be shown on the right side of the footer.', 'persona' ),
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
));



///////////////////////////////////////////////////////////////////////////////////////
// Add Sidebars Metabox
///////////////////////////////////////////////////////////////////////////////////////

if($persona_options['show_sidebar'] == true){

	add_action( 'add_meta_boxes', 'choose_sidebar_metabox_add' );

	function choose_sidebar_metabox_add(){
		add_meta_box( '_choose-sidebar', 'Sidebar', 'choose_sidebar_metabox', 'post', 'side' );
		add_meta_box( '_choose-sidebar', 'Sidebar', 'choose_sidebar_metabox', 'page', 'side' );
	}

	function choose_sidebar_metabox( $post ){

		$selected_value = get_post_meta( $post->ID, '_choose_sidebar', true );

		if(isset($selected_value) == false){
			$selected_value = 'sidebar-main';
		}

		$sidebars = $GLOBALS['wp_registered_sidebars'];
		unset($sidebars['footer-1'], $sidebars['footer-2'], $sidebars['footer-3']);

		wp_nonce_field( 'choose-sidebar-nonce', 'choose-sidebar-check' ); ?>

		<select name="choose_sidebar" id="choose_sidebar" style="width:100%;">

			<?php foreach ( $sidebars as $sidebar ) { ?>
				<option value="<?php echo $sidebar['id']; ?>" <?php selected( $selected_value, $sidebar['id'] ); ?> >
					<?php echo $sidebar['name']; ?>
				</option>
			<?php } ?>

			<option value="no-sidebar" <?php selected( $selected_value, 'no-sidebar' ); ?> >
				<?php echo __('&lt;no sidebar&gt;', 'persona'); ?>
			</option>
			
		</select>
	<?php }

	add_action( 'save_post', 'choose_sidebar_metabox_save' );

	function choose_sidebar_metabox_save($post_id){

		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
		if( !isset( $_POST['choose-sidebar-check'] ) || !wp_verify_nonce( $_POST['choose-sidebar-check'], 'choose-sidebar-nonce' ) ) return; 
		if( !current_user_can( 'edit_post', $post_id ) ) return;  

		if( isset( $_POST['choose_sidebar'] )){
			update_post_meta( $post_id, '_choose_sidebar', esc_attr( $_POST['choose_sidebar'] ) );  
		}

	}

}


///////////////////////////////////////////////////////////////////////////////////////
// Add Custom Background Metabox
///////////////////////////////////////////////////////////////////////////////////////

add_action( 'add_meta_boxes', 'custom_background_image_add' );

function custom_background_image_add(){
	add_meta_box( '_custom-background', 'Background Image', 'custom_background_image', 'post', 'side' );
	add_meta_box( '_custom-background', 'Background Image', 'custom_background_image', 'page', 'side' );
	add_meta_box( '_custom-background', 'Background Image', 'custom_background_image', 'portfolio', 'side' );

	wp_register_script( 'script-backend', get_template_directory_uri() . '/script/script-backend.js' );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'script-backend' );
}

function custom_background_image( $post ){

	$selected_image = get_post_meta( $post->ID, '_custom-background', true );

	if(isset($selected_image) == false){
		$selected_image = '';
	}

	wp_nonce_field( 'choose-background-nonce', 'choose-background-check' ); ?>

	<img src="<?php echo $selected_image; ?>" alt="" style="width: 100%" class="preview-background">
	<input type="hidden" name="custom-background-url" id="custom-background-url" value="<?php echo esc_attr($selected_image); ?>">
	<p class="hide-if-no-js">
		<?php if($selected_image == ''){ ?>
			<a href="" data-uploader_title="<?php echo __('Choose Background', 'persona'); ?>" data-uploader_button_text="<?php echo __('Set As Background', 'persona'); ?>" class="upload-image"><?php echo __('Select Background Image', 'persona'); ?></a>
			<a href="" class="remove-background-image" style="display:none;"><?php echo __('Remove Background Image', 'persona'); ?></a>
		<?php } else { ?>
			<a href="" style="display:none;" data-uploader_title="<?php echo __('Choose Background', 'persona'); ?>" data-uploader_button_text="<?php echo __('Set As Background', 'persona'); ?>" class="upload-image"><?php echo __('Select Background Image', 'persona'); ?></a>
			<a href="" class="remove-background-image"><?php echo __('Remove Background Image', 'persona'); ?></a>
		<?php } ?>
	</p>

<?php }

add_action( 'save_post', 'custom_background_image_save' );

function custom_background_image_save($post_id){

	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	//if( !isset( $_POST['choose-background-check'] ) || !wp_verify_nonce( $_POST['choose-background-check'], 'choose-background-nonce' ) ) return;
	if( !current_user_can( 'edit_post', $post_id ) ) return;

	if( isset( $_POST['custom-background-url'] )){
		update_post_meta( $post_id, '_custom-background', esc_attr( $_POST['custom-background-url'] ) );  
	}

}

///////////////////////////////////////////////////////////////////////////////////////
// Custom Post/Page Background
///////////////////////////////////////////////////////////////////////////////////////

function persona_custom_background(){

	if(is_singular()){

		$custom_background = get_post_meta( get_the_ID(), '_custom-background', true );

		if($custom_background != ''){ ?>
			<style type="text/css">
				body, body.custom-background{
					background-image: url('<?php echo $custom_background; ?>');
					background-size: cover;
				}

			</style>

		<?php }
	}
}

add_action('wp_head', 'persona_custom_background', 999);


///////////////////////////////////////////////////////////////////////////////////////
// Background Pattern AJAX
///////////////////////////////////////////////////////////////////////////////////////

function persona_background_pattern(){

	check_ajax_referer( 'persona-nonce-check', 'security' );

	$background_pattern = get_option('persona_theme_options');
	$background_pattern['background_pattern'] = $_POST['background_pattern'];

	$update_option = update_option('persona_theme_options', $background_pattern);

	if ( is_wp_error($update_option) ){
		$error = $update_option->get_error_message();
		echo json_encode(array( 'inserted' => false, 'errorInfo' => $error ));
	} else {
		$comment_html = '<li class="comment hidden">';
		echo json_encode(array( 'inserted' => true ));
	}

	die();

}

function persona_background_pattern_menu($wp_admin_bar){

	if(current_user_can( 'edit_theme_options' ) && !is_admin()){

		global $wp_admin_bar, $persona_patterns;

		$options = get_option('persona_theme_options');
		$current_pattern = $options['background_pattern'];

		$background_patterns_html = '<div class="ab-sub-wrapper"><div id="background-pattern-picker" class="ab-submenu"><ul>';
		foreach ($persona_patterns as $pattern => $value) {
			if($pattern == 'none'){ 
				$pattern_url = ''; 
			} else {
				$pattern_url = get_template_directory_uri().'/images/patterns/'.$pattern.'.png';
			}
			if($current_pattern == $pattern){
				$background_patterns_html .= '<li><a class="selected" href="" data-id="'.$pattern.'" data-location="'.$pattern_url.'" title="'.$value.'"></a></li>';
			} else {
				$background_patterns_html .= '<li><a href="" data-id="'.$pattern.'" data-location="'.$pattern_url.'" title="'.$value.'"></a></li>';
			}
		}
		$background_patterns_html .= '</ul>';
		$background_patterns_html .= '<div class="save-pattern disabled"><a href="" >';
		$background_patterns_html .= __('Save Changes', 'persona');
		$background_patterns_html .= '</a></div></div></div>';

		$args = array(
			'parent' => 'top-secondary',
			'id' => 'persona-background-pattern',
			'title' => '<span class="ab-icon"></span>',
			'meta' => array(
				'class' => 'menupop persona-background-pattern',
				'html'  => $background_patterns_html,
			)
		);

		wp_reset_postdata();
		global $post;

		if(is_singular()){
			$custom_background = get_post_meta( $post->ID, '_custom-background', true );
			if($custom_background == ''){ 
				$wp_admin_bar->add_node($args);
			}
		} else {
			$wp_admin_bar->add_node($args);
		}
	}
}

add_action('admin_bar_menu', 'persona_background_pattern_menu', 5);

///////////////////////////////////////////////////////////////////////////////////////
// List Comments
///////////////////////////////////////////////////////////////////////////////////////

function persona_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php comment_author_link(); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

		<?php echo get_avatar( $comment, 60 ); ?>

		<p class="author">
			<span><?php comment_author_link(); ?></span> &bull; 
			<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="post-date" title="comment permalink"><?php echo get_comment_date(); ?></a>
			<?php if ( '0' == $comment->comment_approved ) : ?>
				&bull; <a class="post-date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php _e( 'Your comment is awaiting moderation.', 'persona' ); ?></a>
			<?php endif; ?>
		</p>

		<div class="comment-text">
			<?php comment_text(); ?>
		</div>

	<?php
		break;
	endswitch; // end comment_type check
}

function persona_get_avatar_url($get_avatar){
	preg_match("/src='(.*?)'/i", $get_avatar, $matches);
	return $matches[1];
}

function count_parent_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	if($comment->comment_parent == 0){
		$GLOBALS['parent_comments_count']++;
	}
	return;
}

function count_parent_comments_end( $comment, $args, $depth ) {
	/* dummy function to get rid of invalid markup */
	return;
}


///////////////////////////////////////////////////////////////////////////////////////
//  Comment Form (optional)
///////////////////////////////////////////////////////////////////////////////////////

function persona_comment_form(){
	global $post;

	$fields =  array(
		'author' => '<input type="text" value="" name="author" class="author" placeholder="'. __('Your Name...', 'persona').'">',
		'email'  => '<input type="text" value="" name="email" class="email" placeholder="'. __('Your Email...', 'persona').'">',
		'url'    => '<input type="text" value="" name="url" class="url" placeholder="'. __('Webpage...', 'persona').'">',
	);

	$form_options = array(
		'fields' => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field' => '<textarea placeholder="Leave a comment ..." name="comment" class="comment-box"></textarea>',
		'comment_notes_before' => '<p>'. __('Comment moderation is enabled, no need to resubmit any comments posted.', 'persona') .'</p>',
		'must_log_in' => '',
		'logged_in_as' => '',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'id_form' => 'comment-form-' .$post->ID,
		'id_submit' => 'submit-' .$post->ID,
		'label_submit' => __( 'Reply' , 'persona'),
		'title_reply' => __( 'Reply' , 'persona'),
		'title_reply_to' => __( 'Leave a Reply to %s' , 'persona'),
		'cancel_reply_link' => __( 'Cancel reply' , 'persona'),
	);

	return $form_options;
}

add_filter('comment_form_defaults', 'persona_comment_form');


function persona_move_textarea( $input = array () ){
	static $textarea = '';

	if ( 'comment_form_defaults' === current_filter() ) {
		$textarea = $input['comment_field'];
		$input['comment_field'] = '';
		return $input;
	}

	print apply_filters( 'comment_form_field_comment', $textarea );
}

add_filter( 'comment_form_defaults', 'persona_move_textarea' );
add_action( 'comment_form_top', 'persona_move_textarea' );


///////////////////////////////////////////////////////////////////////////////////////
// Add Comment - AJAX
///////////////////////////////////////////////////////////////////////////////////////

function persona_add_comment(){

	check_ajax_referer( 'persona-nonce-check', 'security' );

	$time = current_time('mysql');
	$comment_author_email = $_POST['comment_author_email'];

	// If the user is logged in approve the comment and get the author ID
	$current_user = wp_get_current_user();

	if ( $current_user->exists() ){
		$comment_approved = 1;
		$comment_author_id = $current_user->ID;
	} else {
		$comment_approved = 0;
		$comment_author_id = 0;
	}

	$data = array(
		'comment_post_ID' => $_POST['comment_post_ID'],
		'comment_author' => $_POST['comment_author'],
		'comment_author_email' => $_POST['comment_author_email'],
		'comment_author_url' => $_POST['comment_author_url'],
		'comment_content' => $_POST['comment_content'],
		'comment_type' => '',
		'comment_parent' => 0,
		'comment_date' => $time,
		'comment_approved' => $comment_approved,
		'user_id' => $comment_author_id,
	);

	$insert_comment = wp_new_comment($data);

	if ( is_wp_error($insert_comment) ){

		$error = $insert_comment->get_error_message();
		echo json_encode(array( 'inserted' => false, 'errorInfo' => $error ));

	} else {

		// Set a comment cookie
		$comment = get_comment($insert_comment);
		$user = wp_get_current_user();
		wp_set_comment_cookies($comment, $user);

		// if pending
		//wp_notify_moderator($comment_ID);

		// Return the comment HTML
		$comment_html = '<li class="comment hidden">';
		$comment_html .= get_avatar( $comment_author_email, 60 );
		$comment_html .= '<p class="author">';
		$comment_html .=     '<span><a class="url" href="'.$_POST['comment_author_url'].'">'.$_POST['comment_author'].'</a></span> &bull; ';
		$comment_html .=     '<a href="#" class="post-date">'.get_comment_date( get_option('date_format'), $insert_comment ).'</a>';
		$comment_html .= '</p>';
		$comment_html .= '<div class="comment-text">';
		$comment_html .=     stripslashes($_POST['comment_content']);
		$comment_html .= '</div>';
		$comment_html .= '</li>';

		echo json_encode(array( 'inserted' => true, 'comment' => $comment_html ));
	}

	die();
}

///////////////////////////////////////////////////////////////////////////////////////
// Load Comments - AJAX
///////////////////////////////////////////////////////////////////////////////////////

function persona_load_comments(){

	check_ajax_referer( 'persona-nonce-check', 'security' );

	$post_id = $_POST['comment_post_ID'];

	$args = array(
		'post_id' => $post_id,
		'status'  => 'approve',
	);
	$comments = get_comments($args);

	wp_list_comments( array( 'callback' => 'persona_comment', 'reverse_top_level' => true, ), $comments );

	die();
}

///////////////////////////////////////////////////////////////////////////////////////
// Frontend Inline Edit
///////////////////////////////////////////////////////////////////////////////////////


function persona_trash_post(){

	check_ajax_referer( 'persona-nonce-check', 'security' );

	$post_id = $_POST['post_ID'];

	$trash = wp_trash_post($post_id);

	if ( is_wp_error($trash) ){

		$error = $trash->get_error_message();
		echo json_encode(array( 'trashed' => false, 'errorInfo' => $error ));

	} else {

		$info_html = '<div class="undo-trashed"><p>';
		$info_html .= __('Post has been trashed, to undo it click the admin icon again.', 'persona');
		$info_html .= '</p></div>';

		echo json_encode(array( 'trashed' => true, 'info' => $info_html, 'untrash' => __('Untrash post', 'persona') ));
	}

	die();
}

function persona_untrash_post(){

	check_ajax_referer( 'persona-nonce-check', 'security' );

	$post_id = $_POST['post_ID'];

	$untrash = wp_untrash_post($post_id);

	if ( is_wp_error($untrash) ){

		$error = $untrash->get_error_message();
		echo json_encode(array( 'untrashed' => false, 'errorInfo' => $error ));

	} else {

		echo json_encode(array( 'untrashed' => true ));
	}

	die();
}


function persona_update_post_title(){

	check_ajax_referer( 'persona-nonce-check', 'security' );

	$post_id = $_POST['post_ID'];
	$post_title = $_POST['post_title'];

	$args = array(
		'ID' => $post_id,
		'post_title'  => $post_title,
	);

	wp_update_post( $args );

	die();

}


function persona_new_status_post(){

	check_ajax_referer( 'persona-nonce-check', 'security' );

	$post_author = get_current_user_id();
	$post_title = wp_strip_all_tags($_POST['post_title']);
	$post_content = $_POST['post_content'];

	$args = array(
		'post_title'    => $post_title,
		'post_content'  => $post_content,
		'post_status'   => 'publish',
		'post_author'   => $post_author,
	);

	$inserted_post = wp_insert_post( $args );
	set_post_format($inserted_post, 'status' );

	die();

}


///////////////////////////////////////////////////////////////////////////////////////
// Pagination
///////////////////////////////////////////////////////////////////////////////////////

function persona_pagination($pages = '', $range = 2)
{  
	$showitems = ($range * 2)+1;

	global $paged;
	if(empty($paged)) $paged = 1;

	if($pages == ''){
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages){
			$pages = 1;
		}
	}

	if(1 != $pages){
		echo "<ul id='pagination'>";
		if($paged > 1) echo "<li class='prev'><a href='".get_pagenum_link($paged - 1)."'></a></li>";

		for ($i=1; $i <= $pages; $i++){
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
				echo ($paged == $i)? "<li><a class='selected'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
			}
		}

		if ($paged < $pages) echo "<li class='next'><a href='".get_pagenum_link($paged + 1)."'></a></li>";
		echo '<li class="total">'.$paged.'/'.$pages.'</li></ul>';
	}
}


///////////////////////////////////////////////////////////////////////////////////////
// Custom Gallery Markup
///////////////////////////////////////////////////////////////////////////////////////

function custom_gallery($attr) {
  
    global $post;

    if ( ! empty( $attr['ids'] ) ) {
        if ( empty( $attr['orderby'] ) )
            $attr['orderby'] = 'post__in';
        $attr['include'] = $attr['ids'];
    }

    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => 3,
        'size'       => 'full',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $args = array(
        'post_type' => 'attachment',
        'post_parent' => $id,
        'numberposts' => -1,
        'orderby' => 'menu_order'
        );
   
	if(!empty($include)){
		$images = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}else{
		$images = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	$html = '';
	if($images){
		$first_image = wp_get_attachment_image_src($images[0]->ID, $size='full');
		$first_caption = $images[0]->post_excerpt;
		if($first_caption == ''){
			$html .=  '<div class="gallery-embed"><div class="current-image"><div class="caption hidden"><p></p></div><img src="'. $first_image[0] .'" alt="" /><img class="loaded-image" src="#" alt="#" /></div>';
		} else {
			$html .=  '<div class="gallery-embed"><div class="current-image"><div class="caption"><p>'.$first_caption.'</p></div><img src="'. $first_image[0] .'" alt="" /><img class="loaded-image" src="#" alt="#" /></div>';
		}
		$html .=  '<div class="flexslider carousel"><ul class="slides">';

		$i = 0;
		foreach ( $images as $image ) {
			$title = '';
			$caption = $image->post_excerpt;
			if($i == 0){
				$class_active = ' active';
			} else {
				$class_active = '';
			}

			$description = $image->post_content;
			if($description == '') $description = $title;

			$image_alt = get_post_meta($image->ID,'_wp_attachment_image_alt', true);

			$image_data = wp_get_attachment_image_src($image->ID, $size='full');

			$html .= '<li><a href="'. $image_data[0] .'" data-caption="'.$caption.'" data-id="'.$image->ID.'" class="gallery-thumbnail'.$class_active.'" title="'.$image->post_title.'">';
			$html .=  wp_get_attachment_image( $image->ID, $size ='gallery-thumbnail');
			$html .= '</a></li>';
			$i++;
		            
		}
		$html .= '</ul></div></div>';
		return $html;
     }

}

remove_shortcode('gallery');
add_shortcode('gallery', 'custom_gallery');


// Clean some unvalid markup
function remove_category_list_rel($output) {
	return str_replace(' rel="category tag"', '', $output);
}

add_filter( 'wp_list_categories', 'remove_category_list_rel' );
add_filter( 'the_category', 'remove_category_list_rel' );


// Fix empty title on home page
function persona_title_home($title, $sep){
	$site_description = '';
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description != '' && (is_home() || is_front_page())){
		$title = get_bloginfo( 'name', 'display' );
		$title = "$title $sep $site_description";
	} else {
		$blogname = get_bloginfo( 'name', 'display' );
		$title = "$title $blogname";
	}

	return $title;
}

add_filter('wp_title', 'persona_title_home', 10, 2);


///////////////////////////////////////////////////////////////////////////////////////
// Google Analytics
///////////////////////////////////////////////////////////////////////////////////////

function persona_ga_tracking_code() {
	register_setting( 'general', 'persona_ga_tracking_code' );
	add_settings_field('persona_ga_tracking_code_field', '<label for="ga_code">'.__('Google Analytics Tracking Code' , 'persona' ).'</label>' , 'persona_ga_tracking_code_input' , 'general' );
}

add_action( 'admin_init', 'persona_ga_tracking_code' );

function persona_ga_tracking_code_input() {
	$options = get_option( 'persona_ga_tracking_code' );
	$value = '';
	if(isset($options['ga_code'])){
		$value = $options['ga_code'];
	}

	?>
	<textarea id='ga_code' name='persona_ga_tracking_code[ga_code]' cols='50' rows='4'><?php echo esc_attr( $value ); ?></textarea>
	<p class="description"><?php echo __('Paste the entire Google Analytics code here including the script tag.', 'persona'); ?></p>
	<?php
}

function persona_ga_header(){
	$options = get_option( 'persona_ga_tracking_code' );

	if(isset($options['ga_code'])){
		echo $options['ga_code'];
	}
}

add_action('wp_head', 'persona_ga_header', 999);


?>