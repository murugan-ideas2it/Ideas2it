<?php 

///////////////////////////////////////////////////////////////////////////////////////
// Social Widget
///////////////////////////////////////////////////////////////////////////////////////

$icons_list = array(
	'addthis' => 'AddThis',
	'apple' => 'Apple',
	'behance' => 'Behance',
	'blogger' => 'Blogger',
	'deviantart' => 'DeviantArt',
	'digg' => 'Digg',
	'dribbble' => 'Dribbble',
	'email' => 'Email / Contact',
	'facebook' => 'Facebook',
	'feedburner' => 'Feedburner',
	'flickr' => 'Flickr',
	'forrst' => 'Forrst',
	'github' => 'GitHub',
	'googleplus' => 'Google+',
	'grooveshark' => 'Grooveshark',
	'instagram' => 'Instagram',
	'lastfm' => 'LastFM',
	'linkedin' => 'LinkedIn',
	'myspace' => 'Myspace',
	'newsvine' => 'Newsvine',
	'pinterest' => 'Pinterest',
	'rss' => 'RSS',
	'sharethis' => 'ShareThis',
	'skype' => 'Skype',
	'soundcloud' => 'SoundCloud',
	'squidoo' => 'Squidoo',
	'tumblr' => 'Tumblr',
	'twitter' => 'Twitter',
	'vimeo' => 'Vimeo',
	'vk' => 'VK',
	'windows' => 'Windows',
	'wordpress' => 'WordPress',
	'youtube' => 'YouTube',
	'zerply' => 'Zerply',
);

add_action( 'widgets_init', 'persona_social_widget_init' );

function persona_social_widget_init() {
	register_widget( 'Persona_Social_Widget' );
}

function persona_social_widget_scripts($hook){
	if('widgets.php' == $hook){
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-sortable' );

		wp_register_script( 'persona-social-widget', get_template_directory_uri() . '/theme-options/widget-social.js' );
        wp_enqueue_script( 'persona-social-widget' );

        wp_localize_script( 'persona-social-widget', 'socialwidget', array( 
			'profilelink' => __('Profile link...', 'persona'),
			'emailaddress' => __('Email address or contact page link...', 'persona'),
			'skypemessage' => __('Skype username...', 'persona'),
			)
		);
	}
}

add_action( 'admin_enqueue_scripts', 'persona_social_widget_scripts', 999 );

class persona_social_widget extends WP_Widget {
	function Persona_Social_Widget() {
		// Widget settings
		$widget_ops = array( 'classname' => 'widget-social-icons', 'description' => __('All of your social profiles on one place.', 'persona') );

		// Widget control settings
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'persona_social_widget' );

		// Create the widget
		$this->WP_Widget( 'persona_social_widget', 'Social Icons', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$template_dir = get_template_directory_uri();

		$instance_social_id = '';
		$instance_social_url = '';
		$title = '';
		$description = '';

		if(isset($instance['social-id'])){ $instance_social_id = $instance['social-id']; }
		if(isset($instance['social-url'])){ $instance_social_url = $instance['social-url']; }
		if(isset($instance['title'])){ $title = $instance['title']; }
		if(isset($instance['description'])){ $description = $instance['description']; }

		echo $before_widget;

		//////////////////////////////////////////////////
		//  Display widget title
		//////////////////////////////////////////////////

		if($title != ''){
			echo $before_title . $instance['title'] . $after_title;
		}

		//////////////////////////////////////////////////
		//  Display widget description
		//////////////////////////////////////////////////

		if($description != ''){
			echo '<p>'. $instance['description'] .'</p>';
		}

		//////////////////////////////////////////////////
		//  Display social icons
		//////////////////////////////////////////////////

		if(isset($instance['social-id'])){ $i = 0;

			echo '<div class="persona-social-icons-wrapper">';

			foreach ( $instance_social_id as $id){

				////////////////////////////////////////////////////////////////////////////////////////////////////
				// If the current icon is not empty/email/skype then echo normal <a href>
				// Else if the current icon is email and contains an email address echo <a mailto>
				// Else if the current icon is skype echo <a href="skype:">
				////////////////////////////////////////////////////////////////////////////////////////////////////

				if($id != 'empty' && $id != 'email' && $id != 'skype' || ($id == 'email' && strpos($instance_social_url[$i], '@') === false )){ ?>

					<a href="<?php echo $instance_social_url[$i]; ?>" class="<?php echo $id; ?>"><img src="<?php echo $template_dir; ?>/theme-options/social/<?php echo $id; ?>.png" alt="<?php echo $id; ?>"></a>

				<?php } else if ($id == 'email' && strpos($instance_social_url[$i],'@') != false) { ?>

					<a href="mailto:<?php echo $instance_social_url[$i]; ?>" class="<?php echo $id; ?>"><img src="<?php echo $template_dir; ?>/theme-options/social/<?php echo $id; ?>.png" alt="<?php echo $id; ?>"></a>

				<?php } else if ($id == 'skype') { ?>

					<a href="skype:<?php echo $instance_social_url[$i]; ?>" class="<?php echo $id; ?>"><img src="<?php echo $template_dir; ?>/theme-options/social/<?php echo $id; ?>.png" alt="<?php echo $id; ?>"></a>

				<?php }
				
				$i++; 

			}

			echo '</div>';

		}

		echo $after_widget;

	}
	
