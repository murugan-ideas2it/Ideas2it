//////////////////////////////////////////////////////
// Approve Quickly WP Plugin JS
//////////////////////////////////////////////////////

jQuery(document).ready(function($) {

	setTimeout(loopCheckComments, 50000);

	// Check the current location
	var onComments  = 	$('body').hasClass('wp-admin') && $('body').hasClass('edit-comments-php');
	var onDashboard = 	$('body').hasClass('wp-admin') && $('body').hasClass('index-php');
	var onPost      = 	$('body').hasClass('wp-admin') && $('body').hasClass('post-php');

	// Cache some DOM objects
	var ab_label = $('li#wp-admin-bar-approve-quickly > a span.ab-label');
	var appq_submenu = $('#appq-comments-submenu');


	//////////////////////////////////////////////////////
	// Load the latest 3 comments on hover
	//////////////////////////////////////////////////////

	$('body').on( 'hover', 'li#wp-admin-bar-approve-quickly.appq-not-loaded.menupop', function(){

		$.ajax({
			type: "POST",
			dataType: 'json',
			url: appq_ajax.ajaxurl,
			data: { 'action': 'load_comments' },
			success: function(data){
				appq_submenu.html(data.html);
				$('li#wp-admin-bar-approve-quickly').addClass('appq-loaded').removeClass('appq-not-loaded');
				if(data.comments_left != 0){
					ab_label.text(data.comments_left);
				} else {
					ab_label.text('');
				}
			}
		});

	});

	//////////////////////////////////////////////////////
	// Moderate comments based on user action/click
	//////////////////////////////////////////////////////

	$('body').on('click', '.appq_comment_panel a', function(e){ e.preventDefault(); 
		var comment_ids = new Array(); 
		
		comment_ids[0]     = $(this).attr('rel');
		var comment_action = $(this).attr('class');
		var comment_single = $(this).parent().parent();
		var comment_count  = parseInt(ab_label.text());
		var comment_exists = $('#the-comment-list #comment-'+comment_ids[0]).length || $('#the-extra-comment-list #comment-'+comment_ids[0]).length;

		if(onComments && comment_exists || onDashboard && comment_exists || onPost && comment_exists){
			
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: appq_ajax.ajaxurl,
				data: { 'action': 'next_comment' },
				success: function(data){
					$('#comment-'+comment_ids[0]+' span.'+comment_action+' a').trigger('click');
					$('.appq_comments_bottom a.approve_all').html(data.approve_all);
					comment_single.slideUp(250, function(){
						comment_single.remove();
					});
					$('#appq-comments-list').append(data.new_comment);
					if(data.comments_left > 2){
						$('#appq-comments-list li').last().slideDown(250).removeClass('appq_hidden');
					}
				}
			});

			ab_label.text(comment_count - 1);

		} else {

			$.ajax({
				type: "POST",
				dataType: 'json',
				url: appq_ajax.ajaxurl,
				data: { 'action': 'moderate_comment', 
						'comment_ids': comment_ids,
						'comment_action': comment_action,
						'security': appq_ajax.nonce
				},
				success: function(data){
					if(data.valid == true){
						comment_single.slideUp(250, function(){
							comment_single.remove();
							if(data.comments_left <= 0){
								appq_submenu.css('display', 'none');
							}
						});
						$('#appq-comments-list').append(data.new_comment);
						$('.appq_comments_bottom a.approve_all').html(data.approve_all);
						if(data.comments_left > 2){
							$('#appq-comments-list li').last().slideDown(250).removeClass('appq_hidden');
						}

						if(data.comments_left <= 0){
							ab_label.hide();
							$('li#menu-comments .awaiting-mod').addClass('count-0').text('0');
							$('li#wp-admin-bar-approve-quickly').removeClass('menupop');
						} else {
							ab_label.text(data.comments_left);
							$('li#menu-comments .awaiting-mod .pending-count').text(data.comments_left);
						}
					}
				}
			});
		}
	});

	$('body').on('click', '.appq_comments_bottom a.approve_all', function(e){ e.preventDefault();

		var comment_ids = new Array();

		$.each($('ul#appq-comments-list li a.approve'), function(i, value) {
			comment_ids[i] = $(this).attr('rel');
		});

		if(onComments || onDashboard || onPost){
			var i;
			for (i = 0; i < comment_ids.length; ++i) {
				$('#comment-'+comment_ids[i]+' span.approve a').trigger('click');
			}
		}

		$.ajax({
			type: "POST",
			dataType: 'json',
			url: appq_ajax.ajaxurl,
			data: { 'action': 'moderate_comment', 
					'comment_ids': comment_ids,
					'comment_action': 'approve',
					'security': appq_ajax.nonce
			},
			success: function(data){
				if(data.valid == true){

					function slideUpTrigger(elem, delay){
						setTimeout( function() { elem.slideUp(250, function(){ elem.remove(); }); }, delay );
					}

					$.each($('ul#appq-comments-list li'), function(i, value) {
						slideUpTrigger( $(this), i*250 );
					});

					$('#appq-comments-list').append(data.new_comment);

					function slideDownTrigger(elem, delay){
						setTimeout( function() { elem.slideDown(250); elem.removeClass('appq_hidden') }, delay );
					}

					$.each($('ul#appq-comments-list li.appq_hidden'), function(i, value) {
						slideDownTrigger( $(this), i*250 );
					});

					if(data.comments_left <= 0){
						ab_label.hide();
						$('li#menu-comments .awaiting-mod').addClass('count-0').text('0');
					} else {
						ab_label.text(data.comments_left);
						$('li#menu-comments .awaiting-mod .pending-count').text(data.comments_left);
					}
				}
			}
		});

	});

	//////////////////////////////////////////////////////
	// Attach an event handler to WP's default actions
	//////////////////////////////////////////////////////

	if(onComments || onDashboard || onPost){
		
		$('#the-comment-list .row-actions span.approve a').on('click', function(){
			var new_count = parseInt($('li#menu-comments .pending-count').text()) - 1;
			ab_label.text(new_count);
		});

		$('#the-comment-list .row-actions span.unapprove a, #the-comment-list .row-actions span.spam a, #the-comment-list .row-actions span.trash a').on('click', function(){
			var new_count = parseInt($('li#menu-comments .pending-count').text()) + 1;
			ab_label.text(new_count);
		});

		$('#the-comment-list .row-actions span a').on('click', function(){
			if(!$('li#wp-admin-bar-approve-quickly').hasClass('hover')){
				$('li#wp-admin-bar-approve-quickly').addClass('appq-not-loaded').removeClass('appq-loaded');
				appq_submenu.empty().html('<p class="appq_loading"></p>');

			}
			var count = $('li#wp-admin-bar-approve-quickly > a span.ab-label').text();
			if(count == 0){
				$('li#wp-admin-bar-approve-quickly').removeClass('menupop');
			} else {
				$('li#wp-admin-bar-approve-quickly').addClass('menupop');
			}
		});

	}

	///////////////////////////////////////////////////////
	//  Checking for comments every 50 seconds,
	//  if the user is idle then check every 3 minutes
	///////////////////////////////////////////////////////

	var hidden, state, visibilityChange; 
	if (typeof document.hidden !== "undefined") {
		hidden = "hidden";
		visibilityChange = "visibilitychange";
		state = "visibilityState";
	} else if (typeof document.mozHidden !== "undefined") {
		hidden = "mozHidden";
		visibilityChange = "mozvisibilitychange";
		state = "mozVisibilityState";
	} else if (typeof document.msHidden !== "undefined") {
		hidden = "msHidden";
		visibilityChange = "msvisibilitychange";
		state = "msVisibilityState";
	} else if (typeof document.webkitHidden !== "undefined") {
		hidden = "webkitHidden";
		visibilityChange = "webkitvisibilitychange";
		state = "webkitVisibilityState";
	}

	if(document.addEventListener){
		document.addEventListener(visibilityChange, function() {
			if(document[state] == 'hidden'){
				checkInterval = 180000;
			}
		
			if(document[state] == 'visible'){
				checkInterval = 50000;
			}
		}, false);
	}

	function loopCheckComments(){
		checkComments();

		if(document[state] == 'hidden'){
			checkInterval = 180000;
		} else {
			checkInterval = 50000;
		}

		setTimeout(loopCheckComments, checkInterval);
	}

	function checkComments(){
		var hovered = $('#wp-admin-bar-approve-quickly').hasClass('hover');
		if(hovered == false){
			var current = parseInt(ab_label.text());
			$.ajax({
				type: "POST",
				dataType: 'json',
				url: appq_ajax.ajaxurl,
				data: { 'action': 'check_comments' },
				success: function(data){
					if(data.comments_left != current){
						$('li#wp-admin-bar-approve-quickly').addClass('appq-not-loaded').removeClass('appq-loaded');
						appq_submenu.html('<div id="appq-comments-submenu"><p class="appq_loading">loading comments...</p><div>');
						$('li#wp-admin-bar-approve-quickly').animate({
							'opacity': 0
						}, 1000, function(){
							if(data.comments_left == 0){
								ab_label.hide();
								$('li#menu-comments .awaiting-mod').addClass('count-0');
							} else {
								ab_label.show().text(data.comments_left);
								$('li#menu-comments .awaiting-mod .pending-count').text(data.comments_left);
							}

							$('li#wp-admin-bar-approve-quickly').animate({
								'opacity': 1
							}, 400);
						});
					}
				}
			});
		}
	}

});