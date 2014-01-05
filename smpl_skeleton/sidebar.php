<?php
/**
 * The Sidebar containing the primary blog sidebar
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */
?>
<?php do_action('skeleton_before_sidebar');?>

<?php // primary widget area
		$post_wide = get_post_meta($post->ID, "sidebars", $single = true) ==  "false";
		if ( !$post_wide && is_active_sidebar( 'primary-widget-area' ) ) : ?>
		<ul>
			<?php dynamic_sidebar( 'primary-widget-area' ); ?>
		</ul>
<?php endif;// end primary widget area ?>


<?php do_action('skeleton_after_sidebar');?>