	//////////////////////////////////////////////////
	//  U P D A T E   W I D G E T
	//////////////////////////////////////////////////
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['social-id'] = $new_instance['social-id'];
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['description'] = $new_instance['description'];

		$social_url_check = $new_instance['social-url'];

		$i = 0;

		foreach ( $social_url_check as $url){
			$new_url = str_replace(' ', '', $url);

			if($instance['social-id'][$i] != 'email' && $instance['social-id'][$i] != 'skype'){

				if($new_url != ''){
					$social_url_prefix = substr( $new_url, 0, 4 );
					if($social_url_prefix != 'http'){
						$new_url = 'http://' . $new_url;
					}

					$social_url_check[$i] = $new_url;
				}

			} else if($instance['social-id'][$i] == 'email') {
				if (strpos($social_url_check[$i],'@') !== false) {
					$social_url_check[$i] = $new_url;
				} else {
					if($new_url != ''){
						$social_url_prefix = substr( $new_url, 0, 4 );
						if($social_url_prefix != 'http'){
							$new_url = 'http://' . $new_url;
						}

						$social_url_check[$i] = $new_url;
					}
				}

			} else if($instance['social-id'][$i] == 'skype') {
				$social_url_check[$i] = $new_url;
			}

			$i++;
		}

		$instance['social-url'] = $social_url_check;

