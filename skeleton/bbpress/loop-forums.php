<?php

/**
 * Forums Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php do_action( 'bbp_template_before_forums_loop' ); ?>

	<table class="bbp-forums">

		<thead>
			<tr>
				<th class="bbp-forum-info"><?php _e( 'Forum', 'bbpress' ); ?></th>
				<th class="bbp-forum-topic-count"><?php _e( 'Topics', 'bbpress' ); ?></th>
				<th class="bbp-forum-reply-count"><?php bbp_show_lead_topic() ? _e( 'Replies', 'bbpress' ) : _e( 'Posts', 'bbpress' ); ?></th>
				<th class="bbp-forum-freshness"><?php _e( 'Freshness', 'bbpress' ); ?></th>
			</tr>
		</thead>

		<tfoot>
			<tr><td colspan="4">&nbsp;</td></tr>
		</tfoot>

		<tbody>

			<?php while ( bbp_forums() ) : bbp_the_forum(); ?>

				<tr id="bbp-forum-<?php bbp_forum_id(); ?>" <?php bbp_forum_class(); ?>>

					<td class="bbp-forum-info">
						<a class="bbp-forum-title" href="<?php bbp_forum_permalink(); ?>" title="<?php bbp_forum_title(); ?>"><?php bbp_forum_title(); ?></a>

						<?php bbp_list_forums(); ?>

						<div class="bbp-forum-description"><?php the_content(); ?></div>
					</td>

					<td class="bbp-forum-topic-count"><?php bbp_forum_topic_count(); ?></td>

					<td class="bbp-forum-reply-count"><?php bbp_show_lead_topic() ? bbp_forum_reply_count() : bbp_forum_post_count(); ?></td>

					<td class="bbp-forum-freshness">

						<?php bbp_forum_freshness_link(); ?>

						<p class="bbp-topic-meta">

							<span class="bbp-topic-freshness-author"><?php bbp_author_link( array( 'post_id' => bbp_get_forum_last_active_id(), 'size' => 14 ) ); ?></span>

						</p>
					</td>

				</tr><!-- bbp-forum-<?php bbp_forum_id(); ?> -->

			<?php endwhile; ?>

		</tbody>

	</table>

	<?php do_action( 'bbp_template_after_forums_loop' ); ?>
