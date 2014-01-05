<?php
/**
 * The Sidebar containing the secondary Page widget area.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */
?>
<?php do_action('skeleton_before_sidebar');?>

<?php // secondary widget area
	if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>
	<ul>
		<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
	</ul>
	<?php endif; // end secondary widget area ?>

<?php do_action('skeleton_after_sidebar');?>

