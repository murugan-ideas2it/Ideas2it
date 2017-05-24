<?php
/**
 * Template Name: Home page
 *
 * Description: Template with sidebar
 *
 * @package WordPress
 * @subpackage i2i
 * @author Murugan
 * @since I2i 1.0
 */

get_header(); ?>

<?php
//create full width template
?>
 <?php
    // TO SHOW THE PAGE CONTENTS
    while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
        <div class="entry-content-page">
        <?php $postIds = do_shortcode(get_post_field('post_content', $postid));
        		$int_array = array_map("intval", explode(",", $postIds)); 
// print_r($int_array);die;
		        $args = array(
				    'post__in' => $int_array
				);
				$posts = get_posts($args);
				$posts = order_posts($posts, $int_array); // the output array of posts is not ordered

        	  $firstPost = $posts[0];
        	  $secondPost = $posts[1]; ?>
        </div><!-- .entry-content-page -->

    <?php
    endwhile; //resetting the page loop
    wp_reset_query(); //resetting the page query
    ?>
 <section>
    <div class="container-fluid home-top-post-container">
   
       <div class="container-fluid home-top-post-image-sec">
          <a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( $firstPost->ID, 'full' );  ?>
          <!-- <img src="<?php //echo get_template_directory_uri();?>/img/mask.png" class="img-responsive width100"> -->
          </a>
       </div>
       <!-- <div class="home-top-post-color-split"></div> -->
       <div class="container-fluid home-top-post-sec">
           <section class="landing-top-post-section">
              <div class="container landing-top-post max-width100" >
                 <div class="row">
                    <span class="home-post-cat">
                    	<!-- <a href="">Technology </a> -->
                    	<?php echo get_the_category_list( ',', '', $firstPost->ID ); ?>
                    	</span> | <span class="post-read-time"> 6 min read</span>
                 </div>
                 <div class="row">
                    <h1 class="home-post-title"><a href="<?php the_permalink(); ?>" class="home-post-name"><?php the_title_attribute(); ?></a></h1>
                 </div>
                 <div class="row">
                    <p class="home-post-content"><?php echo get_custom_excerpt($firstPost->ID);?></p>
                 </div>
                 <div class="row">
                    <br>
                    <div class="author-row">	
                    	<?php $post_author = get_post_field( 'post_author', $firstPost->ID ); ?>
                       <div class="author-image"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?></a></div>
                       <div class="author-name"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></div>
                    </div>
                 </div>
              </div>
              <br><br>
              <div class="container max-width100">
                <div class="row">
                  <div class="col-md-8">
                      <div class="row latest-post-image">
                        <a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( $secondPost->ID, 'large' );  ?></a>
                      </div>
                      <div class="row latest-post-content-sec">
                        <div class="container latest-post-content">
                            <p class="home-post-cat-row"><span class="home-post-cat"><a href=""><?php echo get_the_category_list( ', ', '', $secondPost->ID ); ?></a></span> | <span class="post-read-time"> 3 min read</span></p>
                          <h3 class="latest-post-title"><a href="<?php echo get_permalink( $secondPost->ID ); ?>"><?php echo get_the_title( $secondPost->ID ); ?></a></h3>
                          <p class="latest-second-post-content"><?php echo get_excerpt_by_id($secondPost->ID);?></p>
                            <div class="author-row">
                            <?php $post_author = get_post_field( 'post_author', $secondPost->ID ); ?>
                               <div class="author-image"><a href="<?php echo get_author_posts_url($post_author);  ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?></a></div>
                               <div class="author-name"> <a href="<?php echo get_author_posts_url($post_author);  ?>"><?php the_author_meta( 'display_name', $post_author ); ?></a></div>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="col-md-4 ">
                    <div class="home-right-col">
                      <div class="row followus-div">
                        <div class="col-md-12">
                          <span class="follow-header">Follow Us</span>
                        </div>
                        <div class="col-md-12">
                          <a href=""><img class="followus-image" src="<?php echo get_template_directory_uri();?>/img/social link.png"></a>
                        </div>
                        <!-- <div class="col-md-12 follow_links"> -->
                          
                        <!-- </div> -->
                      </div>
                      <!-- <hr> -->
                      <div class="row popular-post-col">
                        <div class="col-md-12">
                          <span class="popular-post-header">Popular Posts</span>
                        </div> 
                        <div class="popular-post-list-sec">
                          <div class="row popular-post-list">
                              <div class="col-md-3 col-sm-3 col-xs-3 popular-post-image">
                                  <a href=""><img src="<?php echo get_template_directory_uri();?>/img/popular-1.png"></a>
                              </div>
                              <div class="col-md-9 col-sm-9 col-xs-9 popular-content">
                                  <span class="popular-title"><a href="">Technology</a></span>
                                  <p class="popular-desc"><a href="">Aadhaar Verification in Laravel</a></p>
                              </div>
                          </div>
                          <div class="row popular-post-list">
                              <div class="col-md-3 col-sm-3 col-xs-3 popular-post-image">
                                  <a href=""><img src="<?php echo get_template_directory_uri();?>/img/popular-2.png"></a>
                              </div>
                              <div class="col-md-9 col-sm-9 col-xs-9 popular-content">
                                  <span class="popular-title"><a href="">Technology</a></span>
                                  <p class="popular-desc"><a href="">Microservices – Service Discovery</a></p>
                              </div>
                          </div>
                          <div class="row popular-post-list">
                              <div class="col-md-3 col-sm-3 col-xs-3 popular-post-image">
                                  <a href=""><img src="<?php echo get_template_directory_uri();?>/img/popular-3.png"></a>
                              </div>
                              <div class="col-md-9 col-sm-9 col-xs-9 popular-content">
                                  <span class="popular-title"><a href="">Design</a></span>
                                  <p class="popular-desc"><a href="">Conversational UI in a Rural Context</a></p>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="row category_div">
                        <div class="col-md-12">
                            <span class="category_header">Categories</span>
                        </div>
                        <div class="col-md-12 category_box">
                          <form>
                            <div class="form-group">
                              <select class="form-control category_selectbox" title="Choose a category">
                                  <option>Choose a category</option>
                                  <option>Technologies</option>
                                  <option>Design</option>
                                  <option>Marketting</option>
                                  <option>SEO</option>
                              </select>  
                            </div>
                          </form>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <div class="container older-post max-width100">
                  <div class="row older-post-row"><ul>
                  <?php 
