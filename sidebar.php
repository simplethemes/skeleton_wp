<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */
?>
<?php do_action('st_before_sidebar');?>

<?php // primary widget area
	if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
	<ul>
		<?php dynamic_sidebar( 'primary-widget-area' ); ?>
	</ul>
	<?php endif; // end primary widget area ?>

<?php // secondary widget area
	if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>
	<ul>
		<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
	</ul>
	<?php endif; // end secondary widget area ?>

<?php do_action('st_after_sidebar');?>

