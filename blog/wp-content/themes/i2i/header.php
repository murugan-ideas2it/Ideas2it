<!-- <!DOCTYPE html>
<html <?php //language_attributes(); ?>>
  <head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php //echo get_template_directory_uri();?>/style.css" rel="stylesheet">
    <?php //wp_head(); ?>
  </head> -->
 



  <!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
 
    <!--=== META TAGS ===-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="description" content="Keywords">
    <meta name="author" content="Name">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     
    <!--=== LINK TAGS ===-->
    <link rel="shortcut icon" href="<?php echo THEME_DIR; ?>/path/favicon.ico" />
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS2 Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link href="<?php echo get_template_directory_uri();?>/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo("template_url"); ?>/js/custom.js"></script>
 
    <!--=== TITLE ===-->  
    <title><?php wp_title(); ?> - <?php bloginfo( 'name' ); ?></title>
     <?php wp_enqueue_script("jquery"); ?>
    <!--=== WP_HEAD() ===-->
    <?php wp_head(); ?>
      
</head>
 <body>

  <nav class="navbar navbar-default" role="navigation" id="menubar">
    <div class="container" id="centremenu">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <ul class="nav navbar-nav">
       <img src="<?php  echo get_template_directory_uri();?>/img/logo.png" class="img-responsive">
      </ul>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      </ul> 
      <ul class="nav navbar-nav navbar-right top-menu">  
        <li><a href="#"> <span class="glyphicon glyphicon-search" id="menusearch"></span></a></li>   
        <li><a href="#" id="leftmenu">Home</a></li>
        <li><a href="#" id="leftmenu">About Ideas2IT</a></li> 
        <li><a href="#" id="leftmenu">Contact Us</a></li> 
      </ul>
    </div>
    </div>
  </nav>
  <div class="page-wraper">