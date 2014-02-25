<?php
/**
 * The Sidebar containing the primary blog sidebar
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */

// hide sidebars with sidebars=false custom field
if (is_singular() && get_post_meta($post->ID, "sidebars", $single = true) ==  "false") {
	return;
}

if ( is_active_sidebar( 'sidebar-1' ) ) {
		do_action('skeleton_before_sidebar');
		dynamic_sidebar( 'sidebar-1' );
		do_action('skeleton_after_sidebar');
}

?>