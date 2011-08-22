<?php

/**
 * User Subscriptions
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php if ( bbp_is_subscriptions_active() ) : ?>

		<?php if ( bbp_is_user_home() || current_user_can( 'edit_users' ) ) : ?>

			<?php bbp_set_query_name( 'bbp_user_profile_subscriptions' ); ?>

			<div id="bbp-author-subscriptions" class="bbp-author-subscriptions">
				<hr />
				<h2 class="entry-title"><?php _e( 'Subscribed Forum Topics', 'bbpress' ); ?></h2>
				<div class="entry-content">

					<?php if ( bbp_get_user_subscriptions() ) :

						bbp_get_template_part( 'bbpress/pagination', 'topics' );
						bbp_get_template_part( 'bbpress/loop',       'topics' );
						bbp_get_template_part( 'bbpress/pagination', 'topics' );

					else : ?>

						<p><?php bbp_is_user_home() ? _e( 'You are not currently subscribed to any topics.', 'bbpress' ) : _e( 'This user is not currently subscribed to any topics.', 'bbpress' ); ?></p>

					<?php endif; ?>

				</div>
			</div><!-- #bbp-author-subscriptions -->

			<?php bbp_reset_query_name(); ?>

		<?php endif; ?>

	<?php endif; ?>
