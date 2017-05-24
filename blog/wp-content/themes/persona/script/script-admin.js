//////////////////////////////////////////////////////
// Persona JS Admin
//////////////////////////////////////////////////////

jQuery(document).ready(function($) {

	function trimspace(str) {
		return str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
	}

	//////////////////////////////////////////////////////
	// Admin Frontend Menu
	//////////////////////////////////////////////////////

	$('body').on('click', 'a.admin-toolbar.display', function(e){

		e.preventDefault();
		e.stopPropagation();
		var $this = $(this);

		$this.toggleClass('active');
		$this.siblings('ul.admin-menu').toggleClass('show');

	});

	$('ul.admin-menu a').on('click', function(e){

		e.preventDefault();
		var $admin_menu = $(this).parents('ul.admin-menu');

		$admin_menu.toggleClass('show');
		$admin_menu.siblings('a.admin-toolbar').toggleClass('active');

	});

	$('body').on('click', 'a.admin-toolbar', function(e){
		e.preventDefault();
	});

	//////////////////////////////////////////////////////
	// Trash Post
	//////////////////////////////////////////////////////

	$('ul.admin-menu').on('click', 'a.trash.not-trashed', function(e){

		e.preventDefault();
		var $this  = $(this);

		var $post  = $this.parents('.post');
		var $admin = $this.parents('ul.admin-menu').siblings('a.admin-toolbar');

		var postID = $post.data('id');

		$this.removeClass('not-trashed');
		$admin.removeClass('display').addClass('loading');

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: persona.ajaxurl,
			data: { 'action': 'persona_trash_post', 
					'post_ID': postID,
					'security': persona.nonce },
			success: function(data){
				$admin.removeClass('loading').addClass('display');
				$this.addClass('undo-trashed').text(data.untrash);
				$this.parent().siblings().hide();
				if(data.trashed == true){
					$post.prepend(data.info);
					$post.children('div.undo-trashed').slideDown();
				} else {
					$post.prepend(data.errorInfo);
				}
				
			}
		});

	});

	$('ul.admin-menu').on('click', 'a.trash.undo-trashed', function(e){

		e.preventDefault();
		var $this  = $(this);

		var $post  = $this.parents('.post');
		var $admin = $this.parents('ul.admin-menu').siblings('a.admin-toolbar');

		var postID = $post.data('id');

		$this.removeClass('not-trashed');
		$admin.removeClass('display').addClass('loading');

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: persona.ajaxurl,
			data: { 'action': 'persona_untrash_post', 
					'post_ID': postID,
					'security': persona.nonce },
			success: function(data){
				$admin.removeClass('loading').addClass('display');
				$this.parent().siblings().show();
				if(data.untrashed == true){
					$this.removeClass('undo-trashed').addClass('not-trashed');
					$post.children('div.undo-trashed').slideUp(300, function(){
						$(this).remove();
					});
				} else {
					$post.prepend(data.errorInfo);
				}
			}
		});
	});


	$('body').on('click', 'div.undo-trashed a.undo-trashed', function(e){

		e.preventDefault();
		$('ul.admin-menu a.trash.undo-trashed').trigger('click');

	});

	//////////////////////////////////////////////////////
	// Title Edit
	//////////////////////////////////////////////////////

	$('ul.admin-menu').on('click', 'a.title', function(e){

		e.preventDefault();

		var $this = $(this);
		var $post = $this.parents('article');

		var form = '<div class="new-title"><form class="new-title" method="post"><input type="text" name="new-title" autocomplete="off" value=""><input type="submit" /></form></div>';

		$post.children('a.admin-toolbar.display').removeClass('display').addClass('apply title');

		if($post.hasClass('format-status') || $post.hasClass('format-quote') || $post.hasClass('format-link')){
			$post.prepend(form);
			$post.find('div.new-title').slideDown(300);
		} else {
			$post.children('h1.title').hide().after(form).scrollintoview();
		}
		
		var $input = $post.children('div.new-title').children('form.new-title').children('input');

		var title = $this.data('title');
		$input.focus().val('').val(title);

	});

	$('body').on('submit', 'form.new-title', function(e){

		e.preventDefault();
		$(this).parents('div.new-title').siblings('a.admin-toolbar.title.apply').trigger('click');

	});

	$('body').on('click', 'a.admin-toolbar.title.apply', function(e){

		e.preventDefault();
		var $this = $(this);
		var $post = $this.parents('article');
		var input = trimspace($this.siblings('div.new-title').find('.new-title input').val());
		var postID = $this.parents('article').data('id');

		$this.removeClass('apply').addClass('loading');

		if(input == ''){ var input = $post.find('a.title').data('title'); }
		$post.find('a.title').attr('data-title', input).data('title', input);

		var postTitle = $post.find('a.title').data('title');

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: persona.ajaxurl,
			data: { 'action': 'persona_update_post_title', 
					'post_ID': postID,
					'post_title': postTitle,
					'security': persona.nonce },
			success: function(data){

				if($post.hasClass('format-status') || $post.hasClass('format-quote') || $post.hasClass('format-link')){

					$this.siblings('div.new-title').slideUp(300, function(){
						$(this).remove();
					});

				} else {

					$post.find('h1.title a').text(input);
					$this.siblings('div.new-title').replaceWith($post.children('h1.title').show());
					
				}

				$this.removeClass('loading title').addClass('display');
				
			}
		});


	});

	//////////////////////////////////////////////////////
	// Widgets Order
	//////////////////////////////////////////////////////

	if (typeof sidebars == 'undefined'){
		sidebars = '';
	}

	var postData = sidebars;

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

			$('#sidebar aside.widget').each(function(index, value){
				new_order = new_order + 'widget-0_' + $(this).attr('id') +',';
			});
			
			new_order = new_order.slice(0, -1);

			postData.action = 'widgets-order';
			postData.savewidgets = $('#_wpnonce_widgets').val();

			postData[sidebar_id] = new_order;

			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: persona.ajaxurl,
				data: postData
			});
		}
	});

});