<?php 

add_shortcode('homepagepost', 'homepagepost_shortcode');
    function homepagepost_shortcode($atts, $content=null){
        extract(shortcode_atts(array('postid' => '', 'postname' => ''),$atts));
		// $int_array = array_map("intval", explode(",", $postid));
  //       $args = array(
		//     'post__in' => $int_array
		// );
		// $posts = get_posts($args);
		// $homeposts['first_post'] = $posts[0];
		// $homeposts['second_post'] = $posts[1];
		// print_r($homeposts);
		return $postid;
        //print_r($post_content);die;
        /*$content=apply_filters('the_content', get_post_field('post_content', $postid));
        echo $content;*/
    }
    // This theme uses post thumbnails
add_theme_support( 'post-thumbnails' );
// order posts
 
function order_posts($posts, $order){
	$result = array(); 
	foreach($order as $id){
		$i = 0;
		foreach($posts as $post){
			if($post->ID == $id){
				array_push($result, $post);
				unset($posts[$i]);
				$posts = array_values($posts);
			}
		$i++;
		}
	}
	return $result;
}
// Changing excerpt length
function get_custom_excerpt($count){
    $permalink = get_permalink($post->ID);
    $excerpt = get_the_content();
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $count);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    // $excerpt = $excerpt.'... <a href="'.$permalink.'">Read More</a>';
    $excerpt = $excerpt.'...';
    return $excerpt;
}
/* Post id to get post content excerpt */
// function custom_get_the_excerpt($post_id) {
//   global $post;  
//   $save_post = $post;
//   $post = get_post($post_id);
//   $output = get_the_excerpt();
//   $post = $save_post;
//   return $output;
// }
//get excerpt by id
function get_excerpt_by_id($post_id){
    $the_post = get_post($post_id); //Gets post ID
    $the_excerpt = ($the_post ? $the_post->post_content : null); //Gets post_content to be used as a basis for the excerpt
    $excerpt_length = 35; //Sets excerpt length by word count
    $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
    $words = explode(' ', $the_excerpt, $excerpt_length + 1);

    if(count($words) > $excerpt_length) :
        array_pop($words);
        array_push($words, '…');
        $the_excerpt = implode(' ', $words);
    endif;

    return $the_excerpt;
}

 ?>