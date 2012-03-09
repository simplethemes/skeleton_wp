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

				<?php bbp_get_template_part( 'bbpress/loop', 'single-topic' ); ?>

			<?php endwhile; ?>

		</tbody>

	</table><!-- #bbp-forum-<?php bbp_topic_id(); ?> -->

	<?php do_action( 'bbp_template_after_topics_loop' ); ?>
