<?php

/**
 * Single Topic Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php bbp_breadcrumb(); ?>

	<?php do_action( 'bbp_template_before_single_topic' ); ?>

	<?php if ( post_password_required() ) : ?>

		<?php bbp_get_template_part( 'bbpress/form', 'protected' ); ?>

	<?php else : ?>

		<?php bbp_topic_tag_list(); ?>

		<?php bbp_single_topic_description(); ?>

		<?php if ( bbp_show_lead_topic() ) : ?>

			<?php bbp_get_template_part( 'bbpress/content', 'single-topic-lead' ); ?>

		<?php endif; ?>

		<?php if ( bbp_get_query_name() || bbp_has_replies() ) : ?>

			<?php bbp_get_template_part( 'bbpress/pagination', 'replies' ); ?>

			<?php bbp_get_template_part( 'bbpress/loop',       'replies' ); ?>

			<?php bbp_get_template_part( 'bbpress/pagination', 'replies' ); ?>

		<?php endif; ?>

		<?php bbp_get_template_part( 'bbpress/form', 'reply' ); ?>

	<?php endif; ?>

	<?php do_action( 'bbp_template_after_single_topic' ); ?>