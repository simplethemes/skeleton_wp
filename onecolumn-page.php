<?php
/**
 * Template Name: Designer Page - No Sidebar or Page Title
 */

get_header();
do_action('st_before_content');
get_template_part( 'loop', 'page' );
do_action('st_after_content');
get_footer();
?>
