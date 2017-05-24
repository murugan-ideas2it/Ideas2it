<?php
/**
 * The template for displaying featured header image and info
 *
 */
?>

<?php 

$options = get_option('persona_theme_options');
$logo = $title = $description = '';

if(isset($options['logo'])){
	$logo = $options['logo'];
}

if(isset($options['title_text'])){
	$title = $options['title_text'];
}

if(isset($options['description_text'])){
	$description = $options['description_text'];
}

$show_logo = false;
if(isset($options['show_logo'])){
	$show_logo = $options['show_logo'];
}

$show_description = false;
if(isset($options['show_description'])){
	$show_description = $options['show_description'];
}

?>

<div id="header">

	<?php if($show_logo == true){ ?>

		<div class="avatar">
			<?php if($logo!=''){ ?>
				<img src="<?php echo $options['logo']; ?>" alt="<?php bloginfo('name'); ?>">
			<?php } else {
				echo get_avatar( get_bloginfo('admin_email') , 200 );
			} ?>
			<div class="mark"></div>
		</div>

	<?php } ?>


	<?php if($show_description == true){ ?>

		<div id="info">
			<?php if($title != ''){ ?>
				<h1><a href="<?php echo site_url(); ?>"><?php echo $title; ?></a></h1>
			<?php } else { ?>
				<h1><a href="<?php echo site_url(); ?>"><?php bloginfo('name'); ?></a></h1>
			<?php } ?>

			<?php if($description != ''){ ?>
				<p><?php echo $description; ?></p>
			<?php } else { ?>
				<p><?php bloginfo('description'); ?></p>
			<?php } ?>
		</div>

	<?php } ?>

</div>

