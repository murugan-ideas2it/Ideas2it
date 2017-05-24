<?php
/**
 * The template for displaying Comments.
 */

if ( post_password_required() )
	return; 

	global $post;

	$total_comments = get_comments_number( $post->ID );
	$featured_comments = 2;

	$show_avatars = get_option('show_avatars');
	if(!$show_avatars){
		$avatar_off_class = ' avatars-off';
	} else {
		$avatar_off_class = '';
	}

	$GLOBALS['parent_comments_count'] = 0;
	wp_list_comments( array( 'callback' => 'count_parent_comments', 'end-callback' => 'count_parent_comments_end' ) );
	$total_comments = $GLOBALS['parent_comments_count'];

?>

	<ul class="comments<?php echo $avatar_off_class ?>">

		<?php 

			if(!is_singular()){
				if($total_comments == 1){
					wp_list_comments( array( 'callback' => 'persona_comment', 'per_page' => 1, 'page' => $total_comments) );
				} else {
					for ($i = $featured_comments-1; $i >= 0; $i--) {
						wp_list_comments( array( 'callback' => 'persona_comment', 'max_depth' => 1, 'per_page' => 1, 'page' => $total_comments-$i ) );
					}
				}

				if($total_comments > 2){ ?>
					<li class="show-all"><a class="not-loaded" href="" title="<?php printf( __('view all comments (%d)', 'persona'), get_comments_number( $post->ID )); ?>">&bull;&bull;&bull;</a></li>
		<?php 	} 
			} else {
				wp_list_comments( array( 'callback' => 'persona_comment') );
			}

		?>
			
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'persona' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'persona' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'persona' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

<?php

////////////////////////////////////////////////////////////////
//  Display the reply box
////////////////////////////////////////////////////////////////

if('open' == $post->comment_status) : ?>

	<?php if (is_user_logged_in()){ global $current_user; get_currentuserinfo(); ?>

		<li class='respond'>

			<form class="comment-form" action="<?php echo home_url(); ?>/wp-comments-post.php" method="post" name="commentform" >

				<textarea placeholder="<?php echo __('Leave a comment...', 'persona'); ?>" name="comment" class="comment-box"></textarea>

				<input type="hidden" value="<?php echo $current_user->display_name; ?>" name="author" class="author">
				<input type="hidden" value="<?php echo $current_user->user_email; ?>" name="email" class="email">
				<input type="hidden" value="<?php echo $current_user->user_url; ?>" name="url" class="url">

				<em class="info"><?php echo __('Thanks for leaving a comment, please keep it clean. HTML allowed is strong, code and a href.', 'persona'); ?></em>
				
				<?php if(get_option('comment_moderation') == '1'){ ?>
					<p><?php echo __('Comment moderation is enabled, no need to resubmit any comments posted.', 'persona')?></p>
				<?php } ?>

				<input type="submit" value="<?php echo __('Reply', 'persona'); ?>" class="submit" name="submit">
				
			</form>

		</li> <!-- end respond -->

	<?php } else if (get_option('comment_registration') == false) { ?>

		<li class='respond'>

			<form class="comment-form" action="<?php echo home_url(); ?>/wp-comments-post.php" method="post" name="commentform" >

				<textarea placeholder="<?php echo __('Leave a comment...', 'persona'); ?>" name="comment" class="comment-box"></textarea>

				<input type="text" value="" name="author" class="author" placeholder="<?php echo __('Your Name...', 'persona'); ?>">
				<input type="text" value="" name="email" class="email" placeholder="<?php echo __('Your Email...', 'persona'); ?>">
				<input type="text" value="" name="url" class="url" placeholder="<?php echo __('Webpage...', 'persona'); ?>">

				<em class="info"><?php echo __('Thanks for leaving a comment, please keep it clean. HTML allowed is strong, code and a href.', 'persona'); ?></em>
				
				<?php if(get_option('comment_moderation') == '1'){ ?>
					<p><?php echo __('Comment moderation is enabled, no need to resubmit any comments posted.', 'persona')?></p>
				<?php } ?>

				<input type="submit" value="<?php echo __('Reply', 'persona'); ?>" class="submit" name="submit">
				
			</form>

		</li> <!-- end respond -->

	<?php } else if (get_option('comment_registration') == true && is_user_logged_in() == false) { ?>

		<li class='respond'>
			<form class="comment-form" action="<?php echo home_url(); ?>/wp-comments-post.php" method="post" name="commentform" >
				<em class="info" style="margin-top: 0;"><?php echo __('You need to be logged in to leave a comment.', 'persona'); ?></em>
			</form>
		</li>

	<?php } ?>

<?php endif; // end "if comments are open" loop ?>

</ul> <!-- end comments -->
