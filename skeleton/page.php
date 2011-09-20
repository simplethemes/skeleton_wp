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
// You can override via functions.php conditionals or define:
// $columns = 'four';

get_header();
st_before_content($columns='');
get_template_part( 'loop', 'page' );
st_after_content();
get_sidebar('page');
get_footer();
?>