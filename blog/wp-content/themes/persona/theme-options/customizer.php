<?php 

///////////////////////////////////////////////////////////////////////////////////////
// Theme Customizer
///////////////////////////////////////////////////////////////////////////////////////

function persona_customize_menu() {
	add_theme_page( 'Customize', 'Customize', 'edit_theme_options', 'customize.php' );
}

add_action ('admin_menu', 'persona_customize_menu');

$persona_patterns = array(
	'none'   			=> __( 'No Pattern', 'persona' ),
	'arches'   			=> __( 'Arches', 'persona' ),
	'brick-light'		=> __( 'Light Brick', 'persona' ),
	'brick-small'		=> __( 'Small Brick', 'persona' ),
	'bright-squares'	=> __( 'Bright Squares', 'persona' ),
	'cuts'				=> __( 'Cuts', 'persona' ),
	'damask-01-dark'	=> __( 'Damask Dark 01 (transparent)', 'persona' ),
	'damask-01-light'	=> __( 'Damask Light 01 (transparent)', 'persona' ),
	'damask-02-dark'	=> __( 'Damask Dark 02 (transparent)', 'persona' ),
	'damask-02-light'	=> __( 'Damask Light 02 (transparent)', 'persona' ),
	'damask-03-dark'	=> __( 'Damask Dark 03 (transparent)', 'persona' ),
	'damask-03-light'	=> __( 'Damask Light 03 (transparent)', 'persona' ),
	'damask-04-dark'	=> __( 'Damask Dark 04 (transparent)', 'persona' ),
	'damask-04-light'	=> __( 'Damask Light 04 (transparent)', 'persona' ),
	'damask-05-dark'	=> __( 'Damask Dark 05 (transparent)', 'persona' ),
	'damask-05-light'	=> __( 'Damask Light 05 (transparent)', 'persona' ),
	'diamonds'			=> __( 'Diamonds (transparent)', 'persona' ),
	'dots'				=> __( 'Dots (transparent)', 'persona' ),
	'fabric-left'		=> __( 'Fabric Left (transparent)', 'persona' ),
	'fabric-right'		=> __( 'Fabric Right (transparent)', 'persona' ),
	'grid'				=> __( 'Grid', 'persona' ),
	'grid-noise'		=> __( 'Grid Noise', 'persona' ),
	'horizontal-stripes'=> __( 'Horizontal Stripes (transparent)', 'persona' ),
	'leaf'				=> __( 'Leaf', 'persona' ),
	'light-wool'		=> __( 'Light Wool', 'persona' ),
	'maze'				=> __( 'Maze', 'persona' ),
	'noise'				=> __( 'Noise (transparent)', 'persona' ),
	'pinstripe'			=> __( 'Pinstripe', 'persona' ),
	'square'			=> __( 'Square (transparent)', 'persona' ),
	'triangles'			=> __( 'Triangles', 'persona' ),
	'vertical-dots'		=> __( 'Vertical Dots (transparent)', 'persona' ),
	'dark-pixels'		=> __( 'Dark Pixels', 'persona' ),
	'wood'				=> __( 'Wood', 'persona' ),
	'wood-light'		=> __( 'Wood Light', 'persona' ),
	'wood-dark'			=> __( 'Wood Dark', 'persona' ),
	'brick-dark'		=> __( 'Dark Brick', 'persona' ),
);

$persona_pattern_sizes = array(
	'none'   			=> '10px 10px',
	'arches'   			=> '103px 23px',
	'brick-light'		=> '1280px 668px',
	'brick-small'		=> '24px 16px',
	'bright-squares'	=> '297px 297px',
	'cuts'				=> '44px 44px',
	'damask-01-dark'	=> '103px 23px',
	'damask-01-light'	=> '103px 23px',
	'damask-02-dark'	=> '103px 23px',
	'damask-02-light'	=> '103px 23px',
	'damask-03-dark'	=> '103px 23px',
	'damask-03-light'	=> '103px 23px',
	'diamonds'			=> '10px 10px',
	'dots'				=> '4px 4px',
	'fabric-left'		=> '12px 6px',
	'fabric-right'		=> '12px 6px',
	'grid'				=> '26px 26px',
	'grid-noise'		=> '98px 98px',
	'horizontal-stripes'=> '12px 7px',
	'leaf'				=> '294px 235px',
	'light-wool'		=> '190px 191px',
	'maze'				=> '46px 23px',
	'noise'				=> '300px 300px',
	'pinstripe'			=> '50px 500px',
	'square'			=> '9px 9px',
	'triangles'			=> '188px 178px',
	'vertical-dots'		=> '12px 6px',
	'dark-pixels'		=> '200px 200px',
	'wood'				=> '400px 400px',
	'wood-light'		=> '203px 317px',
	'wood-dark'			=> '203px 317px',
	'brick-dark'		=> '96px 96px',
);


