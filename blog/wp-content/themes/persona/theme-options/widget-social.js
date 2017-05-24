//////////////////////////////////////////////////////
// Social Widget JS
//////////////////////////////////////////////////////

jQuery(document).ready(function($) {

	///////////////////////////////////////////////////////////////////
	// Force the initial widget save (js bugfix)
	// - more info: http://wordpress.stackexchange.com/a/37707/27356
	///////////////////////////////////////////////////////////////////

	$(document).ajaxComplete(function(event, XMLHttpRequest, ajaxOptions){

		var request = {}, pairs = ajaxOptions.data.split('&'), i, split, widget;

		for(i in pairs){
			split = pairs[i].split('=');
			request[decodeURIComponent(split[0])] = decodeURIComponent(split[1]);
		}

		if(request.action && (request.action === 'save-widget')){

			widget = $('input.widget-id[value="' + request['widget-id'] + '"]').parents('.widget');
			widgetName = widget.prop('id');

			if(typeof widgetName != 'undefined'){
				if (widgetName.indexOf("persona_social_widget") >= 0){
					if(!XMLHttpRequest.responseText){
						wpWidgets.save(widget, 0, 1, 0);
					} else {
						$(document).trigger('saved_widget', widget);
					}
				}
			}
		}

	});

	//////////////////////////////////////////////////////
	// Add new form (repeatable)
	//////////////////////////////////////////////////////

	$('body').on('click', 'a.persona-social-new', function(e){
		e.preventDefault();
		var $dummyForm = $(this).siblings('.persona-social-single.dummy').clone(true);
		$dummyForm.removeClass('dummy');
		$dummyForm.children('.persona-profile-name').attr('name', $dummyForm.children('.persona-profile-name').data('name'));
		$dummyForm.children('.persona-profile-name').attr('id', $dummyForm.children('.persona-profile-name').data('id'));
		$dummyForm.children('.persona-profile-link').attr('name', $dummyForm.children('.persona-profile-link').data('name'));
		$dummyForm.children('.persona-profile-link').attr('id', $dummyForm.children('.persona-profile-link').data('id'));
		$dummyForm.appendTo($(this).siblings('.persona-social-sortable'));
	});

	//////////////////////////////////////////////////////
	// Change icons style (regular or flat)
	//////////////////////////////////////////////////////

	$('body').on('change', '.social-change-style', function(){
		if($(this).val() == 'flat'){
			$('.persona-social-icon-preview').fadeOut( 200, function() {
				$('.persona-social-sortable').addClass('flat');
				$('.persona-social-icon-preview').fadeIn(400);
			});
		} else {
			$('.persona-social-icon-preview').fadeOut( 200, function() {
				$('.persona-social-sortable').removeClass('flat');
				$('.persona-social-icon-preview').fadeIn(400);
			});
		}
	});

	//////////////////////////////////////////////////////
	// Bind the events on "ready" and then again
	// after the widget is saved
	//////////////////////////////////////////////////////

	$(document).on('first_init saved_widget', function(){

		//////////////////////////////////////////////////////
		// Change the preview icon when select is changed
		//////////////////////////////////////////////////////

		$('.persona-profile-name').on('change', function(){
			var $this = $(this);

			if($this.prev('.persona-social-icon-preview').hasClass($this.val())){
				return false;
			} else {
				$this.prev('.persona-social-icon-preview').removeClass().addClass('persona-social-icon-preview').addClass($this.val());
			}

			if($this.val() == 'email'){
				$this.next('.persona-profile-link').attr('placeholder', socialwidget.emailaddress);
			} else if($this.val() == 'skype'){
				$this.next('.persona-profile-link').attr('placeholder', socialwidget.skypemessage);
			} else {
				$this.next('.persona-profile-link').attr('placeholder', socialwidget.profilelink);
			}
		});

		//////////////////////////////////////////////////////
		// Enable jquery.sortable on icons
		//////////////////////////////////////////////////////

		$('.persona-social-sortable').sortable({
			placeholder: 'social-widget-placeholder',
			handle: '.persona-social-icon-preview',
			start: function(e,ui){
				ui.placeholder.height(ui.item.height());
			}
		});

		//////////////////////////////////////////////////////
		// Delete icon, removes the form from DOM
		//////////////////////////////////////////////////////

		$('.persona-social-remove').on('click', function(e){
			e.preventDefault();
			$(this).parent('.persona-social-single').slideUp(200, function() {
				$(this).remove();
			});
		});

	});

	$(document).trigger('first_init');

});