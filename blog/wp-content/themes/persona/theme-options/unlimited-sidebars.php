<?php 

///////////////////////////////////////////////////////////////////////////////////////
// Page For Creating New Sidebars
///////////////////////////////////////////////////////////////////////////////////////

function add_unlimited_sidebars() {
	$options = get_option('persona_theme_options'); 
	if($options['show_sidebar'] == true){
		add_theme_page('Sidebars', 'Sidebars', 'edit_theme_options', 'persona-sidebars', 'unlimited_sidebars');
	}
}

add_action('admin_menu', 'add_unlimited_sidebars');


function init_unlimited_sidebars(){
	register_setting( 'unlimited_sidebars_settings', 'unlimited_sidebars_settings');
	add_settings_section('unlimited_sidebars_section', '', '', 'persona-sidebars');
	add_settings_field('settings_unlimited_sidebars', '', 'settings_unlimited_sidebars', 'persona-sidebars', 'unlimited_sidebars_section');
}

add_action('admin_init', 'init_unlimited_sidebars');


function settings_unlimited_sidebars() {
	$options = get_option('unlimited_sidebars_settings');

	if (isset($_GET['settings-updated'])) {
		if ($_GET['settings-updated'] == true){ ?>
			<div id="message" class="updated below-h2">
				<p><?php echo __('Sidebar settings updated.', 'persona'); ?></p>
			</div>
		<?php }
	} ?>

	<div id="add-new-item">
		<input class="new-item-name" autocomplete="off" type="text" placeholder="<?php echo __('Sidebar name...', 'persona'); ?>" />
		<input class="add-item button button-primary button-large" type="submit" value="<?php echo __('Add Sidebar', 'persona'); ?>" />
	</div>

	<div class="repeatables-wrap sortable-wrap">

		<input name="unlimited_sidebars_settings" type="hidden" class="item-name-input" value="" />

		<div id="dummy-item-placeholder" class="item-holder hidden">
			<div class="repeatable-name">
				<div class="item-move"></div>
				<h4></h4>
			</div>
			<div class="item-info">
				<input autocomplete="off" placeholder="<?php echo __('Sidebar name...', 'persona'); ?>" name="[name]" type="text" class="item-name-input" value="" />
				<a class="delete-single-repeat" href=""><?php echo __('Delete Sidebar', 'persona'); ?></a>
			</div>
		</div>

		<?php if(!$options){ ?>

			<h4 class="no-items"><?php echo __('There are no extra sidebars currently, add one!', 'handbook'); ?></h4>

		<?php } else { ?>

			<?php foreach ($options as $sidebar_id => $sidebar_name) { ?>

				<div id="<?php echo $sidebar_id ?>" class="item-holder">
					<div class="repeatable-name">
						<div class="item-move"></div>
						<h4><?php echo $sidebar_name['name']; ?></h4>
					</div>
					<div class="item-info">
						<input autocomplete="off" placeholder="<?php echo __('Sidebar name...', 'persona'); ?>" name="unlimited_sidebars_settings[<?php echo $sidebar_id; ?>][name]" type="text" class="item-name-input" value="<?php echo $sidebar_name['name']; ?>" />
						<a class="delete-single-repeat" href=""><?php echo __('Delete Sidebar', 'persona'); ?></a>
					</div>
				</div>
			<?php } ?>

		<?php } ?>

	</div>
	<?php
}

function unlimited_sidebars(){

	global $post;

	if (!current_user_can('manage_options')) {  
		wp_die( __('You do not have sufficient permissions to access this page.', 'persona') );  
	}

	wp_register_script( 'script-backend', get_template_directory_uri() . '/theme-options/script/script-repeatable.js' );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-sortable' ); 
	wp_enqueue_script( 'script-backend' );

	wp_register_style( 'admin-backend-style', get_template_directory_uri() . '/theme-options/style/style-repeatable.css' );
	wp_enqueue_style( 'admin-backend-style' );

	wp_localize_script( 'script-backend', 'personaSidebars', array(
		'alert' => __('Are you sure you want to delete this sidebar?', 'persona'),
		)
	);

	?>

	<div class="wrap">
		<div id="icon-themes" class="icon32">
			<br>
		</div>
		<h2><?php echo __('Sidebars', 'persona'); ?></h2>
		<p><?php echo __('Add a new sidebar which you can then use on any post or page by selecting it from the "Sidebars" metabox. Number of sidebars is unlimited.', 'persona'); ?></p>

		<form action="options.php" method="post" class="repeatable-form unlimited-sidebars-form">
			<?php settings_fields('unlimited_sidebars_settings'); ?>
			<?php do_settings_sections('persona-sidebars'); ?>
			<input class="button button-primary button-large" type="submit" value="<?php echo __('Update Sidebars', 'persona'); ?>" name="save">
		</form>
	</div>
<?php }


function persona_sidebar_body_class($classes) {

	$sidebar_id = '';

	if(is_singular()){
		global $post;
		$sidebar_id = get_post_meta( $post->ID, '_choose_sidebar', true );
	}

	if($sidebar_id == 'no-sidebar'){
		$remove_classes = array('sidebar-on-right', 'sidebar-on-left');
		$classes = array_diff($classes, $remove_classes);
		$classes[] = 'sidebar-off';
	}

	return $classes;

}

add_filter('body_class','persona_sidebar_body_class');

?>