function persona_customize_register( $wp_customize ){

	global $persona_patterns;


	//////////////////////////////////////////////////////////////////////////////////
	// Textarea control
	///////////////////////////////////////////////////////////////////////////////////

	class Customizer_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';

		public function render_content() { ?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		</label>
		<?php
		}
	}

	///////////////////////////////////////////////////////////////////////////////////
	// Colors Scheme
	///////////////////////////////////////////////////////////////////////////////////

	$wp_customize->get_section('colors')->title = __( 'Color Scheme', 'persona' );
	$wp_customize->get_section('colors')->priority = 1;

	$wp_customize->add_setting( 'persona_theme_options[menu_color]' , array(
		'default'    => '#E83B3B',
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'persona_theme_options[menu_color]', array(
		'label'      => __( 'Menu Color', 'persona' ),
		'section'    => 'colors',
		'settings'   => 'persona_theme_options[menu_color]',
		'priority'   => 1,
	)));

	$wp_customize->add_setting( 'persona_theme_options[format_standard_color]' , array(
		'default'    => '#E83B3B',
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'persona_theme_options[format_standard_color]', array(
		'label'      => __( 'Standard Post Format Color', 'persona' ),
		'section'    => 'colors',
		'settings'   => 'persona_theme_options[format_standard_color]',
		'priority'   => 2,
	)));

	$wp_customize->add_setting( 'persona_theme_options[format_status_color]' , array(
		'default'    => '#EE5247',
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'persona_theme_options[format_status_color]', array(
		'label'      => __( 'Status Post Format Color', 'persona' ),
		'section'    => 'colors',
		'settings'   => 'persona_theme_options[format_status_color]',
		'priority'   => 3,
	)));

	$wp_customize->add_setting( 'persona_theme_options[format_image_color]' , array(
		'default'    => '#4782A6',
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'persona_theme_options[format_image_color]', array(
		'label'      => __( 'Image Post Format Color', 'persona' ),
		'section'    => 'colors',
		'settings'   => 'persona_theme_options[format_image_color]',
		'priority'   => 3,
	)));

	$wp_customize->add_setting( 'persona_theme_options[format_gallery_color]' , array(
		'default'    => '#45A77B',
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'persona_theme_options[format_gallery_color]', array(
		'label'      => __( 'Gallery Post Format Color', 'persona' ),
		'section'    => 'colors',
		'settings'   => 'persona_theme_options[format_gallery_color]',
		'priority'   => 4,
	)));

	$wp_customize->add_setting( 'persona_theme_options[format_video_color]' , array(
		'default'    => '#51A29D',
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'persona_theme_options[format_video_color]', array(
		'label'      => __( 'Video Post Format Color', 'persona' ),
		'section'    => 'colors',
		'settings'   => 'persona_theme_options[format_video_color]',
		'priority'   => 5,
	)));

	$wp_customize->add_setting( 'persona_theme_options[format_link_color]' , array(
		'default'    => '#9664B5',
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'persona_theme_options[format_link_color]', array(
		'label'      => __( 'Link Post Format Color', 'persona' ),
		'section'    => 'colors',
		'settings'   => 'persona_theme_options[format_link_color]',
		'priority'   => 6,
	)));

	$wp_customize->add_setting( 'persona_theme_options[format_quote_color]' , array(
		'default'    => '#E36C31',
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'persona_theme_options[format_quote_color]', array(
		'label'      => __( 'Quote Post Format Color', 'persona' ),
		'section'    => 'colors',
		'settings'   => 'persona_theme_options[format_quote_color]',
		'priority'   => 7,
	)));

	$wp_customize->add_setting( 'persona_theme_options[background_color]' , array(
		'default'    => '#F1F1F1',
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'persona_theme_options[background_color]', array(
		'label'      => __( 'Background Color', 'persona' ),
		'section'    => 'colors',
		'settings'   => 'persona_theme_options[background_color]',
		'priority'   => 8,
	)));

	$wp_customize->add_setting( 'persona_theme_options[content_style]' , array(
		'default'    => 'light',
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( 'persona_theme_options[content_style]', array(
		'label'      => __( 'Content Style', 'persona' ),
		'section'    => 'colors',
		'settings'   => 'persona_theme_options[content_style]',
		'type'       => 'radio',
		'priority'   => 11,
		'choices'    => array(
			'light'  => 'Light',
			'dark'   => 'Dark',
		)
	));

	///////////////////////////////////////////////////////////////////////////////////
	// Background Pattern
	///////////////////////////////////////////////////////////////////////////////////

	$wp_customize->add_section( 'persona_section_pattern' , array(
		'title'		 => __( 'Background Pattern', 'persona' ),
		'priority'   => 2,
	));

	$wp_customize->add_setting( 'persona_theme_options[background_pattern]' , array(
		'default'    => 'bright-squares',
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( 'persona_theme_options[background_pattern]', array(
		'label'      => __( 'Background Pattern', 'persona' ),
		'section'    => 'persona_section_pattern',
		'settings'   => 'persona_theme_options[background_pattern]',
		'type'       => 'radio',
		'priority'   => 1,
		'choices'    => $persona_patterns,
	));

	$wp_customize->add_setting( 'persona_theme_options[background_pattern_fixed]' , array(
		'default'    => true,
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( 'persona_theme_options[background_pattern_fixed]', array(
		'label'      => __( 'Fixed Background', 'persona' ),
		'settings'   => 'persona_theme_options[background_pattern_fixed]',
		'section'    => 'persona_section_pattern',
		'type'       => 'checkbox',
		'priority'   => 2,
	));

	///////////////////////////////////////////////////////////////////////////////////
	// Layout
	///////////////////////////////////////////////////////////////////////////////////

	$wp_customize->add_section( 'persona_section_layout' , array(
		'title'		 => __('Layout','persona'),
		'priority'   => 2,
	));

	$wp_customize->add_setting( 'persona_theme_options[show_header]' , array(
		'default'    => false,
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( 'persona_theme_options[show_header]', array(
		'label'      => __( 'Show Header', 'persona' ),
		'settings'   => 'persona_theme_options[show_header]',
		'section'    => 'persona_section_layout',
		'type'       => 'checkbox',
		'priority'   => 1,
	));

	$wp_customize->add_setting( 'persona_theme_options[show_header_always]' , array(
		'default'    => false,
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( 'persona_theme_options[show_header_always]', array(
		'label'      => __( 'Show Header On Every Page', 'persona' ),
		'settings'   => 'persona_theme_options[show_header_always]',
		'section'    => 'persona_section_layout',
		'type'       => 'checkbox',
		'priority'   => 2,
	));

	$wp_customize->add_setting( 'persona_theme_options[content_width]' , array(
		'default'    => 'full-size',
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( 'persona_theme_options[content_width]', array(
		'label'      => __( 'Content Width', 'persona' ),
		'section'    => 'persona_section_layout',
		'settings'   => 'persona_theme_options[content_width]',
		'type'       => 'radio',
		'priority'   => 3,
		'choices'    => array(
			'full-size' => __( 'Full Size', 'persona' ),
			'compact'   => __( 'Compact Size', 'persona' ),
		)
	));

	$wp_customize->add_setting( 'persona_theme_options[show_slider]' , array(
		'default'    => true,
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( 'persona_theme_options[show_slider]', array(
		'label'      => __( 'Show Slider', 'persona' ),
		'settings'   => 'persona_theme_options[show_slider]',
		'section'    => 'persona_section_layout',
		'type'       => 'checkbox',
		'priority'   => 4,
	));

	$wp_customize->add_setting( 'persona_theme_options[slider_size]' , array(
		'default'    => 'full',
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( 'persona_theme_options[slider_size]', array(
		'label'      => __( 'Slider Size', 'persona' ),
		'section'    => 'persona_section_layout',
		'settings'   => 'persona_theme_options[slider_size]',
		'type'       => 'radio',
		'priority'   => 5,
		'choices'    => array(
			'full'   => 'Full Size Slider',
			'compact'=> 'Compact Slider',
		)
	));

	$wp_customize->add_setting( 'persona_theme_options[show_sidebar]' , array(
		'default'    => true,
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( 'persona_theme_options[show_sidebar]', array(
		'label'      => __( 'Show Sidebar', 'persona' ),
		'settings'   => 'persona_theme_options[show_sidebar]',
		'section'    => 'persona_section_layout',
		'type'       => 'checkbox',
		'priority'   => 6,
	));

	$wp_customize->add_setting( 'persona_theme_options[sidebar_position]' , array(
		'default'    => 'left',
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( 'persona_theme_options[sidebar_position]', array(
		'label'      => __( 'Sidebar Position', 'persona' ),
		'section'    => 'persona_section_layout',
		'settings'   => 'persona_theme_options[sidebar_position]',
		'type'       => 'radio',
		'priority'   => 7,
		'choices'    => array(
			'left'   => 'Left Sidebar',
			'right'  => 'Right Sidebar',
		)
	));

	$wp_customize->get_section('title_tagline')->title = __( 'Site Title & Logo', 'persona' );

	///////////////////////////////////////////////////////////////////////////////////
	// Site Title & Logo
	///////////////////////////////////////////////////////////////////////////////////

	$wp_customize->get_section('title_tagline')->title = __( 'Site Title & Logo', 'persona' );

	$wp_customize->add_setting( 'persona_theme_options[logo]' , array(
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'persona_theme_options[logo]', array(
		'label'      => __( 'Site Logo / Avatar', 'persona' ),
		'section'    => 'title_tagline',
		'settings'   => 'persona_theme_options[logo]',
		'priority'   => 1,
	)));

	$wp_customize->add_setting( 'persona_theme_options[show_logo]' , array(
		'default'    => true,
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( 'persona_theme_options[show_logo]', array(
		'label'      => __( 'Show Logo / Avatar', 'persona' ),
		'settings'   => 'persona_theme_options[show_logo]',
		'section'    => 'title_tagline',
		'type'       => 'checkbox',
		'priority'   => 2,
	));

	$wp_customize->add_setting( 'persona_theme_options[title_text]', array(
		'default'    => '',
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( 'persona_theme_options[title_text]', array(
		'label'      => __( 'Title', 'persona' ),
		'section'    => 'title_tagline',
		'settings'   => 'persona_theme_options[title_text]',
		'type'       => 'text',
		'priority'   => 3,
	));

	$wp_customize->add_setting( 'persona_theme_options[description_text]', array(
		'default'    => '',
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( 'persona_theme_options[description_text]', array(
		'label'      => __( 'Description (can be HTML)', 'persona' ),
		'section'    => 'title_tagline',
		'settings'   => 'persona_theme_options[description_text]',
		'type'       => 'text',
		'priority'   => 4,
	));

	$wp_customize->add_setting( 'persona_theme_options[show_description]' , array(
		'default'    => true,
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( 'persona_theme_options[show_description]', array(
		'label'      => __( 'Show Title / Description', 'persona' ),
		'settings'   => 'persona_theme_options[show_description]',
		'section'    => 'title_tagline',
		'type'       => 'checkbox',
		'priority'   => 5,
	));

	$wp_customize->add_setting( 'persona_theme_options[footer_text]', array(
		'default'    => __( 'All rights reserved', 'persona' ),
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( 'persona_theme_options[footer_text]', array(
		'label'      => __( 'Footer Text', 'persona' ),
		'section'    => 'title_tagline',
		'settings'   => 'persona_theme_options[footer_text]',
		'type'       => 'text',
		'priority'   => 6,
	));

	$wp_customize->add_setting( 'persona_theme_options[favicon_image_upload]' , array(
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 'persona_theme_options[favicon_image_upload]', array(
		'label'      => __( 'Favicon', 'persona' ),
		'section'    => 'title_tagline',
		'settings'   => 'persona_theme_options[favicon_image_upload]',
		'priority'   => 7,
	)));

	///////////////////////////////////////////////////////////////////////////////////
	// Header Image
	///////////////////////////////////////////////////////////////////////////////////

	$wp_customize->add_section( 'persona_header_featured_image' , array(
		'title'		 => __('Header Image','persona'),
		'priority'   => 3,
	));

	$wp_customize->add_setting( 'persona_theme_options[header_featured_image]' , array(
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'persona_theme_options[header_featured_image]', array(
		'label'      => __( 'Header Image', 'persona' ),
		'section'    => 'persona_header_featured_image',
		'settings'   => 'persona_theme_options[header_featured_image]',
		'priority'   => 20,
	)));

	///////////////////////////////////////////////////////////////////////////////////
	// Login Image
	///////////////////////////////////////////////////////////////////////////////////

	$wp_customize->add_section( 'persona_login_image' , array(
		'title'		 => __('Login Image','persona'),
		'priority'   => 20,
	));

	$wp_customize->add_setting( 'persona_theme_options[login_image]' , array(
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'persona_theme_options[login_image]', array(
		'label'      => __( 'Login Image', 'persona' ),
		'section'    => 'persona_login_image',
		'settings'   => 'persona_theme_options[login_image]',
		'priority'   => 20,
	)));

	///////////////////////////////////////////////////////////////////////////////////
	// Additional CSS
	///////////////////////////////////////////////////////////////////////////////////

	$wp_customize->add_section( 'persona_additional_css' , array(
		'title'		 => __('Additional CSS','persona'),
		'priority'   => 999,
	));

	$wp_customize->add_setting( 'persona_theme_options[additional_css]', array(
		'default'    => '',
		'type'       => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control( new Customizer_Textarea_Control( $wp_customize, 'persona_theme_options[additional_css]', array(
		'label'      => __( 'Additional CSS', 'persona' ),
		'section'    => 'persona_additional_css',
		'settings'   => 'persona_theme_options[additional_css]',
		'priority'   => 1,
	)));



	$wp_customize->get_section('background_image')->priority = 4;
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->remove_section('static_front_page');

	$wp_customize->remove_control('header_textcolor');
	$wp_customize->remove_control('background_color');
	$wp_customize->remove_control('blogname');
	$wp_customize->remove_control('blogdescription');
	$wp_customize->remove_control('display_header_text');
	

}

add_action( 'customize_register', 'persona_customize_register' );


function persona_css_custom() {

	global $persona_pattern_sizes;

	$options = get_option('persona_theme_options'); 
	$additional_css = ''; 
	$additional_css = $options['additional_css'];
	$favicon = '';
	if(isset($options['favicon_image_upload'])){
		$favicon = $options['favicon_image_upload'];
	} ?>

	<!--Customizer CSS--> 

	<?php if ($favicon != ''){ ?>
		<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
	<?php } ?>

	<style type="text/css">

		body{
			background-color: <?php echo $options['background_color']; ?>;
		}

		<?php 

			if(isset($options['header_image'])){

				$option_name = 'persona_theme_options';

				if($options['header_image'] != ''){
					if($options['header_featured_image'] == ''){
						$options['header_featured_image'] = $options['header_image'];
					}
					unset($options['header_image']);
					update_option( $option_name, $options );
				}
				
			}

			if ($options['header_featured_image'] != ''){ ?>

				#header{
					background-image: url("<?php echo $options['header_featured_image']; ?>");
				}

			<?php } ?>

		a.menu-toggle, ul#pagination li a.selected, #nav-menu, #slider p.slide-description, .content span.more-text,
		table#wp-calendar a:hover, table tfoot td a:hover, ul.comments li.show-all a:hover, #nav-menu > .search form, #nav-menu > .search div.active,
		.post a.share-button:hover, .post a.share-button.active, .page a.share-button:hover, .page a.share-button.active,
		.page ul.tags li a:hover:before, .respond input[type='submit'], article a.share-button:hover, article a.share-button.active{
			background-color: <?php echo $options['menu_color']; ?> !important;
			-webkit-transition: background-color 0.2s ease;
			-moz-transition: background-color 0.2s ease;
			transition: background-color 0.2s ease;
		}

		ul.tags li a:hover, .post ul.tags li a:hover:before{
			background-color: <?php echo $options['menu_color']; ?> !important;
			-moz-transition: background-color 0.2s ease; 
			transition: background-color 0.2s ease;
		}

		a.gallery-thumbnail.active:before{
			box-shadow: inset 0 0 0 3px <?php echo $options['menu_color']; ?>;
			-moz-box-shadow: inset 0 0 0 3px <?php echo $options['menu_color']; ?>;
			-webkit-box-shadow: inset 0 0 0 3px <?php echo $options['menu_color']; ?>;
		}

		#portfolio-meta{
			border-bottom: 4px solid <?php echo $options['menu_color']; ?>;
		}

		.content a, .page-links a, #footer a, #footer a:hover, #sidebar .widget-selected-image a, #sidebar ul li a:hover, #sidebar .widget-selected-portfolio a, ul.comments a, ul.portfolio-list a, h1.title a:hover{
			color: <?php echo $options['menu_color']; ?>;
			-webkit-transition: color 0.2s ease; 
			-moz-transition: color 0.2s ease; 
			transition: color 0.2s ease;
		}

		.post .format-all, .page .format-all{
			background-color: <?php echo $options['format_standard_color']; ?>;
		}

		#content .sticky a.format-all,
		.post.format-status .format-all{
			background-color: <?php echo $options['format_status_color']; ?>;
		}

		.post.format-image .format-all{
			background-color: <?php echo $options['format_image_color']; ?>;
		}

		.post.format-gallery .format-all{
			background-color: <?php echo $options['format_gallery_color']; ?>;
		}

		.post.format-video .format-all{
			background-color: <?php echo $options['format_video_color']; ?>;
		}

		.post.format-quote .format-all{
			background-color: <?php echo $options['format_quote_color']; ?>;
		}

		.post.format-link .format-all{
			background-color: <?php echo $options['format_link_color']; ?>;
		}

		<?php

		$current_pattern = $options['background_pattern'];

		if($current_pattern != 'none'){ ?>
				body{
					background-image: url("<?php echo get_template_directory_uri().'/images/patterns/'; echo $current_pattern; ?>.png");
				}

				@media screen and
					(-o-min-device-pixel-ratio: 5/4),
					(-webkit-min-device-pixel-ratio: 1.25),
					(min-resolution: 120dpi) {
						body{
							background-image: url("<?php echo get_template_directory_uri().'/images/patterns/'; echo $current_pattern; ?>@2x.png");
							background-size: <?php echo $persona_pattern_sizes[$current_pattern]; ?>;
						}
					}
		<?php } ?>

		<?php if($options['background_pattern_fixed'] == true){ ?>
			body{
				background-attachment: fixed;	
			}
		<?php } ?>
			
	</style>
	<!--/Customizer CSS-->

	<?php if($additional_css != ''){ ?>
		<!--Additional CSS--> 
		<style type="text/css">
			<?php echo $additional_css; ?>
		</style>
		<!--/Additional CSS-->
	<?php } ?>

<?php }

add_action( 'wp_head', 'persona_css_custom' );


function persona_login_image() {

	$options = get_option('persona_theme_options'); 

	if($options['login_image'] != ''){
	?>

	<style type="text/css">
		h1 a{ background-image: url("<?php echo $options['login_image']; ?>") !important; background-size: auto !important; margin-bottom: 10px !important; }
	</style>

<?php }
}

add_action('login_head', 'persona_login_image', 999);

function persona_login_image_url() {
    return home_url('/');
}
add_filter( 'login_headerurl', 'persona_login_image_url' );

function persona_login_image_title() {
    return get_option('blogname');
}
add_filter( 'login_headertitle', 'persona_login_image_title' );


function persona_body_class($classes) {

	$options = get_option('persona_theme_options');

	if($options['content_style'] == 'dark'){
		$classes[] = 'dark-color-scheme';
	}

	if($options['content_width'] == 'full-size'){
		$classes[] = 'full-width';
	} else {
		$classes[] = 'compact-layout';
	}

	if($options['show_header'] == false){
		$classes[] = 'header-off';	
	}

	if($options['show_header'] == true && $options['show_header_always'] == false){
		$classes[] = 'header-on';
	}

	if($options['show_header'] == true && $options['show_header_always'] == true){
		$classes[] = 'header-on-always';
	}

	if($options['show_sidebar'] == true && $options['sidebar_position'] == 'left'){
		$classes[] = 'sidebar-on-left';
	}

	if($options['show_sidebar'] == true && $options['sidebar_position'] == 'right'){
		$classes[] = 'sidebar-on-right';
	}

	if($options['show_sidebar'] == false){
		$classes[] = 'sidebar-off';
	}

	return $classes;
}

add_filter('body_class','persona_body_class');



function persona_customize_preview() {
	wp_enqueue_script( 'persona-live', get_template_directory_uri().'/script/theme-customizer.js', array( 'jquery','customize-preview' ));

	$options = get_option('persona_theme_options');
	$logo = '';
	$logo = $options['logo'];

	$title_text = get_bloginfo('name');
	$description_text = get_bloginfo('description');

	ob_start();
		get_template_part('header', 'featured');
		$header_html = ob_get_contents();
	ob_end_clean();

	ob_start();
		get_template_part('slider', 'template');
		$slider_html = ob_get_contents();
	ob_end_clean();

	ob_start(); ?>
		<div id="sidebar" data-id="sidebar-main" class="widget-area">
			<?php dynamic_sidebar('sidebar-main'); ?>
		</div> <?php
		$sidebar_html = ob_get_contents();
	ob_end_clean();

	wp_localize_script( 'persona-live', 'personaCustomizer', array( 
		'ajaxurl'    => admin_url( 'admin-ajax.php' ),
		'useravatar' => get_avatar( get_bloginfo('admin_email'), 130 ),
		'header'     => $header_html,
		'slider'     => $slider_html,
		'sidebar'    => $sidebar_html,
		'title_text' => $title_text,
		'description_text' => $description_text,
		'themeurl'   => get_template_directory_uri() .'/images/patterns/',
		)
	);
}

add_action( 'customize_preview_init', 'persona_customize_preview' );



function persona_customize_toggler(){ global $persona_patterns; ?>

	<script type="text/javascript">
		jQuery(document).ready(function($) {

			function trimspace(str) {
				return str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
			}

			$('#customize-theme-controls input:radio').each(function() {
				var $this = $(this);

				var labelclass = $this.val().replace(/\s+/g, '-').toLowerCase();
				$this.parent('label').addClass(labelclass);

				var title = trimspace($this.parent().text());
				$this.parent().attr('title', title);
			});

			setTimeout(function(){ $('#customize-theme-controls input[type=radio]:checked').parent('label').addClass('selected'); }, 10);

			$('#customize-control-persona_theme_options-slider_size input, #customize-control-persona_theme_options-sidebar_position input, #customize-control-persona_theme_options-content_width input, #customize-control-persona_theme_options-background_pattern input').on('click', function(){
				$(this).parent('label').addClass('selected').siblings().removeClass('selected');
			});

			$('li#customize-control-persona_theme_options-show_slider input, #customize-control-persona_theme_options-show_sidebar input, #customize-control-persona_theme_options-show_header input').on('click', function(){
				$(this).closest('li').next().slideToggle();
			});

			$('#customize-control-persona_theme_options-show_sidebar input').on('click', function(){
				if( $('li#customize-control-persona_theme_options-show_sidebar input').is(':checked') ){
					$('#customize-control-persona_theme_options-sidebar_position label.left input').trigger('click');
				}
			});

			$('#customize-control-persona_theme_options-show_slider input').on('click', function(){
				if( $('li#customize-control-persona_theme_options-show_slider input').is(':checked') ){
					$('#customize-control-persona_theme_options-slider_size label.full input').trigger('click');
				}
			});

			if( $('li#customize-control-persona_theme_options-show_slider input').is(':checked') ){
				$('li#customize-control-persona_theme_options-slider_size').show();
			}

			if( $('li#customize-control-persona_theme_options-show_sidebar input').is(':checked') ){
				$('li#customize-control-persona_theme_options-sidebar_position').show();
			}

			if( $('li#customize-control-persona_theme_options-show_header input').is(':checked') ){
				$('li#customize-control-persona_theme_options-show_header_always').show();
			}

		});
	</script>

	<style type="text/css">

		#customize-control-persona_theme_options-slider_size,
		#customize-control-persona_theme_options-sidebar_position,
		#customize-control-persona_theme_options-show_header_always{
			display: none;
		}

		#customize-control-persona_theme_options-background_pattern input,
		#customize-control-persona_theme_options-content_width input,
		#customize-control-persona_theme_options-slider_size input,
		#customize-control-persona_theme_options-sidebar_position input{
			position: absolute;
			left: -9999px;
		}

		#customize-control-persona_theme_options-background_pattern label,
		#customize-control-persona_theme_options-content_width label,
		#customize-control-persona_theme_options-slider_size label,
		#customize-control-persona_theme_options-sidebar_position label{
			float: left;
			display: block;
			width: 81px; 
			margin-top: 10px;
			text-indent: -9999px;
			white-space: nowrap;
			height: 66px;
			padding: 6px;
			background-color: #FFF;
			border-radius: 4px;
			border: 3px solid #d7d7d7;
			background-image: url("<?php echo get_template_directory_uri() ?>/images/admin/content-width.png");
			background-position: 0 0;
		}

		#customize-control-persona_theme_options-slider_size label{
			background-image: url("<?php echo get_template_directory_uri() ?>/images/admin/slider-size.png");
		}

		#customize-control-persona_theme_options-sidebar_position label{
			background-image: url("<?php echo get_template_directory_uri() ?>/images/admin/sidebar-position.png");
		}

		#customize-control-persona_theme_options-content_width label.compact,
		#customize-control-persona_theme_options-slider_size label.compact,
		#customize-control-persona_theme_options-sidebar_position label.right{
			background-position: 0 -122px;
			margin-left: 30px;
		}

		#customize-control-persona_theme_options-background_pattern label.selected,
		#customize-control-persona_theme_options-content_width label.selected,
		#customize-control-persona_theme_options-slider_size label.selected,
		#customize-control-persona_theme_options-sidebar_position label.selected{
			border: 3px solid #5b9af9;
			-webkit-transition: all 0.2s ease-in-out;
			-moz-transition: all 0.2s ease-in-out;
			-o-transition: all 0.2s ease-in-out;
			transition: all 0.2s ease-in-out;
		}

		#customize-control-persona_theme_options-background_pattern label{
			width: 50px;
			height: 50px;
			margin: 10px 10px 0 0;
			padding: 0;
		}

		<?php foreach ($persona_patterns as $pattern => $value) { ?>
			#customize-control-persona_theme_options-background_pattern label.<?php echo $pattern; ?>{
				<?php if($pattern == 'brick-light' || $pattern == 'sand'){ ?>
					background-image: url("<?php echo get_template_directory_uri().'/images/patterns/'; echo $pattern; ?>.jpg");
					background-size: 100px 100px;
				<?php } else { ?>
					background-image: url("<?php echo get_template_directory_uri().'/images/patterns/'; echo $pattern; ?>.png");
				<?php } ?>
			}
		<?php } ?>
		
	</style>
<?php }

add_action( 'customize_controls_print_scripts',  'persona_customize_toggler', 999);

function initial_persona_setup(){
	$options = get_option('persona_theme_options');
	if($options == ''){
		$defaults = array(
			'menu_color' => '#6ac2c0',
			'format_standard_color' => '#E83B3B',
			'format_status_color' => '#EE5247',
			'format_image_color' => '#4782A6',
			'format_gallery_color' => '#45A77B',
			'format_video_color' => '#51A29D',
			'format_quote_color' => '#E36C31',
			'format_link_color' => '#9664B5',
			'background_color' => '#F1F1F1',
			'content_style' => 'light',
			'background_pattern' => 'bright-squares',
			'background_pattern_fixed' => true,
			'show_header' => false,
			'show_header_always' => false,
			'content_width' => 'full-size',
			'show_slider' => true,
			'slider_size' => 'full',
			'show_sidebar' => true,
			'login_image' => '',
			'header_featured_image' => '',
			'sidebar_position' => 'left',
			'footer_text' => __( 'All rights reserved', 'persona' ),
			'show_sidebar' => true,
			'show_logo' => true,
			'show_description' => true,
			'title_text' => '',
			'favicon_image_upload' => '',
			'description_text' => '',
			'additional_css' => '',
		);
		add_option('persona_theme_options', $defaults);
	}
}

add_action( 'after_setup_theme', 'initial_persona_setup' );

?>