<?php

/**
 * Proper way to enqueue scripts and styles
 */
// function tripl3inf_scripts() {
// 	wp_enqueue_script( 'normalize', get_stylesheet_directory_uri().'/common/css/vender/normalize.css', true);
// 	wp_enqueue_style( 'main', get_stylesheet_directory_uri().'/common/css/main.css', true);
// 	wp_enqueue_script( 'easeljs', '//cdnjs.cloudflare.com/ajax/libs/EaselJS/0.7.1/easeljs.min.js', true );
// 	wp_enqueue_script( 'tweenMax', get_stylesheet_directory_uri().'/common/js/vender/TweenMax.min.js', true );
// 	wp_enqueue_script( 'kineticGSplug', get_stylesheet_directory_uri().'/common/js/vender/KineticPlugin.min.js', true );
// 	wp_enqueue_script( 'gridOvrLay', get_stylesheet_directory_uri().'/common/js/gridOverlayPlugin.js', true );
// }

function tripl3inf_scripts() {
	wp_enqueue_script( 'normalize', get_stylesheet_directory_uri().'/common/css/vender/normalize.css');
	wp_enqueue_style( 'main', get_stylesheet_directory_uri().'/common/css/main.css');
	wp_enqueue_script( 'easeljs', 'http://code.createjs.com/createjs-2013.12.12.min.js"');
	wp_enqueue_script( 'tweenMax', get_stylesheet_directory_uri().'/common/js/vender/TweenMax.min.js');
	wp_enqueue_script( 'gridOvrLay', get_stylesheet_directory_uri().'/common/js/gridOverlayPlugin.js');
}

add_action( 'wp_enqueue_scripts', 'tripl3inf_scripts' );



?>
