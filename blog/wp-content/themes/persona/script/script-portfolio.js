//////////////////////////////////////////////////////
// Persona Portfolio JS
//////////////////////////////////////////////////////

jQuery(document).ready(function($) {

	$('.zoom').stop().fadeTo('fast', 0);

	$('#items li a.thumb_port').hover(
		function() {
			$(this).stop().fadeTo('medium', 0.8);
			$('.zoom').stop().fadeTo('slow', 1);
		},
		function(){
			$('.zoom').stop().fadeTo('fast', 0);
			$(this).stop().fadeTo('fast', 1);
		}
	);

	if (jQuery().quicksand) {

		(function($) {
			
			$.fn.sorted = function(customOptions) {
				var options = {
					reversed: false,
					by: function(a) {
						return a.text();
					}
				};
		
				$.extend(options, customOptions);
		
				$data = jQuery(this);
				arr = $data.get();
				arr.sort(function(a, b) {
		
					var valA = options.by($(a));
					var valB = options.by($(b));
			
					if (options.reversed) {
						return (valA < valB) ? 1 : (valA > valB) ? -1 : 0;				
					} else {		
						return (valA < valB) ? -1 : (valA > valB) ? 1 : 0;	
					}
			
				});
		
				return $(arr);
		
			};
			
		
		})(jQuery);
		
		
		jQuery(function() {
		
			var read_button = function(class_names) {
				
				var r = {
					selected: false,
					type: 0
				};
				
				for (var i=0; i < class_names.length; i++) {
					
					if (class_names[i].indexOf('selected-') == 0) {
						r.selected = true;
					}
				
					if (class_names[i].indexOf('segment-') == 0) {
						r.segment = class_names[i].split('-')[1];
					}
				};
				
				return r;
				
			};
		
			var determine_sort = function($buttons) {
				var $selected = $buttons.parent().filter('[class*="selected-"]');
				return $selected.find('a').attr('data-value');
			};
		
			var determine_kind = function($buttons) {
				var $selected = $buttons.parent().filter('[class*="selected-"]');
				return $selected.find('a').attr('data-value');
			};
		
			var $preferences = {
				duration: 400,
				easing: 'easeInOutQuad',
				adjustHeight: 'auto',
				adjustWidth: 'auto'
			}
		
			var $list = jQuery('#items');
			var $data = $list.clone();
		
			var $controls = jQuery('#portfolio-filter');
		
			$controls.each(function(i) {
		
				var $control = jQuery(this);
				var $buttons = $control.find('a');
		
				$buttons.bind('click', function(e) {
		
					var $button = jQuery(this);
					var $button_container = $button.parent();
					var button_properties = read_button($button_container.attr('class').split(' '));      
					var selected = button_properties.selected;
					var button_segment = button_properties.segment;
		
					if (!selected) {
		
						$buttons.parent().removeClass();
						$button_container.addClass('selected-' + button_segment);
		
						var sorting_type = determine_sort($controls.eq(1).find('a'));
						var sorting_kind = determine_kind($controls.eq(0).find('a'));
		
						if (sorting_kind == 'all') {
							var $filtered_data = $data.find('li');
						} else {
							var $filtered_data = $data.find('li.' + sorting_kind);
						}
		
						var $sorted_data = $filtered_data.sorted({
							by: function(v) {
								return $(v).find('strong').text().toLowerCase();
							}
						});
		
						$list.quicksand($sorted_data, $preferences, function () {
						
							$('.zoom').stop().fadeTo('fast', 0);
							
							$('#items li a.thumb_port').hover(
								function() {
									$(this).stop().fadeTo('medium', 0.8);
									$('.zoom').stop().fadeTo('slow', 1);
								},
								function(){
									$('.zoom').stop().fadeTo('fast', 0);
									$(this).stop().fadeTo('fast', 1);
								}
							);
						});
			
					}
					e.preventDefault();
				});
			}); 
		});
	}

});