<?php

/**
 * New/Edit Topic
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php if ( !bbp_is_single_forum() ) : ?>

		<?php bbp_breadcrumb(); ?>

	<?php endif; ?>

	<?php if ( bbp_is_topic_edit() ) : ?>

		<?php bbp_topic_tag_list( bbp_get_topic_id() ); ?>

		<?php bbp_single_topic_description( array( 'topic_id' => bbp_get_topic_id() ) ); ?>

	<?php endif; ?>

	<?php if ( bbp_current_user_can_access_create_topic_form() ) : ?>

		<div id="new-topic-<?php bbp_topic_id(); ?>" class="bbp-topic-form">

			<form id="new-post" name="new-post" method="post" action="">
				<fieldset class="bbp-form">
					<legend>

						<?php
							if ( bbp_is_topic_edit() )
								printf( __( 'Now Editing &ldquo;%s&rdquo;', 'bbpress' ), bbp_get_topic_title() );
							else
								bbp_is_single_forum() ? printf( __( 'Create New Topic in &ldquo;%s&rdquo;', 'bbpress' ), bbp_get_forum_title() ) : _e( 'Create New Topic', 'bbpress' );
						?>

					</legend>

					<?php if ( !bbp_is_topic_edit() && bbp_is_forum_closed() ) : ?>

						<div class="bbp-template-notice">
							<p><?php _e( 'This forum is marked as closed to new topics, however your posting capabilities still allow you to do so.', 'bbpress' ); ?></p>
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
							<?php bbp_is_topic_edit() ? bbp_reply_author_avatar( bbp_get_reply_id(), 64 ) : bbp_current_user_avatar( 64 ); ?>
						</div>

						<?php bbp_get_template_part( 'bbpress/form', 'anonymous' ); ?>

						<p>
							<label for="bbp_topic_title"><?php printf( __( 'Topic Title (Maximum Length: %d):', 'bbpress' ), bbp_get_title_max_length() ); ?></label><br />
							<input type="text" id="bbp_topic_title" value="<?php bbp_form_topic_title(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_topic_title" maxlength="<?php bbp_title_max_length(); ?>" />
						</p>

						<p>
							<label for="bbp_topic_content"><?php _e( 'Topic Description:', 'bbpress' ); ?></label><br />
							<textarea id="bbp_topic_content" tabindex="<?php bbp_tab_index(); ?>" name="bbp_topic_content" cols="51" rows="6"><?php bbp_form_topic_content(); ?></textarea>
						</p>

						<?php if ( !current_user_can( 'unfiltered_html' ) ) : ?>

							<p class="form-allowed-tags">
								<label><?php _e( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:','bbpress' ); ?></label><br />
								<code><?php bbp_allowed_tags(); ?></code>
							</p>

						<?php endif; ?>

						<p>
							<label for="bbp_topic_tags"><?php _e( 'Topic Tags:', 'bbpress' ); ?></label><br />
							<input type="text" value="<?php bbp_form_topic_tags(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_topic_tags" id="bbp_topic_tags" />
						</p>

						<?php if ( !bbp_is_single_forum() ) : ?>

							<p>
								<label for="bbp_forum_id"><?php _e( 'Forum:', 'bbpress' ); ?></label><br />
								<?php bbp_dropdown( array( 'selected' => bbp_get_form_topic_forum() ) ); ?>
							</p>

						<?php endif; ?>

						<?php if ( current_user_can( 'moderate' ) ) : ?>

							<p>

								<label for="bbp_stick_topic"><?php _e( 'Topic Type:', 'bbpress' ); ?></label><br />

								<?php bbp_topic_type_select(); ?>

							</p>

						<?php endif; ?>

						<?php if ( bbp_is_subscriptions_active() && !bbp_is_anonymous() && ( !bbp_is_topic_edit() || ( bbp_is_topic_edit() && !bbp_is_topic_anonymous() ) ) ) : ?>

							<p>
								<input name="bbp_topic_subscription" id="bbp_topic_subscription" type="checkbox" value="bbp_subscribe" <?php bbp_form_topic_subscribed(); ?> tabindex="<?php bbp_tab_index(); ?>" />

								<?php if ( bbp_is_topic_edit() && ( $post->post_author != bbp_get_current_user_id() ) ) : ?>

									<label for="bbp_topic_subscription"><?php _e( 'Notify the author of follow-up replies via email', 'bbpress' ); ?></label>

								<?php else : ?>

									<label for="bbp_topic_subscription"><?php _e( 'Notify me of follow-up replies via email', 'bbpress' ); ?></label>

								<?php endif; ?>
							</p>

						<?php endif; ?>

						<?php if ( bbp_is_topic_edit() ) : ?>

							<fieldset class="bbp-form">
								<legend><?php _e( 'Revision', 'bbpress' ); ?></legend>
								<div>
									<input name="bbp_log_topic_edit" id="bbp_log_topic_edit" type="checkbox" value="1" <?php bbp_form_topic_log_edit(); ?> tabindex="<?php bbp_tab_index(); ?>" />
									<label for="bbp_log_topic_edit"><?php _e( 'Keep a log of this edit:', 'bbpress' ); ?></label><br />
								</div>

								<div>
									<label for="bbp_topic_edit_reason"><?php printf( __( 'Optional reason for editing:', 'bbpress' ), bbp_get_current_user_name() ); ?></label><br />
									<input type="text" value="<?php bbp_form_topic_edit_reason(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_topic_edit_reason" id="bbp_topic_edit_reason" />
								</div>
							</fieldset>

						<?php endif; ?>

						<div class="bbp-submit-wrapper">
							<button type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_topic_submit" name="bbp_topic_submit"><?php _e( 'Submit', 'bbpress' ); ?></button>
						</div>
					</div>

					<?php bbp_topic_form_fields(); ?>

				</fieldset>
			</form>
		</div>

	<?php elseif ( bbp_is_forum_closed() ) : ?>

		<div id="no-topic-<?php bbp_topic_id(); ?>" class="bbp-no-topic">
			<div class="bbp-template-notice">
				<p><?php printf( __( 'The forum &#8216;%s&#8217; is closed to new topics and replies.', 'bbpress' ), bbp_get_forum_title() ); ?></p>
			</div>
		</div>

	<?php else : ?>

		<div id="no-topic-<?php bbp_topic_id(); ?>" class="bbp-no-topic">
			<div class="bbp-template-notice">
				<p><?php is_user_logged_in() ? _e( 'You cannot create new topics at this time.', 'bbpress' ) : _e( 'You must be logged in to create new topics.', 'bbpress' ); ?></p>
			</div>
		</div>

	<?php endif; ?>
