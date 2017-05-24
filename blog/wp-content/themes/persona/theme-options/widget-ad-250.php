<?php 

///////////////////////////////////////////////////////////////////////////////////////
// Ad Unit 250px Width
///////////////////////////////////////////////////////////////////////////////////////

add_action( 'widgets_init', 'persona_ad_250' );

function persona_ad_250() {
	register_widget( 'Persona_Ad_250' );
}

class Persona_Ad_250 extends WP_Widget {
	function Persona_Ad_250() {
		// Widget settings
		$widget_ops = array( 'classname' => 'widget-ad-unit-250', 'description' => __('Ad Unit for 250px width banners.', 'persona') );

		// Widget control settings
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'persona_ad_250' );

		// Create the widget
		$this->WP_Widget( 'persona_ad_250', 'Ad Unit 250px Width', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$ad_250 = '';

		if(isset($instance['ad-250'])){ $ad_250 = $instance['ad-250']; }

		if($ad_250 != ''){
			echo $before_widget;
			echo $ad_250;
			echo $after_widget;
		}

	}
	
	//////////////////////////////////////////////////
	//  U P D A T E   W I D G E T
	//////////////////////////////////////////////////
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['ad-250'] = $new_instance['ad-250'];
		return $instance;

	}

	//////////////////////////////////////////////////
	//   W I D G E T   S E T T I N G S
	//////////////////////////////////////////////////
	
	function form( $instance ) {

		// Set up some default widget settings
		$instance = wp_parse_args( (array) $instance );
		if(isset($instance['ad-250'])){
			$instance_ad_250 = $instance['ad-250'];
		} else {
			$instance_ad_250 = '';
		}
		?>

		<label for="<?php echo $this->get_field_id( 'ad-250' ); ?>"><?php echo __('Paste the Ad code here:', 'persona') ?></label>
		<textarea rows="15" id="<?php echo $this->get_field_id( 'ad-250' ); ?>" name="<?php echo $this->get_field_name( 'ad-250' ); ?>" class="widefat" style="width:100%;"><?php if ($instance_ad_250 != '') { echo $instance_ad_250; } ?></textarea>
<?php

	}
} 


 ?>