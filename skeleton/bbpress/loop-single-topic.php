<?php

/**
 * Topics Loop - Single
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<tr id="topic-<?php bbp_topic_id(); ?>" <?php bbp_topic_class(); ?>>

		<td class="bbp-topic-title">

			<?php do_action( 'bbp_theme_before_topic_title' ); ?>

			<a href="<?php bbp_topic_permalink(); ?>" title="<?php bbp_topic_title(); ?>"><?php bbp_topic_title(); ?></a>

			<?php do_action( 'bbp_theme_after_topic_title' ); ?>

			<?php bbp_topic_pagination(); ?>

			<?php do_action( 'bbp_theme_before_topic_meta' ); ?>

			<p class="bbp-topic-meta">

				<?php do_action( 'bbp_theme_before_topic_started_by' ); ?>

				<span class="bbp-topic-started-by"><?php printf( __( 'Started by: %1$s', 'bbpress' ), bbp_get_topic_author_link( array( 'size' => '14' ) ) ); ?></span>

				<?php do_action( 'bbp_theme_after_topic_started_by' ); ?>

				<?php if ( !bbp_is_single_forum() || ( bbp_get_topic_forum_id() != bbp_get_forum_id() ) ) : ?>

					<?php do_action( 'bbp_theme_before_topic_started_in' ); ?>

					<span class="bbp-topic-started-in"><?php printf( __( 'in: <a href="%1$s">%2$s</a>', 'bbpress' ), bbp_get_forum_permalink( bbp_get_topic_forum_id() ), bbp_get_forum_title( bbp_get_topic_forum_id() ) ); ?></span>

					<?php do_action( 'bbp_theme_after_topic_started_in' ); ?>

				<?php endif; ?>

			</p>

			<?php do_action( 'bbp_theme_after_topic_meta' ); ?>

		</td>

		<td class="bbp-topic-voice-count"><?php bbp_topic_voice_count(); ?></td>

		<td class="bbp-topic-reply-count"><?php bbp_show_lead_topic() ? bbp_topic_reply_count() : bbp_topic_post_count(); ?></td>

		<td class="bbp-topic-freshness">

			<?php do_action( 'bbp_theme_before_topic_freshness_link' ); ?>

			<?php bbp_topic_freshness_link(); ?>

			<?php do_action( 'bbp_theme_after_topic_freshness_link' ); ?>

			<p class="bbp-topic-meta">

				<?php do_action( 'bbp_theme_before_topic_freshness_author' ); ?>

				<span class="bbp-topic-freshness-author"><?php bbp_author_link( array( 'post_id' => bbp_get_topic_last_active_id(), 'size' => 14 ) ); ?></span>

				<?php do_action( 'bbp_theme_after_topic_freshness_author' ); ?>

			</p>
		</td>

		<?php if ( bbp_is_user_home() ) : ?>

			<?php if ( bbp_is_favorites() ) : ?>

				<td class="bbp-topic-action">

					<?php do_action( 'bbp_theme_before_topic_favorites_action' ); ?>

					<?php bbp_user_favorites_link( array( 'mid' => '+', 'post' => '' ), array( 'pre' => '', 'mid' => '&times;', 'post' => '' ) ); ?>

					<?php do_action( 'bbp_theme_after_topic_favorites_action' ); ?>

				</td>

			<?php elseif ( bbp_is_subscriptions() ) : ?>

				<td class="bbp-topic-action">

					<?php do_action( 'bbp_theme_before_topic_subscription_action' ); ?>

					<?php bbp_user_subscribe_link( array( 'before' => '', 'subscribe' => '+', 'unsubscribe' => '&times;' ) ); ?>

					<?php do_action( 'bbp_theme_after_topic_subscription_action' ); ?>

				</td>

			<?php endif; ?>

		<?php endif; ?>

	</tr><!-- #topic-<?php bbp_topic_id(); ?> -->
