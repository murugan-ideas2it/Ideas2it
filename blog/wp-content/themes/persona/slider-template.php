<?php
/**
 * The template for displaying the slider
 *
 */

$options = get_option('slider_manager_settings');

if(isset($options) && $options != false){  ?>

<div id="slider" class="flexslider">

	<ul class="slides">

		<?php foreach ($options as $item_id => $item_name) { ?>

			<li>
				
				<?php if($item_name['name']){ ?>
					<p class="slide-caption"><?php echo $item_name['name']; ?></p>
				<?php } ?>

				<?php if($item_name['desc']){ ?>
					<p class="slide-description"><?php echo $item_name['desc']; ?></p>
				<?php } ?>

				<?php if($item_name['url']){ ?>
					<a href="<?php echo $item_name['url']; ?>">
						<img src="<?php echo $item_name['image']; ?>" alt="<?php echo $item_name['name']; ?>" />
					</a>
				<?php } else { ?>
					<img src="<?php echo $item_name['image']; ?>" alt="<?php echo $item_name['name']; ?>" />
				<?php } ?>

			</li>

		<?php } ?>

	</ul>
	
</div>

<?php } ?>

