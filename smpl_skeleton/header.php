<?php
/**
 * The Header for our theme.
 *
 * @package Skeleton WordPress Theme Framework
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
 */
?>
<!doctype html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes();?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes();?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes();?>> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes();?>> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html <?php language_attributes();?>> <!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11">

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Add CSS3 PIE Rules for IE 7-9
================================================== -->

<!--[if IE]>
<style type="text/css">
html.ie #navigation,
html.ie a.button,
html.ie .cta,
html.ie .wp-caption,
html.ie #breadcrumbs,
html.ie a.more-link,
html.ie .gallery .gallery-item img,
html.ie .gallery .gallery-item img.thumbnail,
html.ie .widget-container,
html.ie #author-info {behavior: url("<?php echo get_stylesheet_directory_uri();?>/PIE.php");position: relative;}</style>
<![endif]-->


<!-- Mobile Specific Metas
================================================== -->

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<!-- Favicons
================================================== -->

<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon.ico">
<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri();?>/images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri();?>/images/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri();?>/images/apple-touch-icon-114x114.png" />

<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

<?php
	do_action('skeleton_above_header');
	do_action('skeleton_header');
	do_action('skeleton_below_header');
	do_action('skeleton_navbar');
?>