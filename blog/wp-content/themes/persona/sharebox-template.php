<?php
/**
 * The template for displaying ShareBox
 *
 */

$title     = str_replace(' ', '%20', get_the_title());
$url       = urlencode(get_permalink());
$summary   = urlencode(get_the_excerpt());
$image     = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()));
$blog_name = str_replace(' ', '%20', get_bloginfo('name'));

if(isset($image) == false){
	$first_image = get_children(array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'numberposts' => 1, 'post_mime_type' => 'image', 'order'=>'ASC', 'orderby' => 'ID'));
	$image = wp_get_attachment_url( current($first_image)->ID );
	if(!$image){
		$image = persona_get_avatar_url(get_avatar( get_the_author_meta('ID'), 200 ));
	}
}

if (is_single()){
	$show_all = 1; 
} else {
	$show_all = 0;
}

?>


<div class="sharebox">
	<a href="" onclick="javascript:window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;p[images][0]=<?php echo urlencode($image);?>','', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=540');return false;" title="<?php echo __('Share on Facebook', 'persona'); ?>" class="facebook"></a>
	<a href="http://twitter.com/home/?status=<?php echo $title; ?>%20-%20<?php echo $url; ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=540');return false;" title="<?php echo __('Share on Twitter', 'persona'); ?>" class="twitter"></a>
	<a href="https://plus.google.com/share?url=<?php echo $url; ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" title="<?php echo __('Share on Google+', 'persona'); ?>" class="google"></a>
	
	<?php if ( has_post_format( 'image' )) { ?>

		<a href="http://www.tumblr.com/share/photo?source=<?php echo urlencode($image); ?>&amp;caption=<?php echo $title; ?>&amp;click_thru=<?php echo $url ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=431,width=450');return false;" title="<?php echo __('Share Image on Tumblr', 'persona'); ?>" class="tumblr"></a>

	<?php } else if ( has_post_format( 'link' )) {
			global $more; $more = 0;
			$content = get_the_content('');
			$more = $show_all;
			$content = preg_match_all( '/href\s*=\s*[\"\']([^\"\']+)/', $content, $links );
			$first_url = $links[1][0];

			if($first_url){
				$url = urlencode($first_url);
			}
	?>

		<a href="http://www.tumblr.com/share/link?url=<?php echo $url; ?>&amp;name=<?php echo $title; ?>&amp;description=<?php echo $summary; ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=431,width=450');return false;" title="<?php echo __('Share Link on Tumblr', 'persona'); ?>" class="tumblr"></a>
	
	<?php } else if ( has_post_format( 'quote' )) { 
			global $more; 
			$more = 0; 
			$content = strip_tags(get_the_content('')); 
			$more = $show_all;
	?>

		<a href="http://www.tumblr.com/share/quote?quote=<?php echo urlencode($content); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=431,width=450');return false;" title="<?php echo __('Share Quote on Tumblr', 'persona'); ?>" class="tumblr"></a>

	<?php } else { ?>

		<a href="http://www.tumblr.com/share?v=3&amp;u=<?php echo $url; ?>&amp;t=<?php echo $title;?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=431,width=450');return false;" title="<?php echo __('Share on Tumblr', 'persona'); ?>" class="tumblr"></a>
	
	<?php } ?>

	<a href="mailto:?subject=<?php echo $title;?>%20%5B<?php echo $blog_name; ?>%5D&amp;body=<?php echo $title; ?>%20-%20<?php echo $url; ?>" title="<?php echo __('Email', 'persona'); ?>" class="email"></a>

	<div class="clear"></div>
	<p><?php echo __('Permalink:', 'persona'); ?></p>
	<input type="text" value="<?php echo urldecode($url); ?>" />
</div>