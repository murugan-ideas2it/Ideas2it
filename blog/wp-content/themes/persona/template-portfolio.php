<?php
/*
Template Name: Portfolio page
*/
?>


<?php 
	get_header();

	$options = get_option('persona_theme_options'); 
	global $withcomments; $withcomments = true;

	// Get Portfolio Tags/Categories
	$portfolio = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => 999 ) ); $i = 0; $final = array(); 
	while ( $portfolio->have_posts() ) : $portfolio->the_post();
		$all_tags = get_the_tags();
		
		if($all_tags){
			foreach($all_tags as $tag){
				$tag_single = $tag->name;
				$final[$i] = $tag_single;
				$i++;
			}
		}
	endwhile;

	$tags_unique = array_unique($final);

	 wp_reset_query();
?>

	<ul id="portfolio-filter">
		<li class="portfolio-excerpt-persona content"><?php the_content(); ?></li>

		<li class="selected-undefined">
			<a data-value="all" href="#"><?php echo __('View all', 'persona'); ?></a>
		</li>
		<?php 
		if($tags_unique){
			foreach($tags_unique as $value){
				$for_class = str_replace(' ', '_', $value);
				?><li class=""> <?php
				echo '<a href="#" data-value="'.$for_class.'">'.$value.'</a></li>';
			}
		} ?>
	</ul>

	<div id="container" class="portfolio-container">
		<div id="content">

		<ul id="items" class="portfolio-list">
			<?php $f = 0; if($portfolio->have_posts()) : while ( $portfolio->have_posts() ) : $portfolio->the_post();
				$tags = get_the_tags();
				$post_info = get_the_title();
				$thumb_id = get_post_thumbnail_id(); $f++; ?>
				<li data-id = "id-<?php echo $f; ?>" class="<?php if ($tags) {
					foreach($tags as $tag) {
						$for_class = str_replace(' ', '_', $tag->name);
						echo $for_class.' ';
					}
				} ?>">

				<?php if ( has_post_thumbnail() ) { ?>
					<a href="<?php the_permalink(); ?>" class="view view-first">
						<?php the_post_thumbnail('medium', array ('alt' => $post_info)); ?>
						<div class="mask">
							<h1 class="portfolio-title"><?php the_title(); ?></h1>
							<?php if(has_excerpt()){ ?>
								<p><?php the_excerpt(); ?></p>
							<?php } ?>
						</div>
					</a>
				<?php } ?>

				</li>
			<?php endwhile; ?>
		</ul>

		<?php else : ?>

			<div class="page-info">
				<h1><?php _e('No items found', 'persona') ?></h1>
			</div>
			
		<?php endif; ?>

		</div> <!-- end content -->
	</div> <!-- end container -->

<?php get_footer(); ?>