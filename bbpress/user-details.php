<?php

/**
 * User Details
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<span class="page-title author">

		<?php printf( __( 'Profile: %s', 'bbpress' ), "<span class='vcard'><a class='url fn n' href='" . bbp_get_user_profile_url() . "' title='" . esc_attr( bbp_get_displayed_user_field( 'display_name' ) ) . "' rel='me'>" . bbp_get_displayed_user_field( 'display_name' ) . "</a></span>" ); ?>

		<?php if ( bbp_is_user_home() || current_user_can( 'edit_users' ) ) : ?>

			<span class="edit_user_link"><a href="<?php bbp_user_profile_edit_url(); ?>" title="<?php printf( __( 'Edit Profile of User %s', 'bbpress' ), esc_attr( bbp_get_displayed_user_field( 'display_name' ) ) ); ?>"><?php _e( '(Edit)', 'bbpress' ); ?></a></span>

		<?php endif; ?>

	</span>

	<div id="entry-author-info">
		<div id="author-avatar">

			<?php echo get_avatar( bbp_get_displayed_user_field( 'user_email' ), apply_filters( 'skeleton_author_bio_avatar_size', 60 ) ); ?>

		</div><!-- #author-avatar -->
		<div id="author-description">
			<h1><?php printf( __( 'About %s', 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?></h1>

			<?php echo bbp_get_displayed_user_field( 'description' ); ?>

		</div><!-- #author-description	-->
	</div><!-- #entry-author-info -->
