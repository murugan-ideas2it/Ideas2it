<form method="get" id="searchform" action="<?php echo home_url(); ?>" >
	<fieldset>   
		<input autocomplete="off" placeholder="<?php echo __('Type and hit enter...', 'persona'); ?>" type="text" id="s" name="s" value="<?php echo get_search_query(); ?>" />
	</fieldset> 
</form>