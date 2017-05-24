<?php
/**
 * @package WordPress
 * @subpackage shoreditch-child
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since Shoreditch 1.0
 */

/**
 * Shoreditch Child Theme Functions
 * Add custom code below
*/ 

// add_action( 'wp_enqueue_scripts', 'theme_enqueue_child_styles', 9999 );
// function theme_enqueue_child_styles() {       
//     wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . 'style.css' );
// }
//function the_custom_logo(){
//	echo "<a href='".site_url()."'><img src='".get_stylesheet_directory_uri()."/assets/images/ideas2itLogo.png'></a>";
//}

function shoreditch_the_custom_logo(){
	$main="http://www.ideas2it.com/";
	echo "<a href='".$main."'><img src='".get_stylesheet_directory_uri()."/assets/images/ideas2itLogo.png'></a>";
}
add_shortcode( 'contactform', 'contactform_shortcode' );
    function contactform_shortcode($atts,$content = null)
    {
        extract(shortcode_atts(array('topcontent' => '', 'bottomcontent' => '', 'linktext' => '', 'link' => '', 'link_color'=> ''),$atts));
        
        $output = '';
        $output .= '<div class="row contactform_div">';
        $output .= '    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 contactfor_form_section" >';
        $output .= '       <p class="contactform-top-content">'.$topcontent.'</p>';
        $output .= '       <form class="form-inline post-contactform">';
        $output .= '<div class="input-group">';
        $output .= '<input type="text" class="form-control" name="email_id" id="email_id" placeholder="Enter email address">';
        $output .= '<span class="input-group-btn">';
        $output .= '<button class="btn btn-default" id="contact_mail" type="button">Get Started</button>';
        $output .= '</span>';
        $output .= '</div>';
        $output .= '<div class="input-group">';
        $output .= '<p class="errorMsg1" style="color:#FF5252 !important;font-weight:bold; display:none;postion:static;text-align: center;">Please enter valid email address!</p>';
        $output .= '</div>';
        $output .= '</form>';
        $output .= '    </div>';
        $output .= '<div class="success_box row" style="display:none;">';
        $output .= '    <div class="success_message_left_image col-md-3">';
        $output .= '        <img src="'.get_stylesheet_directory_uri().'/assets/images/tick.png" alt="" class="img-responsive">';
        $output .= '    </div>';
        $output .= '    <div class="success_box_content col-md-9">';
        $output .= '        <span class="success_message_header">Thank you for contacting us!</span> <br>';
        $output .= '        <span class="success_message_content">One of our solution experts will get in touch with you shortly.</span>';
        $output .= '    </div>';
        $output .= '</div>';
        $output .= '       <p class="contactform-bottom-content">'.$bottomcontent.' <a href="'.$link.'" target="_blank">'.$linktext.'</a></p>';
        $output .= '</div>';

        return $output;
    }
    /**
 * Enqueue scripts and styles.
 */
function shoreditch_child_scripts() {
    wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), true );
}
add_action( 'wp_enqueue_scripts', 'shoreditch_child_scripts' );


add_filter('comment_form_defaults','add_google_captcha');

function add_google_captcha($default) {
    $default['comment_notes_after']='<div class="g-recaptcha" data-sitekey="6LdhlSAUAAAAAFS_Ijdx1zR2cQsO9-SVBT2BP4kL"></div>';
    return $default;
}
?>
