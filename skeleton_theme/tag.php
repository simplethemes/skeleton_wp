<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */

get_header();
do_action('st_before_content');

?>
<h1><?php printf( __( 'Tag Archives: %s', 'skeleton' ), '<span class="bolder">' . single_tag_title( '', false ) . '</span>' );?></h1>
<?php
/* Run the loop for the tag archive to output the posts
 * If you want to overload this in a child theme then include a file
 * called loop-tag.php and that will be used instead.
 */
get_template_part( 'loop', 'tag' );
st_after_content();
get_sidebar();
get_footer();
?>