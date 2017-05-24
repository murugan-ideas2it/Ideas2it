//////////////////////////////////////////////////////
// Persona JS Backend
//////////////////////////////////////////////////////

jQuery(document).ready(function($) {

	$('#add-new-item input.new-item-name').focus();
	$body = $('body');

	//////////////////////////////////////////////////////
	// Open Media Gallery Upload
	//////////////////////////////////////////////////////

	var file_frame;

	$('a.upload-image').on('click', function(e){

		e.preventDefault();
		var $this = $(this);

		file_frame = wp.media.frames.file_frame = wp.media({
			title: $this.data('uploader_title'),
			button: {
				text: $this.data('uploader_button_text'),
			},
			multiple: false
		});

		file_frame.on('select', function(){
			attachment = file_frame.state().get('selection').first().toJSON();
			if($body.hasClass('appearance_page_persona-slider')){
				$this.next().val(attachment.url);
			} else {
				$this.parent().siblings('img').attr('src', attachment.url);
				$this.parent().siblings('input').val(attachment.url);
				$this.hide().siblings().show();
			}
		});

		file_frame.open();
	});

	$('a.remove-background-image').on('click', function(e){
		e.preventDefault();
		$this = $(this);

		$this.parent().siblings('input#custom-background-url').val('');
		$this.parent().siblings('img').attr('src', '');
		$this.hide().siblings().show();
	});

	//////////////////////////////////////////////////////
	// Repeatable
	//////////////////////////////////////////////////////

	var highest = 0;
	var current, prefix, setting;

	function trimspace(str) {
		return str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
	}

	if($body.hasClass('appearance_page_persona-sidebars') == true){
		prefix = 'sidebar-';
		setting = 'unlimited_sidebars_settings';
	}

	if($body.hasClass('appearance_page_persona-slider') == true){
		prefix = 'slide-';
		setting = 'slider_manager_settings';
	}

	$('.item-holder').each(function(){
		current = $(this).attr('id');
		current = parseInt(current.replace(prefix, ''), 10);
		if(current > highest){ highest = current; }
	});

	$('#add-new-item .add-item').on('click', function(e){
		e.preventDefault();
		var itemName = $('#add-new-item input.new-item-name').val();
		var $latest  = $('.sortable-wrap .item-holder.hidden');
		var $noItems = $('.sortable-wrap h4.no-items');
		if(itemName != ''){
			highest++;
			$clone = $latest.clone(true);
			$noItems.hide();
			$clone.appendTo('.sortable-wrap').attr('id', prefix+highest);
			$('.item-holder:last h4').text(itemName);
			$('.item-holder:last .item-name-input').val(itemName);
			$('.item-holder:last .item-info input').each(function(){
				var sufix = $(this).attr('name');
				$(this).attr('name', setting+'['+prefix+highest+']'+sufix);
			});
			$clone.removeClass('hidden');
			$('#add-new-item input.new-item-name').val('');
		}
	});

	$('#add-new-item .add-item').on('submit', function(){
		$('#add-new-item a').trigger('click');
	});

	$('.sortable-wrap').sortable({
		connectWith: '.sortable-wrap',
		placeholder: 'sortable-item-placeholder',
		handle: '.item-move',
		start: function(e,ui){
			var newHeight = ui.item.height() - 6;
			ui.placeholder.height(newHeight);
		}
	});

	$('.item-move').on('click', function(e){
		e.stopPropagation();
		e.preventDefault();
	});

	$('.repeatable-name').on('click', function(){
		var $this = $(this);
		$this.next().stop().slideToggle(200);
		$this.toggleClass('active');
	});

	$('.repeatable-form').on('submit', function(){
		$('.item-info input.item-name-input').each(function(){
			var $this = $(this);
			var name  = trimspace($this.val());
			if($('body').hasClass('appearance_page_persona-slider') == false){
				if(name == ''){
					var empty = $this.parent().parent().attr('id');
					$this.val(empty);
				}
			}
		});
	});

	$('a.delete-single-repeat').on('click', function(e){
		e.preventDefault();
		if (confirm(personaSidebars.alert)) {
			$(this).siblings('input').attr('name', '');
			$('.repeatable-form').submit();
		}
	});

});