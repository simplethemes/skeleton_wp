<?php

/**
 * Topics Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php do_action( 'bbp_template_before_topics_loop' ); ?>

	<table class="bbp-topics" id="bbp-forum-<?php bbp_topic_id(); ?>">
		<thead>
			<tr>
				<th class="bbp-topic-title"><?php _e( 'Topic', 'bbpress' ); ?></th>
				<th class="bbp-topic-voice-count"><?php _e( 'Voices', 'bbpress' ); ?></th>
				<th class="bbp-topic-reply-count"><?php bbp_show_lead_topic() ? _e( 'Replies', 'bbpress' ) : _e( 'Posts', 'bbpress' ); ?></th>
				<th class="bbp-topic-freshness"><?php _e( 'Freshness', 'bbpress' ); ?></th>
				<?php if ( ( bbp_is_user_home() && ( bbp_is_favorites() || bbp_is_subscriptions() ) ) ) : ?><th class="bbp-topic-action"><?php _e( 'Remove', 'bbpress' ); ?></th><?php endif; ?>
			</tr>
		</thead>

		<tfoot>
			<tr><td colspan="<?php echo ( bbp_is_user_home() && ( bbp_is_favorites() || bbp_is_subscriptions() ) ) ? '5' : '4'; ?>">&nbsp;</td></tr>
		</tfoot>

		<tbody>

			<?php while ( bbp_topics() ) : bbp_the_topic(); ?>

				<tr id="topic-<?php bbp_topic_id(); ?>" <?php bbp_topic_class(); ?>>

					<td class="bbp-topic-title">
						<a href="<?php bbp_topic_permalink(); ?>" title="<?php bbp_topic_title(); ?>"><?php bbp_topic_title(); ?></a>

						<?php bbp_topic_pagination(); ?>

						<p class="bbp-topic-meta">

							<span class="bbp-topic-started-by"><?php printf( __( 'Started by: %1$s', 'bbpress' ), bbp_get_topic_author_link( array( 'size' => '14' ) ) ); ?></span>

							<?php if ( !bbp_is_single_forum() || ( bbp_get_topic_forum_id() != bbp_get_forum_id() ) ) : ?>

								<span class="bbp-topic-started-in"><?php printf( __( 'in: <a href="%1$s">%2$s</a>', 'bbpress' ), bbp_get_forum_permalink( bbp_get_topic_forum_id() ), bbp_get_forum_title( bbp_get_topic_forum_id() ) ); ?></span>

							<?php endif; ?>

						</p>
					</td>

					<td class="bbp-topic-voice-count"><?php bbp_topic_voice_count(); ?></td>

					<td class="bbp-topic-reply-count"><?php bbp_show_lead_topic() ? bbp_topic_reply_count() : bbp_topic_post_count(); ?></td>

					<td class="bbp-topic-freshness">

						<?php bbp_topic_freshness_link(); ?>

						<p class="bbp-topic-meta">

							<span class="bbp-topic-freshness-author"><?php bbp_author_link( array( 'post_id' => bbp_get_topic_last_active_id(), 'size' => 14 ) ); ?></span>

						</p>
					</td>

					<?php if ( bbp_is_user_home() ) : ?>

						<?php if ( bbp_is_favorites() ) : ?>

							<td class="bbp-topic-action">

								<?php bbp_user_favorites_link( array( 'mid' => '+', 'post' => '' ), array( 'pre' => '', 'mid' => '&times;', 'post' => '' ) ); ?>

							</td>

						<?php elseif ( bbp_is_subscriptions() ) : ?>

							<td class="bbp-topic-action">

								<?php bbp_user_subscribe_link( array( 'before' => '', 'subscribe' => '+', 'unsubscribe' => '&times;' ) ); ?>

							</td>

						<?php endif; ?>

					<?php endif; ?>

				</tr><!-- #topic-<?php bbp_topic_id(); ?> -->

			<?php endwhile; ?>

		</tbody>

	</table><!-- #bbp-forum-<?php bbp_topic_id(); ?> -->

	<?php do_action( 'bbp_template_after_topics_loop' ); ?>

