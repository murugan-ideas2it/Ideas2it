<?php
/**
 * The template for displaying standard posts
 *
 */

$post_id = get_the_ID();
?>

	<?php if (is_search()){ ?>
		<article id="post-<?php echo $post_id; ?>" data-id="<?php echo $post_id; ?>" <?php post_class('post'); ?>>
	<?php } else { ?>
		<article id="post-<?php echo $post_id; ?>" data-id="<?php echo $post_id; ?>" <?php post_class(); ?>>
	<?php } ?>

		<a href="<?php the_permalink(); ?>" class="format-all"></a>

		<?php if( current_user_can( 'edit_post', $post_id ) ){  ?>

			<a href="" class="admin-toolbar display"></a>
			<ul class="admin-menu">
				<li><a href="" class="title" data-title="<?php the_title(); ?>"><?php echo __('Edit Post Title', 'persona'); ?></a></li>
				<li><a href="" class="trash not-trashed"><?php echo __('Trash Post', 'persona'); ?></a></li>
			</ul>

			<div class="share-wrapper">
				<a href="" class="share-button logged-in inactive"><?php echo __('Share +', 'persona'); ?></a>
				<?php get_template_part( 'sharebox', 'template' ); ?>
			</div>

		<?php } else { ?>

			<a href="" class="share-button logged-out inactive"></a>
			<?php get_template_part( 'sharebox', 'template' ); ?>

		<?php } ?>

		<?php if(has_post_thumbnail()){ ?>
			<div class="featured-image-top">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php } ?>

		<h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

		<?php if(has_excerpt()){ ?>
			<p class="excerpt"><?php the_excerpt(); ?></p>
		<?php } ?>

		<div class="meta-info">
			<?php if (!is_page()){ ?>
				<a href="<?php the_permalink(); ?>" class="post-date" title="<?php the_title(); ?>"><?php the_time(get_option('date_format')); ?></a>
				<div class="category">
					<?php echo __('in', 'persona'); the_category(', '); ?>
				</div>
				&bull;
				<?php the_author_link(); ?> 
				&bull;
			<?php } ?>
			<?php if ( comments_open() ){ ?>
				<a href="" class="post-reply"><?php echo __('Leave a comment', 'persona'); ?></a>
			<?php } else { ?>
				<p><?php echo __('(comments are closed)', 'persona'); ?></p>
			<?php } ?>
		</div>

		<?php if( has_tag() && !is_page() ) { ?>
			<ul class="tags">
				<?php the_tags('<li>','</li><li>','</li>'); ?>
			</ul>
		<?php } ?>

		<div class="content">
			<?php $continue_text = __('Continue reading...', 'persona'); the_content('<span class="more-text">'.$continue_text.'</span>'); ?>
		</div>

		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'persona' ), 'after' => '</div>' ) ); ?>

		<?php comments_template( '', true ); ?>
		
	</article>