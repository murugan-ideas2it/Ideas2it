<?php 
/*
Plugin Name: Social Share by ArrowPlugins
Plugin URI:
Description: Add Social Share Icons on every Post, Page or on Home page with Style on your WordPress site
Author: Arrow Plugins
Author URI: 
Copyright: 2017 ArrowPlugins
Version: 1.2
License: GplV2
*/

function wpssi_add_social_icons_post($content) {
$ncontent ='';
 if (get_option('wpsocialarrow-enable-post') == 1 && is_single()) {
   global $post;
   $url = get_permalink($post->ID);
   $url = esc_url($url);
   $ncontent .= '<input id="wpsocialarrow-get-post-id" type="hidden" value="' .$url.'" />';
   $ncontent .= '<div id="wpsocialarrow-social-icons-box" class="wpsocialarrow-social-icons-box" data-selected-skin="'.get_option('wpsocialarrow-skins') .'" style="display: block;width: 100%;background-color: ;" id="wpsocialarrow-live-preview-options-settings"></div>';
   $ncontent .= '<input id="wpsocialarrow-selected-social-network1" name="wpsocialarrow-selcetion-network" type="hidden" value="'.get_option('wpsocialarrow-facebook').'"></input>';
   $ncontent .= '<input id="wpsocialarrow-selected-social-network2" name="wpsocialarrow-selcetion-network" type="hidden" value="'.get_option('wpsocialarrow-twitter').'"></input>';
   $ncontent .= '<input id="wpsocialarrow-selected-social-network3" name="wpsocialarrow-selcetion-network" type="hidden" value="'.get_option('wpsocialarrow-google').'"></input>';
   $ncontent .= '<input id="wpsocialarrow-selected-social-network4" name="wpsocialarrow-selcetion-network" type="hidden" value="'.get_option('wpsocialarrow-linkedin').'"></input>';
   $ncontent .= '<input id="wpsocialarrow-selected-social-network5" name="wpsocialarrow-selcetion-network" type="hidden" value="'.get_option('wpsocialarrow-pinterest').'"></input>';
   $ncontent .= '<input id="wpsocialarrow-selected-skin" type="hidden" value="'. get_option("wpsocialarrow-skins") .'"/>';
   $ncontent .= '<input id="wpsocialarrow-selected-positioning" type="hidden" value="'. get_option("wpsocialarrow-positioning") .'"/>';
   $ncontent .= '<input id="wpsocialarrow-selected-message" type="hidden" value="'. get_option("wpsocialarrow-message-selection") .'"/>';
   $ncontent .= '<input id="wpsocialarrow-selected-custom-message" type="hidden" value="'. get_option("wpsocialarrow-custom-message") .'"/>';
   $ncontent .= '<input id="wpsocialarrow-selected-alignment" type="hidden" value="'. get_option("wpsocialarrow-alignment") .'"/>';
   $ncontent .= '<input id="wpsocialarrow-selected-message-font" type="hidden" value="'. get_option("wpsocialarrow-gfonts") .'"/>';
 }
    if(get_option('wpsocialarrow-positioning') == 'afterpost'){
      return $content =$content . $ncontent;
    }

 if(get_option('wpsocialarrow-positioning') == 'beforepost'){
   return $content = $ncontent .$content;
 }

 if(get_option('wpsocialarrow-positioning') == 'both'){
   //return $content = $ncontent .$content. $ncontent ;
   $latestContent =  $ncontent.=$content.=$ncontent;
   return $latestContent;
 }

 else{
   return $content;
 }


}

if(get_option('wpsocialarrow-enable-post') ==  1 ){
add_filter('the_content', 'wpssi_add_social_icons_post');
}


function wpssi_add_social_icons_page($content) {
$ncontent ='';

 if (get_option('wpsocialarrow-enable-page') == 1 && is_page()) {
   global $post;
   $url = get_permalink($page->ID);
   $url = esc_url($url);
   $ncontent .= '<input id="wpsocialarrow-get-post-id" type="hidden" value="' .$url.'" />';
   $ncontent .= '<div id="wpsocialarrow-social-icons-box" class="wpsocialarrow-social-icons-box" data-selected-skin="'.get_option('wpsocialarrow-skins') .'" style="display: block;width: 100%;background-color: ;" id="wpsocialarrow-live-preview-options-settings"></div>';
   $ncontent .= '<input id="wpsocialarrow-selected-social-network1" name="wpsocialarrow-selcetion-network" type="hidden" value="'.get_option('wpsocialarrow-facebook').'"></input>';
   $ncontent .= '<input id="wpsocialarrow-selected-social-network2" name="wpsocialarrow-selcetion-network" type="hidden" value="'.get_option('wpsocialarrow-twitter').'"></input>';
   $ncontent .= '<input id="wpsocialarrow-selected-social-network3" name="wpsocialarrow-selcetion-network" type="hidden" value="'.get_option('wpsocialarrow-google').'"></input>';
   $ncontent .= '<input id="wpsocialarrow-selected-social-network4" name="wpsocialarrow-selcetion-network" type="hidden" value="'.get_option('wpsocialarrow-linkedin').'"></input>';
   $ncontent .= '<input id="wpsocialarrow-selected-social-network5" name="wpsocialarrow-selcetion-network" type="hidden" value="'.get_option('wpsocialarrow-pinterest').'"></input>';
   $ncontent .= '<input id="wpsocialarrow-selected-skin" type="hidden" value="'. get_option("wpsocialarrow-skins") .'"/>';
   $ncontent .= '<input id="wpsocialarrow-selected-positioning" type="hidden" value="'. get_option("wpsocialarrow-positioning") .'"/>';
   $ncontent .= '<input id="wpsocialarrow-selected-message" type="hidden" value="'. get_option("wpsocialarrow-message-selection") .'"/>';
   $ncontent .= '<input id="wpsocialarrow-selected-custom-message" type="hidden" value="'. get_option("wpsocialarrow-custom-message") .'"/>';
   $ncontent .= '<input id="wpsocialarrow-selected-alignment" type="hidden" value="'. get_option("wpsocialarrow-alignment") .'"/>';
   $ncontent .= '<input id="wpsocialarrow-selected-message-font" type="hidden" value="'. get_option("wpsocialarrow-gfonts") .'"/>';

 }
 if(get_option('wpsocialarrow-positioning') == 'afterpost'){
   return $content =$content . $ncontent;
 }

 if(get_option('wpsocialarrow-positioning') == 'beforepost'){
   return $content = $ncontent .$content;
 }

 if(get_option('wpsocialarrow-positioning') == 'both'){
   return $content = $ncontent .$content. $ncontent ;
   //$latestContent =  $ncontent.=$content.=$ncontent;
   //return $latestContent.get_option('wpsocialarrow-enable-page');
 }

 else{
   return $content;
 }


}

