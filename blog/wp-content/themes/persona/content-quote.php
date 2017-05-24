<?php
/**
 * The template for displaying posts in the Quote post format
 *
 */

$post_id = get_the_ID();
?>

	<article id="post-<?php echo $post_id; ?>" data-id="<?php echo $post_id; ?>" <?php post_class(); ?>>

		<a href="<?php echo get_post_format_link('quote'); ?>" class="format-all"></a>

		<?php if( current_user_can( 'edit_post', $post_id ) ){  ?>

			<a href="" class="admin-toolbar display"></a>
			<ul class="admin-menu">
				<li><a href="" class="title" data-title="<?php the_title(); ?>"><?php echo __('Edit Quote Title', 'persona'); ?></a></li>
				<li><a href="" class="trash not-trashed"><?php echo __('Trash Quote', 'persona'); ?></a></li>
			</ul>

		<?php } else { ?>

			<a href="" class="share-button logged-out inactive"></a>
			<?php get_template_part( 'sharebox', 'template' ); ?>

		<?php } ?>

		<div class="quote-content content">
			<?php global $more; $more = 0; the_content('', true ); ?>
		</div>

		<?php if( current_user_can( 'edit_post', $post_id ) ){  ?>
			<a href="" class="share-button logged-in inactive"><?php echo __('Share +', 'persona'); ?></a>
			<?php get_template_part( 'sharebox', 'template' ); ?>
		<?php } ?>

		<?php if(has_excerpt()){ ?>
			<p class="excerpt"><?php the_excerpt(); ?></p>
		<?php } ?>

		<div class="meta-info">
			
			<a href="<?php the_permalink(); ?>" class="post-date" title="<?php the_title(); ?>"><?php echo get_the_date(); ?></a>
			<div class="category">
				<?php echo __('in', 'persona'); the_category(', '); ?>
			</div>
			&bull;
			
			<?php if ( comments_open() ){ ?>
				<a href="" class="post-reply"><?php echo __('Leave a comment', 'persona'); ?></a>
			<?php } else { ?>
				<p><?php echo __('(comments are closed)', 'persona'); ?></p>
			<?php } ?>

			<?php the_tags('<ul class="tags"><li>','</li><li>','</li></ul>'); ?>

		</div>

		<?php if(is_single()) {
			$check_more = '';
			$check_more = strpos($post->post_content, '<!--more-->');
			if($check_more != ''){ ?>
				<div class="content">
					<?php global $more; $more = 1; the_content('', true ); ?>
				</div>
			<?php } ?>
			
		<?php } ?>

		<div class="clear"></div>

		<?php comments_template( '', true ); ?>
		
	</article>
