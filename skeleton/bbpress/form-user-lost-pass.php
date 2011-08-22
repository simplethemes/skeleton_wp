<?php

/**
 * User Lost Password Form
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<form method="post" action="<?php bbp_wp_login_action( array( 'action' => 'lostpassword', 'context' => 'login_post' ) ); ?>" class="bbp-user-register">
		<fieldset class="bbp-form">
			<legend><?php _e( 'Lost Password', 'bbpress' ); ?></legend>

			<div class="bbp-username">
				<p>
					<label for="user_login" class="hide"><?php _e( 'Username or Email', 'bbpress' ); ?>: </label>
					<input type="text" name="user_login" value="" size="20" id="user_login" tabindex="<?php bbp_tab_index(); ?>" />
				</p>
			</div>

			<div class="bbp-submit-wrapper">

				<?php do_action( 'login_form', 'resetpass' ); ?>

				<input type="submit" name="user-submit" value="<?php _e( 'Reset my password', 'bbpress' ); ?>" class="user-submit" tabindex="<?php bbp_tab_index(); ?>" />

				<?php bbp_user_lost_pass_fields(); ?>

			</div>
		</fieldset>
	</form>
