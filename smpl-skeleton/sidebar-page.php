<?php
/**
 * The Sidebar containing the secondary Page widget area.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */
$page_wide = (get_post_meta($post->ID, "sidebars", $single = true) == "false") ? true : false ;

if ($page_wide) {
    return;
} elseif ( is_active_sidebar( 'sidebar-2' ) ) {

	do_action('skeleton_before_sidebar');

	dynamic_sidebar( 'sidebar-2' );

	do_action('skeleton_after_sidebar');

}
?>