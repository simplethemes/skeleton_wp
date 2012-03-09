<?php

/**
 * bbPress User Profile Edit Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<form id="bbp-your-profile" action="<?php bbp_user_profile_edit_url( bbp_get_displayed_user_id() ); ?>" method="post">

	<h2 class="entry-title"><?php _e( 'Name', 'bbpress' ) ?></h2>

	<?php do_action( 'bbp_user_edit_before' ); ?>

	<fieldset class="bbp-form">
		<legend><?php _e( 'Name', 'bbpress' ) ?></legend>

		<?php do_action( 'bbp_user_edit_before_name' ); ?>

		<div>
			<label for="first_name"><?php _e( 'First Name', 'bbpress' ) ?></label>
			<input type="text" name="first_name" id="first_name" value="<?php echo esc_attr( bbp_get_displayed_user_field( 'first_name' ) ); ?>" class="regular-text" tabindex="<?php bbp_tab_index(); ?>" />
		</div>

		<div>
			<label for="last_name"><?php _e( 'Last Name', 'bbpress' ) ?></label>
			<input type="text" name="last_name" id="last_name" value="<?php echo esc_attr( bbp_get_displayed_user_field( 'last_name' ) ); ?>" class="regular-text" tabindex="<?php bbp_tab_index(); ?>" />
		</div>

		<div>
			<label for="nickname"><?php _e( 'Nickname', 'bbpress' ); ?></label>
			<input type="text" name="nickname" id="nickname" value="<?php echo esc_attr( bbp_get_displayed_user_field( 'nickname' ) ); ?>" class="regular-text" tabindex="<?php bbp_tab_index(); ?>" />
		</div>

		<div>
			<label for="display_name"><?php _e( 'Display name publicly as', 'bbpress' ) ?></label>

			<?php bbp_edit_user_display_name(); ?>

		</div>

		<?php do_action( 'bbp_user_edit_after_name' ); ?>

	</fieldset>

	<h2 class="entry-title"><?php _e( 'Contact Info', 'bbpress' ) ?></h2>

	<fieldset class="bbp-form">
		<legend><?php _e( 'Contact Info', 'bbpress' ) ?></legend>

		<?php do_action( 'bbp_user_edit_before_contact' ); ?>

		<div>
			<label for="url"><?php _e( 'Website', 'bbpress' ) ?></label>
			<input type="text" name="url" id="url" value="<?php echo esc_attr( bbp_get_displayed_user_field( 'user_url' ) ); ?>" class="regular-text code" tabindex="<?php bbp_tab_index(); ?>" />
		</div>

		<?php foreach ( bbp_edit_user_contact_methods() as $name => $desc ) : ?>

			<div>
				<label for="<?php echo $name; ?>"><?php echo apply_filters( 'user_'.$name.'_label', $desc ); ?></label>
				<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_attr( bbp_get_displayed_user_field( 'name' ) ); ?>" class="regular-text" tabindex="<?php bbp_tab_index(); ?>" />
			</div>

		<?php endforeach; ?>

		<?php do_action( 'bbp_user_edit_after_contact' ); ?>

	</fieldset>

	<h2 class="entry-title"><?php bbp_is_user_home() ? _e( 'About Yourself', 'bbpress' ) : _e( 'About the user', 'bbpress' ); ?></h2>

	<fieldset class="bbp-form">
		<legend><?php bbp_is_user_home() ? _e( 'About Yourself', 'bbpress' ) : _e( 'About the user', 'bbpress' ); ?></legend>

		<?php do_action( 'bbp_user_edit_before_about' ); ?>

		<div>
			<label for="description"><?php _e( 'Biographical Info', 'bbpress' ); ?></label>
			<textarea name="description" id="description" rows="5" cols="30" tabindex="<?php bbp_tab_index(); ?>"><?php echo esc_attr( bbp_get_displayed_user_field( 'description' ) ); ?></textarea>
			<span class="description"><?php _e( 'Share a little biographical information to fill out your profile. This may be shown publicly.', 'bbpress' ); ?></span>
		</div>

		<?php do_action( 'bbp_user_edit_after_about' ); ?>

	</fieldset>

	<h2 class="entry-title"><?php _e( 'Account' ) ?></h2>

	<fieldset class="bbp-form">
		<legend><?php _e( 'Account' ) ?></legend>

		<?php do_action( 'bbp_user_edit_before_account' ); ?>

		<div>
			<label for="user_login"><?php _e( 'Username', 'bbpress' ); ?></label>
			<input type="text" name="user_login" id="user_login" value="<?php echo esc_attr( bbp_get_displayed_user_field( 'user_login' ) ); ?>" disabled="disabled" class="regular-text" tabindex="<?php bbp_tab_index(); ?>" />
			<span class="description"><?php _e( 'Usernames cannot be changed.', 'bbpress' ); ?></span>
		</div>

		<div>
			<label for="email"><?php _e( 'Email', 'bbpress' ); ?></label>

			<input type="text" name="email" id="email" value="<?php echo esc_attr( bbp_get_displayed_user_field( 'user_email' ) ); ?>" class="regular-text" tabindex="<?php bbp_tab_index(); ?>" />

			<?php

			// Handle address change requests
			$new_email = get_option( bbp_get_displayed_user_id() . '_new_email' );
			if ( $new_email && $new_email != bbp_get_displayed_user_field( 'user_email' ) ) : ?>

				<span class="updated inline">

					<?php printf( __( 'There is a pending email address change to <code>%1$s</code>. <a href="%2$s">Cancel</a>', 'bbpress' ), $new_email['newemail'], esc_url( self_admin_url( 'user.php?dismiss=' . bbp_get_current_user_id()  . '_new_email' ) ) ); ?>

				</span>

			<?php endif; ?>

		</div>

		<div id="password">
			<label for="pass1"><?php _e( 'New Password', 'bbpress' ); ?></label>
			<fieldset class="bbp-form">
				<input type="password" name="pass1" id="pass1" size="16" value="" autocomplete="off" tabindex="<?php bbp_tab_index(); ?>" />
				<span class="description"><?php _e( 'If you would like to change the password type a new one. Otherwise leave this blank.', 'bbpress' ); ?></span>

				<input type="password" name="pass2" id="pass2" size="16" value="" autocomplete="off" tabindex="<?php bbp_tab_index(); ?>" />
				<span class="description"><?php _e( 'Type your new password again.', 'bbpress' ); ?></span><br />

				<div id="pass-strength-result"></div>
				<span class="description indicator-hint"><?php _e( 'Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).', 'bbpress' ); ?></span>
			</fieldset>
		</div>

		<?php if ( !bbp_is_user_home() ) : ?>

			<div>
				<label for="role"><?php _e( 'Role:', 'bbpress' ) ?></label>

				<?php bbp_edit_user_role(); ?>

			</div>

		<?php endif; ?>

		<?php if ( is_multisite() && is_super_admin() && current_user_can( 'manage_network_options' ) ) : ?>

			<div>
				<label for="role"><?php _e( 'Super Admin', 'bbpress' ); ?></label>
				<label>
					<input type="checkbox" id="super_admin" name="super_admin"<?php checked( is_super_admin( bbp_get_displayed_user_id() ) ); ?> tabindex="<?php bbp_tab_index(); ?>" />
					<?php _e( 'Grant this user super admin privileges for the Network.', 'bbpress' ); ?>
				</label>
			</div>

		<?php endif; ?>

		<?php do_action( 'bbp_user_edit_after_account' ); ?>

	</fieldset>

	<?php do_action( 'bbp_user_edit_after' ); ?>

	<fieldset class="submit">
		<legend><?php _e( 'Save Changes', 'bbpress' ); ?></legend>
		<div>

			<?php bbp_edit_user_form_fields(); ?>

			<button type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_user_edit_submit" name="bbp_user_edit_submit" class="button submit user-submit"><?php bbp_is_user_home() ? _e( 'Update Profile', 'bbpress' ) : _e( 'Update User', 'bbpress' ); ?></button>
		</div>
	</fieldset>

</form>