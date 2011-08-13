<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */

get_header();
do_action('st_before_content');
?>
	<h1><?php _e( 'Not Found', 'skeleton' ); ?></h1>
	<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'skeleton' ); ?></p>
	<?php get_search_form(); ?>
	
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php
do_action('st_after_content');
get_sidebar();
get_footer();
?>