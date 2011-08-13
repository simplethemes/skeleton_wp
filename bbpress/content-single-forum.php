<?php

/**
 * Single Topic Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php bbp_breadcrumb(); ?>

	<?php if ( post_password_required() ) : ?>

		<?php bbp_get_template_part( 'bbpress/form', 'protected' ); ?>

	<?php else : ?>

		<?php bbp_single_forum_description(); ?>

		<?php if ( bbp_get_forum_subforum_count() && bbp_has_forums() ) : ?>

			<?php bbp_get_template_part( 'bbpress/loop', 'forums' ); ?>

		<?php endif; ?>

		<?php if ( !bbp_is_forum_category() && bbp_has_topics() ) : ?>

			<?php bbp_get_template_part( 'bbpress/pagination', 'topics'    ); ?>

			<?php bbp_get_template_part( 'bbpress/loop',       'topics'    ); ?>

			<?php bbp_get_template_part( 'bbpress/pagination', 'topics'    ); ?>

			<?php bbp_get_template_part( 'bbpress/form',       'topic'     ); ?>

		<?php elseif( !bbp_is_forum_category() ) : ?>

			<?php bbp_get_template_part( 'bbpress/feedback',   'no-topics' ); ?>

			<?php bbp_get_template_part( 'bbpress/form',       'topic'     ); ?>

		<?php endif; ?>

	<?php endif; ?>