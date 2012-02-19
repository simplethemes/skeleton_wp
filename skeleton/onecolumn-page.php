<?php
/**
 * Template Name: Designer Page - No Sidebar or Page Title
 * @package Skeleton WordPress Theme Framework
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
*/

get_header();
st_before_content($columns='');
get_template_part( 'loop', 'page' );
st_after_content();
get_footer();
?>
