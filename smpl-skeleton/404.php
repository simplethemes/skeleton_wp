<?php
/**
* Skeleton WordPress Theme
* Author: Simple Themes
* URL: www.simplethemes.com
 * The template for displaying 404 pages (Not Found).
 *
 * @package Skeleton WordPress Theme
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
 */

get_header();
do_action('skeleton_before_content');
?>
	<h1><?php _e( 'Not Found', 'smpl' ); ?></h1>
	<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'smpl' ); ?></p>
	<?php get_search_form(); ?>

<?php
do_action('skeleton_after_content');
get_sidebar();
get_footer();
?>