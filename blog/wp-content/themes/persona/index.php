<?php 
	get_header(); 

	$options = get_option('persona_theme_options'); 
	global $withcomments; 
	$withcomments = true;

	$show_slider = false;

	if(is_front_page() && !is_paged() && $options['show_slider'] == true){
		$show_slider = true;
	}
?>

	<?php if($show_slider == true && $options['slider_size'] == 'full'){ ?>

		<?php get_template_part( 'slider', 'template' ); ?>

	<?php } ?>

	<div id="container">
		<div id="content">

		<?php if($show_slider == true && $options['slider_size'] == 'compact'){ ?>

			<?php get_template_part( 'slider', 'template' ); ?>

		<?php } ?>

		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

		<?php endwhile; ?>

		<?php else : ?>

			<div class="page-info">
				<h1><?php _e('No items found', 'persona') ?></h1>
			</div>
			
		<?php endif; ?>

		<?php persona_pagination('', 3); ?>

		</div> <!-- end content -->
	</div> <!-- end container -->

	<?php if($options['show_sidebar'] == true){ ?>

		<?php get_sidebar(); ?>

	<?php } ?>

<?php get_footer(); ?>