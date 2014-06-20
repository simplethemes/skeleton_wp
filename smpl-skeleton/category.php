<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package Skeleton WordPress Theme Framework
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
 */

get_header();
do_action('skeleton_before_content');

?>
	<h1><?php printf( __( 'Category Archives: %s', 'smpl' ), single_cat_title( '', false ) ); ?></h1>
	<?php
	$category_description = category_description();
	if ( ! empty( $category_description ) ) {
		echo '<div class="category-description>' . $category_description . '</div>';
	}
	get_template_part( 'loop', 'category' );
	do_action('skeleton_after_content');
	get_sidebar();
	get_footer();
?>
