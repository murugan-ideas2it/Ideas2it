<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shoreditch
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<section id="shoeditch_social_widget" class="widget widget-small">
		<a href="https://www.facebook.com/Ideas2it" class="facebook">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/facebook.png" alt="facebook">
		</a>
		<a href="https://www.linkedin.com/company/ideas2it" class="linkedin">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/linkedin.png" alt="linkedin">
		</a>
		<a href="https://twitter.com/ideas2it" class="twitter">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/twitter.png" alt="twitter">
		</a>
		<!-- <a href="https://plus.google.com/106398811626655559616" class="googleplus">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/googleplus.png" alt="googleplus">
		</a> -->
		<a href="mailto:contact@ideas2it.com" class="email">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/email.png" alt="email">
		</a>
		<a href="https://www.instagram.com/ideas2it/" class="Instagram">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/instagrame.png" alt="Instagrame">
		</a>
	</section>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
