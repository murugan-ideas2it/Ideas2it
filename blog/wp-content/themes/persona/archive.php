<?php
/**
 * The Template for displaying archives.
 *
 */

get_header();

$options = get_option('persona_theme_options');

global $withcomments;
$withcomments = true;

?>

	<div id="container">
		<div id="content">

			<div class="page-info">
				<?php  if (is_author()){ $author_mail = get_the_author_meta('user_email', $author_id); ?>
					<div class = "author">
						<?php if (function_exists('get_avatar')) {
							echo get_avatar($author_mail,'80');
						} ?>
						<div class="main">
							<h1><?php the_author_meta('display_name', $author_id); ?></h1>
							<?php if ($author_name->linkedin != ''){ ?>
								<a href="<?php echo esc_url($author_name->linkedin);?>" title="Connect on LinkedIn" class = "author_linkedin"></a>
							<?php } if ($author_name->facebook != ''){ ?>
								<a href="<?php echo esc_url($author_name->facebook);?>" title="My Facebook profile" class = "author_facebook"></a>
							<?php } if ($author_name->twitter != ''){ ?>
								<a href="<?php echo esc_url($author_name->twitter);?>" title="Follow me on Twitter" class = "author_twitter"></a>
							<?php } ?>
							<div class="clear"></div>
						</div>
						<p><?php the_author_meta('description', $author_id); ?></p>
					</div>
				<?php } elseif (is_category()){ ?>
					<h1><?php single_cat_title(); ?></h1>
				<?php } elseif (is_tag()){ ?>
					<h1><?php single_tag_title(__('Viewing all items for tag ', 'persona')); ?></h1>
				<?php } elseif (is_day()){ ?>
					<h1><?php echo __('All items for ', 'persona'); the_time(get_option('date_format')); ?></h1>
				<?php } elseif (is_month()){ ?>
					<h1><?php echo __('All items for ', 'persona'); the_time('F, Y'); ?></h1>
				<?php } elseif (is_year()){ ?>
					<h1><?php echo __('All items for ', 'persona'); the_time('Y'); ?></h1>
				<?php } elseif (is_date()){ ?>
					<h1><?php the_time(get_option('date_format')); ?></h1>
				<?php } ?>
			</div>

			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

			<?php else : ?>

				<p><?php echo __('No results found.', 'persona') ?></p>
				
			<?php endif; ?>

			<?php if (function_exists('persona_pagination')) {
				persona_pagination('', 3);
			} else {
				posts_nav_link();
			} ?>

		</div> <!-- end content -->
	</div> <!-- end container -->

	<?php if($options['show_sidebar'] == true){ ?>

		<?php get_sidebar(); ?>

	<?php } ?>

<?php get_footer(); ?>



