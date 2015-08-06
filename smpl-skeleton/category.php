<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package Skeleton WordPress Theme
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
 */

get_header();
do_action('skeleton_before_content');

?>

<h1><?php
		printf( __( 'Category Archives: %s', 'smpl' ), single_cat_title( '', false ) );
	?></h1>
	<?php
		$category_description = category_description();
		if ( ! empty( $category_description ) )
			echo '' . $category_description . '';
	/* Run the loop for the category page to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-category.php and that will be used instead.
	 */
	get_template_part( 'loop', 'category' );
	do_action('skeleton_after_content');
	get_sidebar();
	get_footer();
?>
