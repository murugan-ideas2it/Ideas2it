<?php
/**
 * The Template for displaying 404 page.
 *
 */

get_header();

$options = get_option('persona_theme_options');

?>

	<div id="container">
		<div id="content">

			<div class="page-info">
				<h1><?php echo __('404: Page Not Found', 'persona'); ?></h1>
			</div>

			<div class="post">
				<div class="content">
					<p><?php echo __('To find what you\'re looking for use the search or check out some of the latest articles.', 'persona'); ?></p>
					<ul>
						<li><a href="<?php echo get_home_url(); ?>"><?php echo __('All Posts', 'persona'); ?></a></li>
						<li><a href="<?php echo get_post_format_link('status'); ?>"><?php echo __('Statuses', 'persona'); ?></a></li>
						<li><a href="<?php echo get_post_format_link('image'); ?>"><?php echo __('Images', 'persona'); ?></a></li>
						<li><a href="<?php echo get_post_format_link('gallery'); ?>"><?php echo __('Galleries', 'persona'); ?></a></li>
						<li><a href="<?php echo get_post_format_link('video'); ?>"><?php echo __('Videos', 'persona'); ?></a></li>
						<li><a href="<?php echo get_post_format_link('quote'); ?>"><?php echo __('Quotes', 'persona'); ?></a></li>
						<li><a href="<?php echo get_post_format_link('link'); ?>"><?php echo __('Links', 'persona'); ?></a></li>
					</ul>
					
				</div>
			</div>

		</div> <!-- end content -->
	</div> <!-- end container -->

	<?php if($options['show_sidebar'] == true){ ?>

		<?php get_sidebar(); ?>

	<?php } ?>

<?php get_footer(); ?>