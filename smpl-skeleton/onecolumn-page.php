<?php
/**
 * Template Name: Designer Page - No Sidebar or Page Title
 * @package Skeleton WordPress Theme
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
*/

get_header();
do_action('skeleton_before_content');
get_template_part( 'loop', 'page' );
do_action('skeleton_after_content');
get_footer();
?>
