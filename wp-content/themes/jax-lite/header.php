<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />

<!--[if IE 8]>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/scripts/html5.js" type="text/javascript"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/scripts/selectivizr-min.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> >

<div id="wrap" <?php jaxlite_wrap_class(); ?>>

    <?php get_template_part('scroll','sidebar'); ?>

    <div id="wrapper">

        <div id="overlay-body"></div>

        <header id="header">

            <?php do_action( "jaxlite_" . jaxlite_get_header_layout()); ?>

            <div class="navigation"><i class="fa fa-bars"></i> </div>
              <div class="headerTag"><h1>This should be in the header</h1></div>
        </header>
