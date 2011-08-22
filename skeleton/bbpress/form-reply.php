<?php

/**
 * New/Edit Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php if ( bbp_is_reply_edit() ) : ?>

		<?php bbp_breadcrumb(); ?>

	<?php endif; ?>

	<?php if ( bbp_current_user_can_access_create_reply_form() ) : ?>

		<div id="new-reply-<?php bbp_topic_id(); ?>" class="bbp-reply-form">

			<form id="new-post" name="new-post" method="post" action="">
				<fieldset class="bbp-form">
					<legend><?php printf( __( 'Reply To: %s', 'bbpress' ), bbp_get_topic_title() ); ?></legend>

					<?php if ( !bbp_is_topic_open() && !bbp_is_reply_edit() ) : ?>

						<div class="bbp-template-notice">
							<p><?php _e( 'This topic is marked as closed to new replies, however your posting capabilities still allow you to do so.', 'bbpress' ); ?></p>
						</div>

					<?php endif; ?>

					<?php if ( current_user_can( 'unfiltered_html' ) ) : ?>

						<div class="bbp-template-notice">
							<p><?php _e( 'Your account has the ability to post unrestricted HTML content.', 'bbpress' ); ?></p>
						</div>

					<?php endif; ?>

					<?php do_action( 'bbp_template_notices' ); ?>

					<div>

						<div class="author-avatar">
							<?php bbp_is_reply_edit() ? bbp_reply_author_avatar( bbp_get_reply_id(), 64 ) : bbp_current_user_avatar( 64 ); ?>
						</div>

						<?php bbp_get_template_part( 'bbpress/form', 'anonymous' ); ?>

						<p>
							<label for="bbp_reply_content"><?php _e( 'Reply:', 'bbpress' ); ?></label><br />
							<textarea id="bbp_reply_content" tabindex="<?php bbp_tab_index(); ?>" name="bbp_reply_content" cols="51" rows="6"><?php bbp_form_reply_content(); ?></textarea>
						</p>

						<?php if ( !current_user_can( 'unfiltered_html' ) ) : ?>

							<p class="form-allowed-tags">
								<label><?php _e( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:','bbpress' ); ?></label><br />
								<code><?php bbp_allowed_tags(); ?></code>
							</p>

						<?php endif; ?>

						<p>
							<label for="bbp_topic_tags"><?php _e( 'Tags:', 'bbpress' ); ?></label><br />
							<input id="bbp_topic_tags" type="text" value="<?php bbp_form_topic_tags(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_topic_tags" />
						</p>

						<?php if ( bbp_is_subscriptions_active() && !bbp_is_anonymous() && ( !bbp_is_reply_edit() || ( bbp_is_reply_edit() && !bbp_is_reply_anonymous() ) ) ) : ?>

							<p>

								<input name="bbp_topic_subscription" id="bbp_topic_subscription" type="checkbox" value="bbp_subscribe"<?php bbp_form_topic_subscribed(); ?> tabindex="<?php bbp_tab_index(); ?>" />

								<?php if ( bbp_is_reply_edit() && $post->post_author != bbp_get_current_user_id() ) : ?>

									<label for="bbp_topic_subscription"><?php _e( 'Notify the author of follow-up replies via email', 'bbpress' ); ?></label>

								<?php else : ?>

									<label for="bbp_topic_subscription"><?php _e( 'Notify me of follow-up replies via email', 'bbpress' ); ?></label>

								<?php endif; ?>

							</p>

						<?php endif; ?>

						<?php if ( bbp_is_reply_edit() ) : ?>

							<fieldset class="bbp-form">
								<legend><?php _e( 'Revision', 'bbpress' ); ?></legend>
								<div>
									<input name="bbp_log_reply_edit" id="bbp_log_reply_edit" type="checkbox" value="1" <?php bbp_form_reply_log_edit(); ?> tabindex="<?php bbp_tab_index(); ?>" />
									<label for="bbp_log_reply_edit"><?php _e( 'Keep a log of this edit:', 'bbpress' ); ?></label><br />
								</div>

								<div>
									<label for="bbp_reply_edit_reason"><?php printf( __( 'Optional reason for editing:', 'bbpress' ), bbp_get_current_user_name() ); ?></label><br />
									<input type="text" value="<?php bbp_form_reply_edit_reason(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_reply_edit_reason" id="bbp_reply_edit_reason" />
								</div>
							</fieldset>

						<?php else : ?>

							<?php bbp_topic_admin_links(); ?>

						<?php endif; ?>

						<div class="bbp-submit-wrapper">
							<button type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_reply_submit" name="bbp_reply_submit"><?php _e( 'Submit', 'bbpress' ); ?></button>
						</div>
					</div>

					<?php bbp_reply_form_fields(); ?>

				</fieldset>
			</form>
		</div>

	<?php elseif ( bbp_is_topic_closed() ) : ?>

		<div id="no-reply-<?php bbp_topic_id(); ?>" class="bbp-no-reply">
			<div class="bbp-template-notice">
				<p><?php printf( __( 'The topic &#8216;%s&#8217; is closed to new replies.', 'bbpress' ), bbp_get_topic_title() ); ?></p>
			</div>
		</div>

	<?php elseif ( bbp_is_forum_closed( bbp_get_topic_forum_id() ) ) : ?>

		<div id="no-reply-<?php bbp_topic_id(); ?>" class="bbp-no-reply">
			<div class="bbp-template-notice">
				<p><?php printf( __( 'The forum &#8216;%s&#8217; is closed to new topics and replies.', 'bbpress' ), bbp_get_forum_title( bbp_get_topic_forum_id() ) ); ?></p>
			</div>
		</div>

	<?php else : ?>

		<div id="no-reply-<?php bbp_topic_id(); ?>" class="bbp-no-reply">
			<div class="bbp-template-notice">
				<p><?php is_user_logged_in() ? _e( 'You cannot reply to this topic.', 'bbpress' ) : _e( 'You must be logged in to reply to this topic.', 'bbpress' ); ?></p>
			</div>
		</div>

	<?php endif; ?>
