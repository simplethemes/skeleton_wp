<?php

/**
 * Replies Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php do_action( 'bbp_template_before_replies_loop' ); ?>

	<table class="bbp-replies" id="topic-<?php bbp_topic_id(); ?>-replies">
		<thead>
			<tr>
				<th class="bbp-reply-author"><?php  _e( 'Author',  'bbpress' ); ?></th>
				<th class="bbp-reply-content">

					<?php if ( !bbp_show_lead_topic() ) : ?>

						<?php _e( 'Posts', 'bbpress' ); ?>

						<?php bbp_user_subscribe_link(); ?>

						<?php bbp_user_favorites_link(); ?>

					<?php else : ?>

						<?php _e( 'Replies', 'bbpress' ); ?>

					<?php endif; ?>

				</th>
			</tr>
		</thead>

		<tfoot>
			<tr>
				<th class="bbp-reply-author"><?php  _e( 'Author',  'bbpress' ); ?></th>
				<th class="bbp-reply-content">

					<?php if ( !bbp_show_lead_topic() ) : ?>

						<?php _e( 'Posts', 'bbpress' ); ?>

					<?php else : ?>

						<?php _e( 'Replies', 'bbpress' ); ?>

					<?php endif; ?>

				</th>
			</tr>
		</tfoot>

		<tbody>

			<?php while ( bbp_replies() ) : bbp_the_reply(); ?>

				<tr class="bbp-reply-header">
					<td colspan="2">

						<?php printf( __( '%1$s at %2$s', 'bbpress' ), get_the_date(), esc_attr( get_the_time() ) ); ?>

						<a href="<?php bbp_reply_url(); ?>" title="<?php bbp_reply_title(); ?>" class="bbp-reply-permalink">#<?php bbp_reply_id(); ?></a>

						<?php bbp_reply_admin_links(); ?>

					</td>
				</tr>

				<tr id="post-<?php bbp_reply_id(); ?>" <?php bbp_reply_class(); ?>>

					<td class="bbp-reply-author">

						<?php bbp_reply_author_link(); ?>

						<?php if ( is_super_admin() ) : ?>
						
							<div class="bbp-reply-ip"><?php bbp_author_ip( bbp_get_reply_id() ); ?></div>

						<?php endif; ?>

					</td>

					<td class="bbp-reply-content">

						<?php bbp_reply_content(); ?>

					</td>

				</tr><!-- #post-<?php bbp_topic_id(); ?> -->

			<?php endwhile; ?>

		</tbody>

	</table>

	<?php do_action( 'bbp_template_after_replies_loop' ); ?>
