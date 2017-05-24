<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Shoreditch
 */

get_header(); ?>

	<?php
	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', 'hero' );

	endwhile; // End of the loop.
	?>

	<div class="site-content-wrapper">

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', get_post_format() );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

				$tags = wp_get_post_tags($post->ID);
				if ($tags) {
					$tag_ids = array();
					foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
					$args=array(
					'tag__in' => $tag_ids,
					'post__not_in' => array($post->ID),
					'posts_per_page'=>2, // Number of related posts that will be shown.
					'caller_get_posts'=>1
					);
					$my_query = new wp_query( $args );
					if( $my_query->have_posts() ) {
						echo '<nav class="navigation post-navigation" role="navigation">
							   <h2 class="screen-reader-text">Related Post</h2>
							   <div class="nav-links">';
						while( $my_query->have_posts() ) {
							$my_query->the_post(); ?>
							<div>
								<a href="<? the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><span class="meta-nav" aria-hidden="true">Related posts</span> <span class="screen-reader-text">Previous post:</span> <span class="post-title"><?php the_title(); ?></span></a>
							</div>

						<? }
						echo '</div>
							</nav>';
					}
				}else{
						the_post_navigation( array(
						'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Newer posts', 'shoreditch' ) . '</span> ' . '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'shoreditch' ) . '</span> ' . '<span class="post-title">%title</span>',
						'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Older posts', 'shoreditch' ) . '</span> ' . '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'shoreditch' ) . '</span> ' . '<span class="post-title">%title</span>',
					) );



				}
				// $post = $orig_post;
				wp_reset_query();

			endwhile; // End of the loop.
			?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>

	</div><!-- .site-content-wrapper -->

<?php
get_sidebar( 'footer' ); ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
jQuery("#submit").click(function(e){
        var data_2;
        var google_captcha_file_url= window.location.protocol+"//"+window.location.hostname+"/blog/wp-content/themes/shoreditch-child/google_captcha.php";

    jQuery.ajax({
                type: "POST",
                url: google_captcha_file_url,
                data: jQuery('#commentform').serialize(),
                async:false,
                success: function(data) {console.log(data);
                 if(data.nocaptcha==="true") {
               data_2=1;
                  } else if(data.spam==="true") {
               data_2=1;
                  } else {
               data_2=0;
                  }
                }
            });
            if(data_2!=0) {
              e.preventDefault();
              if(data_2==1) {
                alert("Please check the captcha");
              } else {
                alert("Please Don't spam");
              }
            } else {
                jQuery("#commentform").submit
           }
  });
</script>

<?php get_footer();