//                   $date = get_the_date('Y-m-d H:i:s');
// $args = array(
//     'date_query' => array(
//         array(
//             'before' => $date
//         ),
//     ),
//     'posts_per_page' => 6,
// );
// $query = new WP_Query( $args );
                  	$args = array( 'posts_per_page' => 10, 'offset'=> 1,);
					$the_query = get_posts( $args );
					// print_r($myposts);die;
				
// Define our WP Query Parameters
 $the_query = new WP_Query( 'posts_per_page=5', 'offset=1' );print_r($the_query);die; ?>

<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>

<li><?php the_excerpt(__('(more…)')); ?></li>

<?php 
endwhile;
wp_reset_postdata();
?>
</ul>
                      <div class="col-md-4 col-sm-6 col-xs-12 older-post-div col1">
                        <div class="olderpost-box">
                          <div class="old-post-div">
                              <div class="old-post-img-div">
                                  <a href=""><img class="old-post-img width100" src="<?php echo get_template_directory_uri();?>/img/Engineering_Empathy_Logo.jpg"></a>
                              </div>
                          </div>
                          <div class="old-post-body-div">
                              <div class="old-post-body">
                                  <p class="old-post-cat-sec"><span class="old-post-cat"><a href="">Technology</a></span> | <span class="old-post-read-time">2 min read</span></p>
                                  <h5 class="old-post-title"><a href="">Aadhaar Verification in Laravel</a></h5>
                                  <div class="old-post-author-sec">
                                      <div class="old-post-author-image"><a href=""><img src="<?php echo get_template_directory_uri();?>/img/php.png"></a></div>
                                      <div class="old-post-author-name"> <a href="">PHP Team</a></div>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12 older-post-div col2">
                         <div class="olderpost-box">
                          <div class="old-post-div">
                              <div class="old-post-img-div">
                                  <a href=""><img class="old-post-img width100" src="<?php echo get_template_directory_uri();?>/img/mask.png"></a>
                              </div>
                          </div>
                          <div class="old-post-body-div">
                              <div class="old-post-body">
                                  <p class="old-post-cat-sec"><span class="old-post-cat"><a href="">Technology</a></span> | <span class="old-post-read-time">12 min read</span></p>
                                  <h5 class="old-post-title"><a href="">Microservices – Service Discovery</a></h5>
                                  <div class="old-post-author-sec">
                                      <div class="old-post-author-image"><a href=""><img src="<?php echo get_template_directory_uri();?>/img/murali.png"></a></div>
                                      <div class="old-post-author-name"> <a href="">Murali Vivekanandan</a></div>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12 older-post-div col3">
                        <div class="olderpost-box">
                          <div class="old-post-div">
                              <div class="old-post-img-div">
                                  <a href=""><img class="old-post-img width100" src="<?php echo get_template_directory_uri();?>/img/Engineering_Empathy_Logo.jpg"></a>
                              </div>
                          </div>
                          <div class="old-post-body-div">
                              <div class="old-post-body">
                                  <p class="old-post-cat-sec"><span class="old-post-cat"><a href="">Mobile, products, technology</a></span> | <span class="old-post-read-time">4 min read</span></p>
                                  <h5 class="old-post-title"><a href="">Android Things – Google’s latest addition to the world of IoT</a></h5>
                                  <div class="old-post-author-sec">
                                      <div class="old-post-author-image"><a href=""><img src="<?php echo get_template_directory_uri();?>/img/kumaran.png"></a></div>
                                      <div class="old-post-author-name"> <a href="">Kumaran Vedagiri</a></div>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12 older-post-div col1">
                         <div class="olderpost-box">
                          <div class="old-post-div">
                              <div class="old-post-img-div">
                                  <a href=""><img class="old-post-img width100" src="<?php echo get_template_directory_uri();?>/img/mask.png"></a>
                              </div>
                          </div>
                          <div class="old-post-body-div">
                              <div class="old-post-body">
                                  <p class="old-post-cat-sec"><span class="old-post-cat"><a href="">Business</a></span> | <span class="old-post-read-time">8 min read</span></p>
                                  <h5 class="old-post-title"><a href="">An Introduction to Multipeer Connectivity in Mobiles</a></h5>
                                  <div class="old-post-author-sec">
                                      <div class="old-post-author-image"><a href=""><img src="<?php echo get_template_directory_uri();?>/img/arun.png"></a></div>
                                      <div class="old-post-author-name"> <a href="">Arun Athiappan</a></div>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12 older-post-div col2">
                        <div class="olderpost-box">
                          <div class="old-post-div">
                              <div class="old-post-img-div">
                                  <a href=""><img class="old-post-img width100" src="<?php echo get_template_directory_uri();?>/img/Engineering_Empathy_Logo.jpg"></a>
                              </div>
                          </div>
                          <div class="old-post-body-div">
                              <div class="old-post-body">
                                  <p class="old-post-cat-sec"><span class="old-post-cat"><a href="">Mobile, Technology </a></span> | <span class="old-post-read-time">7 min read</span></p>
                                  <h5 class="old-post-title"><a href="">An Introduction to Multipeer Connectivity in Mobiles</a></h5>
                                  <div class="old-post-author-sec">
                                      <div class="old-post-author-image"><a href=""><img src="<?php echo get_template_directory_uri();?>/img/author.png"></a></div>
                                      <div class="old-post-author-name"> <a href="">Chitra Annapoorni</a></div>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12 older-post-div col3">
                        <div class="olderpost-box">
                          <div class="old-post-div">
                              <div class="old-post-img-div">
                                  <a href=""><img class="old-post-img width100" src="<?php echo get_template_directory_uri();?>/img/mask.png"></a>
                              </div>
                          </div>
                          <div class="old-post-body-div">
                              <div class="old-post-body">
                                  <p class="old-post-cat-sec"><span class="old-post-cat"><a href="">IT</a></span> | <span class="old-post-read-time">15 min read</span></p>
                                  <h5 class="old-post-title"><a href="">Pragmatic Agile Process for Distributed / Mixed Teams</a></h5>
                                  <div class="old-post-author-sec">
                                      <div class="old-post-author-image"><a href=""><img src="<?php echo get_template_directory_uri();?>/img/kalpana.png"></a></div>
                                      <div class="old-post-author-name"> <a href="">Kalpana</a></div>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="row showmore-div showmore-row">
                    <div class="col-md-12"><button class="showmore btn">Show Older Posts</button></div>
                  </div>
              </div>
          </section>
       </div>
    </div>
 </section>


<?php get_footer(); ?>