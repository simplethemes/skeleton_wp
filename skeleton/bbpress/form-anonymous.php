<?php

/**
 * Anonymous User
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php if ( bbp_is_anonymous() || ( bbp_is_topic_edit() && bbp_is_topic_anonymous() ) || ( bbp_is_reply_edit() && bbp_is_reply_anonymous() ) ) : ?>

	<?php do_action( 'bbp_theme_before_anonymous_form' ); ?>

	<fieldset class="bbp-form">
		<legend><?php ( bbp_is_topic_edit() || bbp_is_reply_edit() ) ? _e( 'Author Information', 'bbpress' ) : _e( 'Your information:', 'bbpress' ); ?></legend>

		<?php do_action( 'bbp_theme_anonymous_form_extras_top' ); ?>

		<p>
			<label for="bbp_anonymous_author"><?php _e( 'Name (required):', 'bbpress' ); ?></label><br />
			<input type="text" id="bbp_anonymous_author"  value="<?php bbp_is_topic_edit() ? bbp_topic_author()       : bbp_is_reply_edit() ? bbp_reply_author()       : bbp_current_anonymous_user_data( 'name' );    ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_anonymous_name" />
		</p>

		<p>
			<label for="bbp_anonymous_email"><?php _e( 'Mail (will not be published) (required):', 'bbpress' ); ?></label><br />
			<input type="text" id="bbp_anonymous_email"   value="<?php bbp_is_topic_edit() ? bbp_topic_author_email() : bbp_is_reply_edit() ? bbp_reply_author_email() : bbp_current_anonymous_user_data( 'email' );   ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_anonymous_email" />
		</p>

		<p>
			<label for="bbp_anonymous_website"><?php _e( 'Website:', 'bbpress' ); ?></label><br />
			<input type="text" id="bbp_anonymous_website" value="<?php bbp_is_topic_edit() ? bbp_topic_author_url()   : bbp_is_reply_edit() ? bbp_reply_author_url()   : bbp_current_anonymous_user_data( 'website' ); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_anonymous_website" />
		</p>

		<?php do_action( 'bbp_theme_anonymous_form_extras_bottom' ); ?>

	</fieldset>

	<?php do_action( 'bbp_theme_after_anonymous_form' ); ?>

<?php endif; ?>
