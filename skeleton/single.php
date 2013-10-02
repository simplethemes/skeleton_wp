<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */

get_header();
st_before_content($columns='');
get_template_part( 'loop', 'single' );
st_after_content();
get_sidebar();
get_footer();
?>