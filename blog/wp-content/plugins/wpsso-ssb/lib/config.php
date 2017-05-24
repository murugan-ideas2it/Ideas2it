<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2017 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) 
	die( 'These aren\'t the droids you\'re looking for...' );

if ( ! class_exists( 'WpssoSsbConfig' ) ) {

	class WpssoSsbConfig {

		public static $cf = array(
			'plugin' => array(
				'wpssossb' => array(
					'version' => '2.4.1',		// plugin version
					'opt_version' => '16',		// increment when changing default options
					'short' => 'WPSSO SSB',		// short plugin name
					'name' => 'WPSSO Social Sharing Buttons',
					'desc' => 'WPSSO extension to add Social Sharing Buttons with support for hashtags, short URLs, bbPress, BuddyPress, WooCommerce, and much more.',
					'slug' => 'wpsso-ssb',
					'base' => 'wpsso-ssb/wpsso-ssb.php',
					'update_auth' => 'tid',
					'text_domain' => 'wpsso-ssb',
					'domain_path' => '/languages',
					'req' => array(
						'short' => 'WPSSO',
						'name' => 'WPSSO',
						'min_version' => '3.44.0',
					),
					'img' => array(
						'icons' => array(
							'low' => 'images/icon-128x128.png',
							'high' => 'images/icon-256x256.png',
						),
					),
					'lib' => array(
						// submenu items must have unique keys
						'submenu' => array (
							'ssb-buttons' => 'Sharing Buttons',
							'ssb-styles' => 'Sharing Styles',
						),
						'website' => array(
							'email' => 'Email',
							'twitter' => 'Twitter',
							'facebook' => 'Facebook', 
							'gplus' => 'GooglePlus',
							'pinterest' => 'Pinterest',
							'linkedin' => 'LinkedIn',
							'buffer' => 'Buffer',
							'reddit' => 'Reddit',
							'managewp' => 'ManageWP',
							'stumbleupon' => 'StumbleUpon',
							'tumblr' => 'Tumblr',
							'youtube' => 'YouTube',
							'skype' => 'Skype',
							'whatsapp' => 'WhatsApp',
						),
						'shortcode' => array(
							'sharing' => 'Sharing Shortcode',
						),
						'widget' => array(
							'sharing' => 'Sharing Widget',
						),
						'gpl' => array(
							'admin' => array(
								'sharing' => 'Sharing Settings',
							),
							'ecom' => array(
								'woocommerce' => '(plugin) WooCommerce',
							),
							'forum' => array(
								'bbpress' => '(plugin) bbPress',
							),
							'social' => array(
								'buddypress' => '(plugin) BuddyPress',
							),
						),
						'pro' => array(
							'admin' => array(
								'sharing' => 'Sharing Settings',
							),
							'ecom' => array(
								'woocommerce' => '(plugin) WooCommerce',
							),
							'forum' => array(
								'bbpress' => '(plugin) bbPress',
							),
							'social' => array(
								'buddypress' => '(plugin) BuddyPress',
							),
						),
					),
				),
			),
			'opt' => array(				// options
				'preset' => array(
					'small_share_count' => array(
						// Twitter
						'twitter_size' => 'medium',
						'twitter_count' => 'horizontal',
						// Facebook
						'fb_button' => 'share',			// Button Type
						'fb_send' => 0,				// Like and Send: Include Send
						'fb_layout' => 'button_count',		// Like and Send: Layout
						'fb_show_faces' => 0,			// Like and Send: Show Faces
						'fb_action' => 'like',			// Like and Send: Action Name
						'fb_share_layout' => 'button_count',	// Share: Layout
						'fb_share_size' => 'small',		// Share: Button Size
						// Google+
						'gp_action' => 'share',
						'gp_size' => 'medium',
						'gp_annotation' => 'bubble',
						'gp_expandto' => '',
						// LinkedIn
						'linkedin_counter' => 'right',
						'linkedin_showzero' => 1,
						// Pinterest
						'pin_button_shape' => 'rect',
						'pin_button_height' => 'small',
						'pin_count_layout' => 'beside',
						// Buffer
						'buffer_count' => 'horizontal',
						// Reddit
						'reddit_type' => 'static-wide',
						// ManageWP
						'managewp_type' => 'small',
						// StumbleUpon
						'stumble_badge' => 1,
						// Tumblr
						'tumblr_counter' => 'right',
					),
					'large_share_vertical' => array(
						// Twitter
						'twitter_size' => 'medium',
						'twitter_count' => 'vertical',
						// Facebook
						'fb_button' => 'share',			// Facebook Button Type
						'fb_send' => 0,				// Like and Send: Include Send
						'fb_layout' => 'box_count',		// Like and Send: Layout
						'fb_show_faces' => 0,			// Like and Send: Show Faces
						'fb_action' => 'like',			// Like and Send: Action Name
						'fb_share_layout' => 'box_count',	// Share: Layout
						'fb_share_size' => 'small',		// Share: Button Size
						// Google+
						'gp_action' => 'share',
						'gp_size' => 'tall',
						'gp_annotation' => 'vertical-bubble',
						'gp_expandto' => '',
						// LinkedIn
						'linkedin_counter' => 'top',
						'linkedin_showzero' => '1',
						// Pinterest
						'pin_button_shape' => 'rect',
						'pin_button_height' => 'large',
						'pin_count_layout' => 'above',
						// Buffer
						'buffer_count' => 'vertical',
						// Reddit
						'reddit_type' => 'static-tall-text',
						// ManageWP
						'managewp_type' => 'big',
						// StumbleUpon
						'stumble_badge' => 5,
						// Tumblr
						'tumblr_counter' => 'top',
					),
				),
			),
			'sharing' => array(
				'show_on' => array( 
					'content' => 'Content', 
					'excerpt' => 'Excerpt', 
					'sidebar' => 'CSS Sidebar', 
					'admin_edit' => 'Admin Edit',
				),
				'force_prot' => array( 
					'http' => 'HTTP',
					'https' => 'HTTPS',
				),
				'ssb_styles' => array(
					'ssb-sharing' => 'All Buttons',
					'ssb-content' => 'Content',
					'ssb-excerpt' => 'Excerpt',
					'ssb-sidebar' => 'CSS Sidebar',
					'ssb-admin_edit' => 'Admin Edit',
					'ssb-shortcode' => 'Shortcode',
					'ssb-widget' => 'Widget',
				),
				'position' => array(
					'top' => 'Top',
					'bottom' => 'Bottom',
					'both' => 'Top and Bottom',
				),
				'platform' => array(
					'desktop' => 'Desktop Only',
					'mobile' => 'Mobile Only',
					'any' => 'Any Platform',
				),
			),
		);

		public static function get_version() { 
			return self::$cf['plugin']['wpssossb']['version'];
		}

		public static function set_constants( $plugin_filepath ) { 
			define( 'WPSSOSSB_FILEPATH', $plugin_filepath );						
			define( 'WPSSOSSB_PLUGINDIR', trailingslashit( realpath( dirname( $plugin_filepath ) ) ) );
			define( 'WPSSOSSB_PLUGINSLUG', self::$cf['plugin']['wpssossb']['slug'] );	// wpsso-ssb
			define( 'WPSSOSSB_PLUGINBASE', self::$cf['plugin']['wpssossb']['base'] );	// wpsso-ssb/wpsso-ssb.php
			define( 'WPSSOSSB_URLPATH', trailingslashit( plugins_url( '', $plugin_filepath ) ) );
			self::set_variable_constants();
		}

		public static function set_variable_constants() { 
			foreach ( self::get_variable_constants() as $name => $value )
				if ( ! defined( $name ) )
					define( $name, $value );
		}

		public static function get_variable_constants() { 
			$var_const = array();
			$var_const['WPSSOSSB_SHARING_SHORTCODE_NAME'] = 'ssb';

			/*
			 * WPSSO SSB hook priorities
			 */
			$var_const['WPSSOSSB_HEAD_PRIORITY'] = 10;
			$var_const['WPSSOSSB_SOCIAL_PRIORITY'] = 100;
			$var_const['WPSSOSSB_FOOTER_PRIORITY'] = 100;

			foreach ( $var_const as $name => $value )
				if ( defined( $name ) )
					$var_const[$name] = constant( $name );	// inherit existing values
			return $var_const;
		}

		public static function require_libs( $plugin_filepath ) {
			require_once WPSSOSSB_PLUGINDIR.'lib/register.php';
			require_once WPSSOSSB_PLUGINDIR.'lib/functions.php';
			require_once WPSSOSSB_PLUGINDIR.'lib/sharing.php';

			add_filter( 'wpssossb_load_lib', array( 'WpssoSsbConfig', 'load_lib' ), 10, 3 );
		}

		public static function load_lib( $ret = false, $filespec = '', $classname = '' ) {
			if ( $ret === false && ! empty( $filespec ) ) {
				$filepath = WPSSOSSB_PLUGINDIR.'lib/'.$filespec.'.php';
				if ( file_exists( $filepath ) ) {
					require_once $filepath;
					if ( empty( $classname ) )
						return SucomUtil::sanitize_classname( 'wpssossb'.$filespec, false );	// $underscore = false
					else return $classname;
				}
			}
			return $ret;
		}
	}
}

?>
