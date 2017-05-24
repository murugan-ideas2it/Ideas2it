//////////////////////////////////////////////////////
// Persona JS
//////////////////////////////////////////////////////


jQuery(document).ready(function($) {

	$('.post-reply').on('click', function(e){
		e.preventDefault();
		$this = $(this);

		if($('body').hasClass('single') || $('body').hasClass('page')){
			$('li.respond').scrollintoview();
			$('li.respond').children('.comment-form').children('.comment-box').focus();
		} else {
			$this.toggleClass('active').parent().nextAll('ul.comments').children('li.respond').slideToggle(300, function(){
				$(this).scrollintoview();
				$(this).children('.comment-form').children('.comment-box').focus();
			});
		}

	});

	$('html').on('click', function(){
		$('a.share-button.active').trigger('click');
		$('a.admin-toolbar.display.active').trigger('click');
		$('#nav-menu .search div.active').removeClass('active').addClass('inactive');
		$('#nav-menu .search form').hide();
	});



	//////////////////////////////////////////////////////
	// Mobile Menu Toggle
	//////////////////////////////////////////////////////

	$('.menu-toggle').on('click', function(e){
		e.preventDefault();
		$(this).toggleClass('show');
		$('ul#nav-menu').toggleClass('show').scrollintoview();
	});

	//////////////////////////////////////////////////////
	// Sticky Navigation
	//////////////////////////////////////////////////////

	var viewportWidth = $(window).width();
	if(viewportWidth < 1024){
		$('body').removeClass('show-sticky-menu').addClass('hide-sticky-menu');
	} else {
		$('body').removeClass('hide-sticky-menu').addClass('show-sticky-menu');
	}

	var stickyNav = 130;

	if( $('body').hasClass('header-on') && $('body').hasClass('home') || $('body').hasClass('header-on-always')){
		stickyNav = 400;
	}

	$(window).resize(function() {
		var viewportWidth = $(window).width();
		if(viewportWidth < 1024){
			$('body').removeClass('show-sticky-menu').addClass('hide-sticky-menu');
		} else {
			$('body').removeClass('hide-sticky-menu').addClass('show-sticky-menu');
		}
	});


	$(window).scroll(function(){
		
		if($(window).scrollTop() >= stickyNav){
			$('#nav-menu').addClass('fixed');
			setTimeout(function(){ $('#nav-menu').addClass('slide-down'); }, 10);
			$('body .wrapper').addClass('fixed-bump');
		}

		if($(window).scrollTop() < stickyNav){
			$('#nav-menu').removeClass('fixed slide-down');
			$('body .wrapper').removeClass('fixed-bump');
		}
	});

	

	//////////////////////////////////////////////////////
	// Search
	//////////////////////////////////////////////////////

	$('#nav-menu .search div.inactive').on('click', function(e){
		e.preventDefault();
		e.stopPropagation();
		$this = $(this);
		$form = $this.siblings('form');

		$this.removeClass('inactive').addClass('active');
		$form.show()
		$form.children('input').stop().animate({
			width: 230,
			}, 200, function(){
				$form.children('input').focus();
		});
		
	});

	$('#nav-menu .search form').on('click', function(e){
		e.preventDefault();
		e.stopPropagation();
	});

	//////////////////////////////////////////////////////
	// ShareBox
	//////////////////////////////////////////////////////

	$('body').on('click', 'a.share-button.inactive', function(e){
		e.preventDefault();
		e.stopPropagation();
		$this = $(this);

		$this.removeClass('inactive').addClass('active');
		$this.next('.sharebox').addClass('show');
	});

	$('body').on('click', 'a.share-button.active', function(e){
		e.preventDefault();
		e.stopPropagation();
		$this = $(this);

		$this.removeClass('active').addClass('inactive');
		$this.next('.sharebox').removeClass('show');
	});

	$('body').on('focus', '.sharebox input', function(){
		$(this).select();
	});

	$('.sharebox input').focus(function () {
		$('.sharebox input').select().mouseup(function (e) {
			e.preventDefault();
			$(this).unbind('mouseup');
		});
	});

	$('.sharebox a').on('click', function(){
		$('a.share-button.active').trigger('click');
		e.stopPropagation();
	});

	$('.sharebox').on('click', function(e){
		e.stopPropagation();
	});

	//////////////////////////////////////////////////////
	// Comment Form Validation
	//////////////////////////////////////////////////////

	function valid(emailAddress) {
		var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
		return pattern.test(emailAddress);
	}

	function trimspace(str) {
		return str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
	}

	$('.comment-form').on('submit', function(e){

		e.preventDefault();
		var $this = $(this);

		var $commentBox  = $this.children('.comment-box');
		var $authorBox   = $this.children('.author');
		var $emailBox    = $this.children('.email');
		var $urlBox      = $this.children('.url');
		var $respond     = $this.parents('.respond');
		var $info        = $this.children('em.info');

		var comment      = trimspace($commentBox.val());
		var author       = trimspace($authorBox.val());
		var email        = trimspace($emailBox.val());
		var url          = trimspace($urlBox.val());
		var postID       = $this.parents('article').data('id');
		var message      = $info.html();

		if(comment && author && email){

			if( valid(email) ){
				var postData = {
					'action': 'persona_add_comment',
					'security': persona.nonce,
					'comment_post_ID': postID,
					'comment_author': author,
					'comment_author_email': email,
					'comment_author_url': url,
					'comment_content': comment,
				};

				$respond.prepend('<li class="loading-overlay"></li>');
				var $overlay = $respond.children('li.loading-overlay');

				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: persona.ajaxurl,
					data: postData,
					success: function(data){
						if(data.inserted == true){
							$respond.before(data.comment);
							setTimeout(function(){ $respond.siblings('.hidden').addClass('fade-in'); }, 1);
							$commentBox.val('');
							$overlay.remove();
							$info.removeClass('error');
						}
					},
					error: function(data){
						$info.addClass('error').html(data.responseText);
						setTimeout(function(){ $info.addClass('fade-out'); }, 4000);
						setTimeout(function(){ $info.html(message).removeClass('error fade-out'); }, 5000);
						$overlay.remove();
					}
				});

			} else {
				$.each([$commentBox, $authorBox], function() { $(this).removeClass('error') });
				$emailBox.addClass('error');
			}

		} else {
			
			$.each([$commentBox, $authorBox, $emailBox], function() {
				$(this).removeClass('error');
				if($(this).val().length == 0){
					$(this).addClass('error');
				}
			});

			if( !valid(email) ){
				$emailBox.addClass('error');
			}

		}

	});

	//////////////////////////////////////////////////////
	// Comments Load
	//////////////////////////////////////////////////////

	$('ul.comments li.show-all a.not-loaded').hover(
    	function() {
			$(this).stop().animate({
				paddingTop: 7
			}, 150 );
		},
		function() {
			$(this).stop().animate({
				paddingTop: 2
			}, 150 );
		}
	);

	$('ul.comments li.show-all a.not-loaded').on('click', function(e){

		e.preventDefault();
		var $this = $(this);

		$this.removeClass('not-loaded');
		$this.parent().hide();
		$this.parents('ul.comments').append('<li class="loading-overlay"></li>');

		var $overlay = $this.parent().siblings('li.loading-overlay');

		var postID = $this.parents('article').data('id');

		$.ajax({
			type: 'POST',
			url: persona.ajaxurl,
			data: { 'action': 'persona_load_comments', 
					'comment_post_ID': postID,
					'security': persona.nonce },
			success: function(data){
				$this.parent().siblings('li.comment').remove();
				$overlay.addClass('fade-out');
				setTimeout(function() {
					$overlay.remove();
				}, 400);
				$this.parents('ul.comments').prepend(data);
				$this.parent().remove();
			}
		});

	});

	//////////////////////////////////////////////////////
	// Gallery Slider
	//////////////////////////////////////////////////////

	$('#slider').flexslider({
		animation: 'slide',
		slideshowSpeed: 10000,
		animationSpeed: 500,
		pauseOnHover: true
	});

	$('.flexslider').flexslider({
		animation: 'slide',
		slideshow: false,
		easing: 'swing',
		controlNav: false,
		animationLoop: false,
		itemWidth: 135,
		itemMargin: 18,
		minItems: 2,
		maxItems: 6
	});


	$('a.gallery-thumbnail').on('click', function(e){
		e.preventDefault();
		var $this = $(this);

		if($this.hasClass('active')){
			return false;
		}

		$this.parent().siblings().children('a.gallery-thumbnail.active').removeClass('active');
		$this.addClass('active');
		var url = $this.attr('href');
		var $big = $this.parents('.carousel').prev('.current-image');
		$big.removeClass('gallery-fade-in').addClass('gallery-fade-out');
		$big.children('img.loaded-image').attr('src', url);

		$('.current-image img.loaded-image').imagesLoaded( function() {
			setTimeout(function(){ 
				$big.children('img').attr('src', url);
				if($this.data('caption')){
					$big.children('div.caption').children('p').html($this.data('caption'));
					$big.children('div.caption').removeClass('hidden').show();
				} else {
					$big.children('div.caption').hide();
				}
				$big.removeClass('gallery-fade-out').addClass('gallery-fade-in'); 
			}, 150);
		});
		
	});

});