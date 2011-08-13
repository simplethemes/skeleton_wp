<?php
/**
 * The Sidebar containing the bbpress widget areas.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */
?>
<?php do_action('st_before_sidebar');?>

<?php // bbpress-widget-area
	if ( is_active_sidebar( 'bbpress-widget-area' ) ) : ?>
	<ul>
		<?php dynamic_sidebar( 'bbpress-widget-area' ); ?>
	</ul>
	<?php endif; // end primary widget area ?>

<?php do_action('st_after_sidebar');?>