if(get_option('wpsocialarrow-enable-page') ==  1 ){
add_filter('the_content', 'wpssi_add_social_icons_page');
}



function wpssi_add_social_icons_home($content) {
$ncontent ='';

 if (get_option('wpsocialarrow-enable-home') == 1 && is_home() || is_front_page()) {
   global $post;
   $url = get_permalink($post->ID);
   $url = esc_url($url);
   $ncontent .= '<input id="wpsocialarrow-get-post-id" type="hidden" value="' .$url.'" />';
   $ncontent .= '<div id="wpsocialarrow-social-icons-box" class="wpsocialarrow-social-icons-box" data-selected-skin="'.get_option('wpsocialarrow-skins') .'" style="display: block;width: 100%;background-color: ;" id="wpsocialarrow-live-preview-options-settings"></div>';
   $ncontent .= '<input id="wpsocialarrow-selected-social-network1" name="wpsocialarrow-selcetion-network" type="hidden" value="'.get_option('wpsocialarrow-facebook').'"></input>';
   $ncontent .= '<input id="wpsocialarrow-selected-social-network2" name="wpsocialarrow-selcetion-network" type="hidden" value="'.get_option('wpsocialarrow-twitter').'"></input>';
   $ncontent .= '<input id="wpsocialarrow-selected-social-network3" name="wpsocialarrow-selcetion-network" type="hidden" value="'.get_option('wpsocialarrow-google').'"></input>';
   $ncontent .= '<input id="wpsocialarrow-selected-social-network4" name="wpsocialarrow-selcetion-network" type="hidden" value="'.get_option('wpsocialarrow-linkedin').'"></input>';
   $ncontent .= '<input id="wpsocialarrow-selected-social-network5" name="wpsocialarrow-selcetion-network" type="hidden" value="'.get_option('wpsocialarrow-pinterest').'"></input>';
   $ncontent .= '<input id="wpsocialarrow-selected-skin" type="hidden" value="'. get_option("wpsocialarrow-skins") .'"/>';
   $ncontent .= '<input id="wpsocialarrow-selected-positioning" type="hidden" value="'. get_option("wpsocialarrow-positioning") .'"/>';
   $ncontent .= '<input id="wpsocialarrow-selected-message" type="hidden" value="'. get_option("wpsocialarrow-message-selection") .'"/>';
   $ncontent .= '<input id="wpsocialarrow-selected-custom-message" type="hidden" value="'. get_option("wpsocialarrow-custom-message") .'"/>';
   $ncontent .= '<input id="wpsocialarrow-selected-alignment" type="hidden" value="'. get_option("wpsocialarrow-alignment") .'"/>';
   $ncontent .= '<input id="wpsocialarrow-selected-message-font" type="hidden" value="'. get_option("wpsocialarrow-gfonts") .'"/>';
   
 }
 if(get_option('wpsocialarrow-positioning') == 'afterpost'){
   return $content =$content . $ncontent;
 }

 if(get_option('wpsocialarrow-positioning') == 'beforepost'){
   return $content = $ncontent .$content;
 }

 if(get_option('wpsocialarrow-positioning') == 'both'){
   return $content = $ncontent .$content. $ncontent ;
   //$latestContent =  $ncontent.=$content.=$ncontent;
   //return $latestContent.get_option('wpsocialarrow-enable-page');
 }

 else{
   return $content;
 }


}

if(get_option('wpsocialarrow-enable-home') ==  1 ){
add_filter('the_excerpt', 'wpssi_add_social_icons_home');
add_filter('the_content', 'wpssi_add_social_icons_home');
}

register_uninstall_hook( __FILE__, 'wpssi_delete_options' ); 


require('wpsocialarrow-enque-script.php');
require('wpsocialarrow-admin.php');
require('wpsocialarrow-del-option.php');

?>