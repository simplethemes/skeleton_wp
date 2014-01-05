<?php

/**
 * Updates Options Framework Data
 *
 * @package     Options Framework
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.5
 */

function optionsframework_upgrade_routine() {
	optionsframework_update_to_version_1_5();
	optionsframework_update_version();
}

/**
 * Media uploader code changed in Options Framework 1.5
 * and no longer uses a custom post type.
 *
 * Function removes the post type 'optionsframework'
 * Media attached to the post type remains in the media library
 *
 * @access      public
 * @since       1.5
 * @return      void
 */

function optionsframework_update_to_version_1_5() {
	register_post_type( 'optionsframework', array(
		'labels' => array(
			'name' => __( 'Theme Options Media', 'options_framework_theme' ),
		),
		'show_ui' => false,
		'rewrite' => false,
		'show_in_nav_menus' => false,
		'public' => false
	) );

	// Get all the optionsframework post type
	$query = new WP_Query( array(
		'post_type' => 'optionsframework',
		'numberposts' => -1,
	) );

	while ( $query->have_posts() ) :
		$query->the_post();
		$attachments = get_children( array(
			'post_parent' => the_ID(),
			'post_type' => 'attachment'
			)
		);
		if ( !empty( $attachments ) ) {
			// Unassign each of the attachments from the post
			foreach ( $attachments as $attachment ) {
				wp_update_post( array(
					'ID' => $attachment->ID,
					'post_parent' => 0
					)
				);
			}
		}
		wp_delete_post( the_ID(), true);
	endwhile;

	wp_reset_postdata();
}

/**
 * Updates Options Framework version in the database
 *
 * @access      public
 * @since       1.5
 * @return      void
 */

function optionsframework_update_version() {
	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['version'] = '1.5';
	update_option( 'optionsframework', $optionsframework_settings );
}