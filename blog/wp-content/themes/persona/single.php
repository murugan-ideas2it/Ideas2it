<?php
/**
 * The Template for displaying all single posts.
 *
 */

get_header();

$options = get_option('persona_theme_options');

?>

	<div id="container">
		<div id="content">

			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

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

	<?php if($options['show_sidebar'] == true){ ?>

		<?php get_sidebar(); ?>

	<?php } ?>

<?php get_footer(); ?>