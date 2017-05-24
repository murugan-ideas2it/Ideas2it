<?php 

	$sidebar_id = '';

	$sidebar_options = get_option('unlimited_sidebars_settings');

	if(is_singular()){
		global $post;
		$sidebar_id = get_post_meta( $post->ID, '_choose_sidebar', true );
	}

	if ($sidebar_id == '') {
		$sidebar_id = 'sidebar-main';
	}

	$sidebars = get_option('sidebars_widgets');
	unset($sidebars['array_version']);

	foreach ($sidebars as $k => $v){
		$sidebars['sidebars['.$k.']'] = $v;
		unset($sidebars[$k]);
	}

	foreach($sidebars as $index => &$inner_arr){
		$comma_separated = '';
		if(is_array($inner_arr)){
			foreach($inner_arr as &$value){
				$value = 'widget-0_'. $value;
			}
			$comma_separated .= implode(',' , $inner_arr);
		}
		$sidebars[$index] = $comma_separated;
		unset($comma_separated);
	}

?>

<script type="text/javascript">

	var sidebars = <?php echo json_encode($sidebars); ?>;

</script>


<?php if ( $sidebar_id != 'no-sidebar' && is_active_sidebar( $sidebar_id ) ) { ?>

	<div id="sidebar" data-id="<?php echo $sidebar_id; ?>" class="widget-area">
		<?php dynamic_sidebar( $sidebar_id ); ?>
	</div>

<?php } ?>