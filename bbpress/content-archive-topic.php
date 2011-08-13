<?php

/**
 * Archive Topic Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php bbp_breadcrumb(); ?>

	<?php do_action( 'bbp_template_before_topics_index' ); ?>

	<?php if ( bbp_has_topics() ) : ?>

		<?php bbp_get_template_part( 'bbpress/pagination', 'topics'    ); ?>

		<?php bbp_get_template_part( 'bbpress/loop',       'topics'    ); ?>

		<?php bbp_get_template_part( 'bbpress/pagination', 'topics'    ); ?>

	<?php else : ?>

		<?php bbp_get_template_part( 'bbpress/feedback',   'no-topics' ); ?>

	<?php endif; ?>

	<?php do_action( 'bbp_template_after_topics_index' ); ?>
