<?php
/**
 * The Sidebar containing the secondary Page widget area.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */

if ( is_active_sidebar( 'sidebar-2' ) ) {

	do_action('skeleton_before_sidebar');

	dynamic_sidebar( 'sidebar-2' );

	do_action('skeleton_after_sidebar');

}
?>