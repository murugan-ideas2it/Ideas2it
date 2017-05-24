<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
	<head>
	
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<meta name="google-site-verification" content="QGHUgC6q1P42Ppu_lfcGOPoK8tI1aJ-lvyfa5bglh30" />
		<title><?php wp_title( '|', true, 'right' ); ?></title>
<!--[if lt IE 9]>
			<script src="<?php echo get_template_directory_uri(); ?>/script/html5shiv.js"></script>
		<![endif]-->

		<?php $options = get_option('persona_theme_options'); ?>

		<?php wp_head(); ?>
<script type="text/x-mathjax-config">
  MathJax.Hub.Config({
    tex2jax: {
      inlineMath: [ ['$','$'], ["\\(","\\)"] ],
      processEscapes: true
    }
  });
</script>		
<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-35572893-1', 'auto');
  ga('send', 'pageview');

</script>
</head>

	<body <?php body_class(); ?> >

		<?php if($options['show_sidebar'] == true){ ?>

			<form action="#" method="post">
			<?php wp_nonce_field( 'save-sidebar-widgets', '_wpnonce_widgets', false ); ?>
			</form>

		<?php } ?>

		<div class="wrapper">

			<a href="<?php echo home_url(); ?>" class="menu-toggle-name"><?php bloginfo('name'); ?></a>
			<a href="" class="menu-toggle"><?php echo __('Menu', 'persona') ?></a>
			
			<?php if($options['show_header'] == true && is_front_page() || $options['show_header'] == true && $options['show_header_always'] == true ){

				get_template_part( 'header', 'featured' );

			} ?>

			<?php 

				$search = '<li class="search"><div class="inactive"><span></span></div><form method="get" action="'. home_url() .'" ><input type="text" autocomplete="off" value="" name="s" placeholder="Type and hit enter..."></form></li>';

				$blog_url = home_url();
				$blog_title = get_bloginfo('name');
				$items_wrap = '<ul id="nav-menu"><li class="menu-item"><a href="'.$blog_url.'">'.$blog_title.'</a></li>%3$s'.$search.'</ul>';

				$nav_args = array(
					'theme_location'  => 'header',
					'menu'            => '',
					'container'       => false,
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => false,
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => '',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => $items_wrap,
					'depth'           => 0,
					'walker'          => ''
				);

				wp_nav_menu( $nav_args );
			?>