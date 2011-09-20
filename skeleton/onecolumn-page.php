<?php
/**
 * Template Name: Designer Page - No Sidebar or Page Title
*/

get_header();
st_before_content($columns='');
get_template_part( 'loop', 'page' );
st_after_content();
get_footer();
?>
