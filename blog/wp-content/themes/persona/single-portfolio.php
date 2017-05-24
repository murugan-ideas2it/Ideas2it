<?php
/**
 * The Template for displaying portfolio item.
 *
 */

get_header();

$options = get_option('persona_theme_options');


?>

	<div id="container">
		<div id="content">

			<?php if(have_posts()) : while(have_posts()) : the_post(); $post_id = get_the_ID(); ?>

				<article id="post-<?php echo $post_id; ?>" data-id="<?php echo $post_id; ?>" <?php post_class('post'); ?>>

					<a href="" class="format-all"></a>

					<?php if( current_user_can( 'edit_post', $post_id ) ){  ?>

						<a href="" class="admin-toolbar display"></a>
						<ul class="admin-menu">
							<li><a href="" class="title" data-title="<?php the_title(); ?>"><?php echo __('Edit Post Title', 'persona'); ?></a></li>
							<li><a href="" class="trash not-trashed"><?php echo __('Trash Post', 'persona'); ?></a></li>
						</ul>

					<?php } else { ?>

						<a href="" class="share-button logged-out inactive"></a>
						<?php get_template_part( 'sharebox', 'template' ); ?>

					<?php } ?>

					<h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

					<div class="meta-info">
						<?php if (!is_page()){ ?>
							<a href="<?php the_permalink(); ?>" class="post-date" title="<?php the_title(); ?>"><?php the_time(get_option('date_format')); ?></a> &bull;
						<?php } ?>
						<?php if ( comments_open() ){ ?>
							<a href="" class="post-reply"><?php echo __('Leave a comment', 'persona'); ?></a>
						<?php } else { ?>
							<p><?php echo __('(comments are closed)', 'persona'); ?></p>
						<?php } ?>
					</div>

					<div class="content">
						<?php global $more; $more = 0; the_content('', true ); ?>
					</div>

					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'persona' ), 'after' => '</div>' ) ); ?>

					<?php comments_template( '', true ); ?>
					
				</article>

				<ul id="pagination">
					<li class="prev"><?php previous_post_link( '%link', '%title' ); ?></li>
					<li class="next"><?php next_post_link( '%link', '%title' ); ?></li>
				</ul>

			<?php endwhile; ?>

			<?php else : ?>

				<p><?php _e('not found', 'persona') ?></p>
				
			<?php endif; ?>

		</div> <!-- end content -->
	</div> <!-- end container -->

	<div class="portfolio-wrapper">
		<div id="portfolio-meta" class="content">
			<?php 
				global $post;
				global $more; 
				$more = 1; 
				if( strpos( $post->post_content, '<!--more-->' ) ) {
					the_content('', true);
				}
			?>

			<div class="related">
			<h2><?php echo __('Related work', 'persona'); ?></h2>
			<?php 

				$i = 0;
				$displayed = array();
				
				$tags = wp_get_post_tags( $post_id, array( 'fields' => 'slugs' ) );
				$related = new WP_Query(
					array( 	'post_type' 		=> 'portfolio', 
							'post__not_in'		=> array($post_id),
							'posts_per_page' 	=> 4,
							'tag_slug__in' 		=> $tags,
					)
				);

			while ( $related->have_posts() ) : $related->the_post(); $displayed[] = get_the_ID(); ?>

				<a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'sidebar-thumbnail'); ?></a>

			<?php $i++; endwhile; ?>

			<?php wp_reset_query(); 

				$displayed[] = get_the_ID();

				$related = new WP_Query( 
					array( 	'post_type' 		=> 'portfolio',
							'post__not_in'		=> $displayed,
							'posts_per_page' 	=> 4 - $i,

					)
				);

				while ( $related->have_posts() ) : $related->the_post(); ?>
					<a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'medium'); ?></a>
			<?php endwhile; ?>
				
			</div>
			
		</div> <!-- end portfolio meta -->
	</div> <!-- end portfolio wrapper -->

<?php get_footer(); ?>