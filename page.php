<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */
get_header();
do_action('st_before_content');
get_template_part( 'loop', 'page' );
do_action('st_after_content');
get_sidebar('page');
get_footer();
?>