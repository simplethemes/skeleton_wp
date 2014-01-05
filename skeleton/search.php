<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */

get_header();

do_action('skeleton_before_content');

if ( have_posts() ) : ?>
	<h1><?php printf( __( 'Search Results for: %s', 'smpl' ), '' . get_search_query() . '' ); ?></h1>
	<?php
	/* Run the loop for the search to output the results.
	 * If you want to overload this in a child theme then include a file
	 * called loop-search.php and that will be used instead.
	 */
	 get_template_part( 'loop', 'search' );
	?>
<?php else : ?>
	<div id="post-0" class="post no-results not-found">
		<h2><?php _e( 'Nothing Found', 'smpl' ); ?></h2>

		<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'smpl' ); ?></p>
			<?php get_search_form(); ?>

	</div><!-- #post-0 -->
<?php endif;
do_action('skeleton_after_content');
get_footer();
?>