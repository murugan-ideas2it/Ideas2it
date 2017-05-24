<?php
/**
 * The Template for displaying archives.
 *
 */

get_header();

$options = get_option('persona_theme_options');

global $withcomments;
$withcomments = true;

$post_format = $wp_query->queried_object->name;

?>

	<div id="container">
		<div id="content">

			<div class="page-info taxonomy post format-<?php echo strtolower($post_format); ?>">
				<a href="" class="format-all"></a>
				<h1><?php echo $post_format; ?></h1>
			</div>

			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

			<?php else : ?>

				<p><?php _e('No results found.', 'theme_domain') ?></p>
				
			<?php endif; ?>

			<?php persona_pagination('', 3); ?>

		</div> <!-- end content -->
	</div> <!-- end container -->

	<?php if($options['show_sidebar'] == true){ ?>

		<?php get_sidebar(); ?>

	<?php } ?>

<?php get_footer(); ?>



