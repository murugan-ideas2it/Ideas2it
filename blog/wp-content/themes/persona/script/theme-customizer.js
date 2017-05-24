( function( $ ) {

	////////////////////////////////////////////////////
	// Menu Color
	////////////////////////////////////////////////////
	wp.customize( 'persona_theme_options[menu_color]', function( value ) {
		value.bind( function( newval ) {
			$('a.menu-toggle, ul#pagination li a.selected, #nav-menu, #slider p.slide-description').attr('style', 'background-color: '+newval+' !important');
			$('.content a, .page-links a, #footer a, #sidebar .widget-selected-image a, #sidebar .widget-selected-portfolio a, ul.portfolio-list a').attr('style', 'color: '+newval+' !important');
		});
	});

	////////////////////////////////////////////////////
	// Standard Color
	////////////////////////////////////////////////////
	wp.customize( 'persona_theme_options[format_standard_color]', function( value ) {
		value.bind( function( newval ) {
			$('.format-standard a.format-all, .page a.format-all').css('background-color', newval);
		});
	});

	////////////////////////////////////////////////////
	// Sticky / Status Color
	////////////////////////////////////////////////////
	wp.customize( 'persona_theme_options[format_status_color]', function( value ) {
		value.bind( function( newval ) {
			$('#content .sticky a.format-all, .post.format-status .format-all').css('background-color', newval);
		});
	});

	////////////////////////////////////////////////////
	// Image Color
	////////////////////////////////////////////////////
	wp.customize( 'persona_theme_options[format_image_color]', function( value ) {
		value.bind( function( newval ) {
			$('.post.format-image .format-all').css('background-color', newval);
		});
	});

	////////////////////////////////////////////////////
	// Gallery Color
	////////////////////////////////////////////////////
	wp.customize( 'persona_theme_options[format_gallery_color]', function( value ) {
		value.bind( function( newval ) {
			$('.post.format-gallery .format-all').css('background-color', newval);
		});
	});

	////////////////////////////////////////////////////
	// Video Color
	////////////////////////////////////////////////////
	wp.customize( 'persona_theme_options[format_video_color]', function( value ) {
		value.bind( function( newval ) {
			$('.post.format-video .format-all').css('background-color', newval);
		});
	});

	////////////////////////////////////////////////////
	// Link Color
	////////////////////////////////////////////////////
	wp.customize( 'persona_theme_options[format_link_color]', function( value ) {
		value.bind( function( newval ) {
			$('.post.format-link .format-all').css('background-color', newval);
		});
	});

	////////////////////////////////////////////////////
	// Quote Color
	////////////////////////////////////////////////////
	wp.customize( 'persona_theme_options[format_quote_color]', function( value ) {
		value.bind( function( newval ) {
			$('.post.format-quote .format-all').css('background-color', newval);
		});
	});

	////////////////////////////////////////////////////
	// Background Color
	////////////////////////////////////////////////////
	wp.customize( 'persona_theme_options[background_color]', function( value ) {
		value.bind( function( newval ) {
			$('body').css('background-color', newval );
		});
	});

	////////////////////////////////////////////////////
	// Background Pattern
	////////////////////////////////////////////////////
	wp.customize( 'persona_theme_options[background_pattern]', function( value ) {
		value.bind( function( newval ) {
			var pattern = personaCustomizer.themeurl+newval+'.png';
			$('body').css('background-image', 'url(' + pattern + ')');
		});
	});

	////////////////////////////////////////////////////
	// Background Fixed
	////////////////////////////////////////////////////
	wp.customize( 'persona_theme_options[background_pattern_fixed]', function( value ) {
		value.bind( function( newval ) {
			if(newval == false){
				$('body').css('background-attachment', 'scroll');
			} else {
				$('body').css('background-attachment', 'fixed');
			}
		});
	});

	////////////////////////////////////////////////////
	// Content Style
	////////////////////////////////////////////////////
	wp.customize( 'persona_theme_options[content_style]', function( value ) {
		value.bind( function( newval ) {
			if(newval == 'dark'){
				$('body').addClass('dark-color-scheme');
			} else {
				$('body').removeClass('dark-color-scheme');
			}
		});
	});

	////////////////////////////////////////////////////
	// Content Width
	////////////////////////////////////////////////////
	wp.customize( 'persona_theme_options[content_width]', function( value ) {
		value.bind( function( newval ) {
			if(newval == 'full-size'){
				$('body').addClass('full-width');
			} else {
				$('body').removeClass('full-width');
			}
		});
	});

	////////////////////////////////////////////////////
	// Show Header
	////////////////////////////////////////////////////
	wp.customize( 'persona_theme_options[show_header]', function( value ) {
		value.bind( function( newval ) {
			if(newval == false){
				$('body').addClass('header-off').removeClass('header-on');
				$('#header').remove();
			} else {
				$('body').removeClass('header-off').addClass('header-on');
				$('#nav-menu').before(personaCustomizer.header);
			}
		});
	});

	////////////////////////////////////////////////////
	// Show Sidebar
	////////////////////////////////////////////////////
	wp.customize( 'persona_theme_options[show_sidebar]', function( value ) {
		value.bind( function( newval ) {
			if(newval == false){
				$('body').removeClass('sidebar-on-left sidebar-on-right');
				$('#sidebar').hide();
			} else {
				$('body').addClass('sidebar-on-left');
				if($('#sidebar').length){
					$('#sidebar').show();
				} else {
					$('#container').after(personaCustomizer.sidebar);
				}
				$('a.widget-order-handle').on('click', function(e){
					e.preventDefault();
				});

				$('#sidebar').sortable({
					connectWith: '#sidebar',
					placeholder: 'sortable-widget-placeholder',
					handle: '.widget-order-handle',
					start: function(e,ui){
						ui.placeholder.height(ui.item.height());
					},
					stop: function(){
						var new_order = '';
						var sidebar_id = 'sidebars['+ $('#sidebar').data('id') + ']';

						$('#sidebar .widget').each(function(index, value){
							new_order = new_order + 'widget-0_' + $(this).attr('id') +',';
						});
						
						new_order = new_order.slice(0, -1);

						var postData = {
							'action': 'widgets-order',
							'savewidgets': $('#_wpnonce_widgets').val(),
						};

						postData[sidebar_id] = new_order;

						$.ajax({
							type: 'POST',
							dataType: 'json',
							url: personaCustomizer.ajaxurl,
							data: postData,
							success: function(data){
								// Customizer done
							}
						});
					}
				});
			}
		});
	});

	////////////////////////////////////////////////////
	// Sidebar Position
	////////////////////////////////////////////////////
	wp.customize( 'persona_theme_options[sidebar_position]', function( value ) {
		value.bind( function( newval ) {
			if(newval == 'right'){
				$('body').removeClass('sidebar-on-left').addClass('sidebar-on-right');
				if($('#sidebar').length == 0){
					$('#sidebar').remove();
				}
			} else {
				$('body').removeClass('sidebar-on-right').addClass('sidebar-on-left');
				if($('#sidebar').length){
					$('#container').after($('#sidebar'));
				} else {
					$('#container').after(personaCustomizer.sidebar);
				}
			}
		});
	});

	////////////////////////////////////////////////////
	// Show Slider
	////////////////////////////////////////////////////
	wp.customize( 'persona_theme_options[show_slider]', function( value ) {
		value.bind( function( newval ) {
			if(newval == false){
				$('#slider').remove();
			} else {
				$('#container').before(personaCustomizer.slider);
				$('#slider').flexslider({
					animation: 'slide',
					slideshowSpeed: 10000,
					animationSpeed: 500,
					pauseOnHover: true
				});
			}
		});
	});

	////////////////////////////////////////////////////
	// Slider Size
	////////////////////////////////////////////////////
	wp.customize( 'persona_theme_options[slider_size]', function( value ) {
		value.bind( function( newval ) {
			if(newval == 'full'){
				$('#container').before($('#slider'));
			} else {
				$('#content').prepend($('#slider'));
			}
		});
	});

	////////////////////////////////////////////////////
	// Header Image
	////////////////////////////////////////////////////
	wp.customize( 'persona_theme_options[header_featured_image]', function( value ) {
		value.bind( function( newval ) {
			if(newval){
				$('#header').css('background-image', 'url('+newval+')');
			}
		});
	});

	////////////////////////////////////////////////////
	// Site Title & Logo
	////////////////////////////////////////////////////
	wp.customize( 'persona_theme_options[logo]', function( value ) {
		value.bind( function( newval ) {
			if(newval){
				$('#header .avatar').empty().html('<img src="'+newval+'" /><div class="mark"></div>');
			} else {
				$('#header .avatar').empty().html( personaCustomizer.useravatar + '<div class="mark"></div>');
			}
		});
	});

	wp.customize( 'persona_theme_options[show_logo]', function( value ) {
		value.bind( function( newval ) {
			if(newval == false){
				$('#header .avatar').hide();
			} else {
				$('#header .avatar').show();
			}
		});
	});

	wp.customize( 'persona_theme_options[title_text]', function( value ) {
		value.bind( function( newval ) {
			$('#header #info h1').html( newval );
			if(newval == ''){
				$('#header #info h1').html( personaCustomizer.title_text );
			}
		});
	});

	wp.customize( 'persona_theme_options[description_text]', function( value ) {
		value.bind( function( newval ) {
			$('#header #info p').html( newval );
			if(newval == ''){
				$('#header #info p').html( personaCustomizer.description_text );
			}
		});
	});

	wp.customize( 'persona_theme_options[show_description]', function( value ) {
		value.bind( function( newval ) {
			if(newval == false){
				$('#header #info').hide();
			} else {
				$('#header #info').show();
			}
		});
	});

	wp.customize( 'persona_theme_options[footer_text]', function( value ) {
		value.bind( function( newval ) {
			$('#footer .copyright > p').html( newval );
		});
	});



} )( jQuery );