
		<?php $options = get_option('persona_theme_options'); ?>

		</div> <!-- end wrapper -->

		<div class="clear"></div>

		<div id="footer">
			<div class="wrapper">

				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<div class="widget-section first">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<div class="widget-section">
						<?php dynamic_sidebar( 'footer-2' ); ?>
					</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
					<div class="widget-section">
						<?php dynamic_sidebar( 'footer-3' ); ?>
					</div>
				<?php endif; ?>

				<div class="clear"></div>

				<div class="copyright">

					<?php 

						$nav_args = array(
							'theme_location'  => 'footer',
							'menu'            => '',
							'container'       => false,
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => false,
							'menu_id'         => '',
							'echo'            => true,
							'fallback_cb'     => '',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '<ul id="footer-menu">%3$s</ul>',
							'depth'           => 1,
							'walker'          => ''
						);

						wp_nav_menu( $nav_args ); 
					?>

					<p><?php echo $options['footer_text']; ?></p>
				</div>

			</div> <!-- end footer wrapper -->

		</div> <!-- end footer -->

		<?php wp_footer(); ?>
		
	</body>
</html>