<?php 

///////////////////////////////////////////////////////////////////////////////////////
// Portfolio Widget
///////////////////////////////////////////////////////////////////////////////////////

add_action( 'widgets_init', 'persona_portfolio_widget_init' );

function persona_portfolio_widget_init() {
	register_widget( 'Persona_Portfolio_Widget' );
}

class persona_portfolio_widget extends WP_Widget {
	function Persona_Portfolio_Widget() {
		// Widget settings
		$widget_ops = array( 'classname' => 'widget-selected-portfolio', 'description' => __('Choose the portfolio item you want to display.', 'persona') );

		// Widget control settings
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'persona_portfolio_widget' );

		// Create the widget
		$this->WP_Widget( 'persona_portfolio_widget', 'Portfolio', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$template_dir = get_template_directory_uri();
		$format = get_option('date_format');

		$post_id = $instance['post-id'];

		if($post_id == 'persona-latest-portfolio'){
			$args = array(
				'post_status' => 'publish',
				'posts_per_page' => 1,
				'post_type' => 'portfolio',
				'order' => 'DESC',
			);

			$portfolio_format_query = new WP_Query($args);

			if ($portfolio_format_query->have_posts()) : while ($portfolio_format_query->have_posts()) : $portfolio_format_query->the_post(); 
				$post_id = get_the_ID();
			endwhile; endif;
		}

		$post_title = get_the_title($post_id);
		$post_permalink = get_permalink($post_id);
		$post_date = get_the_time($format, $post_id);

		if ( has_post_thumbnail($post_id) && get_post_status ( $post_id ) == 'publish' ) {
			echo $before_widget;

			echo '<a href="'. $post_permalink .'">';
			echo get_the_post_thumbnail($post_id, 'sidebar-thumbnail');
			echo '</a>';
			echo '<a href="'. $post_permalink .'">'. $post_title .'</a>';
			echo '<p class="post-date">'. $post_date .'</p>';

			echo $after_widget;
		} else {
			echo '<div class="hide">'. $before_widget;
			echo $after_widget. '</div>';
		}

	}
	
	//////////////////////////////////////////////////
	//  U P D A T E   W I D G E T
	//////////////////////////////////////////////////
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['post-id'] = $new_instance['post-id'];
		return $instance;

	}

	//////////////////////////////////////////////////
	//   W I D G E T   S E T T I N G S
	//////////////////////////////////////////////////
	
	function form( $instance ) {

		// Set up some default widget settings
		$instance = wp_parse_args( (array) $instance );
		if(isset($instance['post-id'])){
			$instance_post_id = $instance['post-id'];
		} else {
			$instance_post_id = 'persona-latest-portfolio';
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'post-id' ); ?>"><?php echo __('Portfolio:', 'persona') ?></label>
			<select id="<?php echo $this->get_field_id( 'post-id' ); ?>" name="<?php echo $this->get_field_name( 'post-id' ); ?>" class="widefat" style="width:100%;">
				<option value="persona-latest-portfolio" <?php if ( $instance_post_id == 'persona-latest-imag' ) echo 'selected="selected"'; ?>><?php echo __('&lt;show latest portfolio item&gt;', 'persona'); ?></option>
				<?php 

					$args = array(
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'post_type' => 'portfolio',
						'order' => 'DESC',
					);

					$portfolio_format_query = new WP_Query($args);

					if ($portfolio_format_query->have_posts()) : while ($portfolio_format_query->have_posts()) : $portfolio_format_query->the_post(); 
						$post_id = get_the_ID();
				 ?>
					<option value="<?php echo $post_id; ?>" <?php if ( $post_id == $instance_post_id ) echo 'selected="selected"'; ?>><?php the_title(); ?></option>
				<?php endwhile; endif; ?>
			</select>
		</p>

<?php

	}
} 


 ?>