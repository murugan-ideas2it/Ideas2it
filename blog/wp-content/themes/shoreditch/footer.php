<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shoreditch
 */

?>

	</div><!-- #content -->

	
	<footer id="colophon" class="site-footer" role="contentinfo" class="sep" style="background-color:#404040; height:40px !important;padding:5px !important;">
		<div class="site-footer-wrapper" style="max-width: 300px;margin: auto;padding-top: 10px;">
			<?php shoreditch_social_menu(); ?>

			<div class="site-info">
				<span>
	<?php printf( esc_html__( 'Copyright © %1$s by %2$s.', '' ),'',  '<a href="http://www.ideas2it.com/" rel="designer">Ideas2IT</a> | All Rights Reserved' ); ?>
</span>
    
			</div><!-- .site-info -->
		</div><!-- .site-footer-wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