		return $instance;
	}

	//////////////////////////////////////////////////
	//   W I D G E T   S E T T I N G S
	//////////////////////////////////////////////////
	
	function form( $instance ) {

		global $icons_list;

		// Set up some default widget settings
		$instance = wp_parse_args( (array) $instance );

		$instance_social_id = '';
		$instance_social_url = '';
		$instance_social_title = '';
		$instance_social_description = '';

		if(isset($instance['social-id'])){
			$instance_social_id = $instance['social-id'];
		}

		if(isset($instance['social-url'])){
			$instance_social_url = $instance['social-url'];
		}

		if(isset($instance['title'])){
			$instance_social_title = $instance['title'];
		}

		if(isset($instance['description'])){
			$instance_social_description = $instance['description'];
		}

		?>

		<style type="text/css">

			.persona-social-sortable{
				padding-top: 15px;
				margin-top: 10px;
				border-top: 1px solid #E7E7E7;
			}

			.persona-social-single{
				border-bottom: 1px solid #E7E7E7;
				padding-bottom: 15px;
				margin-bottom: 15px;
				overflow: hidden;
			}

			.persona-social-single.dummy{
				display: none;
			}

			.persona-social-icon-preview{
				width: 32px;
				height: 32px;
				border-radius: 3px;
				display: block;
				background-color: #EFEFEF;
				float: left;
				cursor: move;
			}

			.persona-social-icon-preview.empty{
				width: 30px;
				height: 30px;
				border: 1px dashed #D9D9D9;
			}

			<?php
				$themedir = get_template_directory_uri();
				foreach ($icons_list as $profile_id => $profile_value) {
					echo '.persona-social-icon-preview.'.$profile_id.'{ background-image: url("'.$themedir.'/theme-options/social/'.$profile_id.'.png"); }' . "\n";
				}
			?>

			.persona-social-single select.persona-profile-name{
				width: 85%;
				margin-bottom: 7px;
				float: right;
			}

			.persona-social-single input.persona-profile-link{
				width: 85%;
				float: right;
			}

			.persona-social-new{
				float: right;
				margin-bottom: 10px;
			}

			.persona-social-remove{
				color: #C1C1C1;
				float: left;
				font-weight: 900;
				margin-left: 14px;
				margin-right: 14px;
				margin-top: 5px;
				text-decoration: none;
				outline: none;
			}

			.persona-social-remove:focus{
				outline: none;
			}

			.social-widget-placeholder{
				background-color: #FFF;
				border-radius: 3px;
				padding-bottom: 15px;
				margin-bottom: 14px;
				border: 1px dashed #D9D9D9;
			}

			.persona-social-single.ui-sortable-helper{
				border-bottom: none;
			}

			.persona-social-clear{
				clear: both;
			}

			label.persona-social-title{
				padding-top: 10px;
			}

			label.persona-social-description{
				padding-top: 10px;
				float: left;
			}

			label.persona-social-description + input{
				margin-bottom: 10px;
				
			}

		</style>

		<label for="<?php echo $this->get_field_id( 'title' ); ?>" class="persona-social-title"><?php echo __('Title:', 'persona') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php echo $instance_social_title; ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" class="widefat" style="width:100%;">

		<label for="<?php echo $this->get_field_id( 'description' ); ?>" class="persona-social-description"><?php echo __('Description:', 'persona') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'description' ); ?>" value="<?php echo htmlentities($instance_social_description); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" class="widefat" style="width:100%;">

		<div class="persona-social-single dummy">
			<span class="persona-social-icon-preview empty"></span>
			<select autocomplete="off" data-id="<?php echo $this->get_field_id( 'social-id' ); ?>" class="persona-profile-name" data-name="<?php echo $this->get_field_name( 'social-id' ); ?>[]">
				<option value="empty"><?php echo __('&lt;select icon&gt;', 'persona'); ?></option>
				<?php foreach ($icons_list as $profile_id => $profile_value) {
					echo '<option value="'.$profile_id.'">'.$profile_value.'</option>'."\n";
				} ?>
			</select>
			<input data-id="<?php echo $this->get_field_id( 'social-url' ); ?>" class="persona-profile-link" type="text" placeholder="<?php echo __('Profile link...', 'persona'); ?>" data-name="<?php echo $this->get_field_name( 'social-url' ); ?>[]">
			<a href="" class="persona-social-remove">x</a>
		</div>

		<div class="persona-social-sortable">

			<?php if(isset($instance['social-id'])){ $i = 0; ?>

				<?php foreach ( $instance_social_id as $id){ ?>

					<div class="persona-social-single">
						<span class="persona-social-icon-preview <?php echo $id; ?>"></span>
						<select autocomplete="off" id="<?php echo $this->get_field_id( 'social-id' ); ?>" class="persona-profile-name" name="<?php echo $this->get_field_name( 'social-id' ); ?>[]">
							<option <?php if ( $id == 'none' ) echo 'selected="selected"'; ?> value="empty"><?php echo __('&lt;select icon&gt;', 'persona'); ?></option>
							<?php foreach ($icons_list as $profile_id => $profile_value) {
								echo '<option value="'.$profile_id.'"';
								if ( $id == $profile_id ){
									echo 'selected="selected"';
								}
								echo '>'.$profile_value.'</option>'."\n";
							} ?>
						</select>
						<?php if ($id != 'skype' && $id != 'email'){ ?>
							<input id="<?php echo $this->get_field_id( 'social-url' ); ?>" class="persona-profile-link" type="text" placeholder="<?php echo __('Profile link...', 'persona'); ?>" value="<?php echo $instance_social_url[$i]; ?>" name="<?php echo $this->get_field_name( 'social-url' ); ?>[]">
						<?php } else if ($id == 'email') { ?>
							<input id="<?php echo $this->get_field_id( 'social-url' ); ?>" class="persona-profile-link" type="text" placeholder="<?php echo __('Email address or contact page link...', 'persona'); ?>" value="<?php echo $instance_social_url[$i]; ?>" name="<?php echo $this->get_field_name( 'social-url' ); ?>[]">
						<?php } else if ($id == 'skype') { ?>
							<input id="<?php echo $this->get_field_id( 'social-url' ); ?>" class="persona-profile-link" type="text" placeholder="<?php echo __('Skype username...', 'persona'); ?>" value="<?php echo $instance_social_url[$i]; ?>" name="<?php echo $this->get_field_name( 'social-url' ); ?>[]">
						<?php } ?>
						<a href="" class="persona-social-remove">x</a>
					</div>

				<?php  $i++; } ?>

			<?php } else { ?>

				<div class="persona-social-single">
					<span class="persona-social-icon-preview empty"></span>
					<select autocomplete="off" id="<?php echo $this->get_field_id( 'social-id' ); ?>" class="persona-profile-name" name="<?php echo $this->get_field_name( 'social-id' ); ?>[]">
						<option value="empty"><?php echo __('&lt;select icon&gt;', 'persona'); ?></option>
						<?php foreach ($icons_list as $profile_id => $profile_value) {
							echo '<option value="'.$profile_id.'">'.$profile_value.'</option>'."\n";
						} ?>
					</select>
					<input id="<?php echo $this->get_field_id( 'social-url' ); ?>" class="persona-profile-link" type="text" placeholder="<?php echo __('Profile link...', 'persona'); ?>" value="<?php echo $instance_social_url; ?>" name="<?php echo $this->get_field_name( 'social-url' ); ?>[]">
					<a href="" class="persona-social-remove">x</a>
				</div>

			<?php } ?>

		</div>

		<a href="" class="persona-social-new">+ <?php echo __('Add another', 'persona'); ?></a>
		<div class="persona-social-clear"></div>

<?php

	}
} 

?>