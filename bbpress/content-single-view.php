<?php

/**
 * Single View Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php bbp_breadcrumb(); ?>

	<?php bbp_set_query_name( 'bbp_view' ); ?>

	<?php if ( bbp_view_query() ) : ?>

		<?php bbp_get_template_part( 'bbpress/pagination', 'topics'    ); ?>

		<?php bbp_get_template_part( 'bbpress/loop',       'topics'    ); ?>

		<?php bbp_get_template_part( 'bbpress/pagination', 'topics'    ); ?>

	<?php else : ?>

		<?php bbp_get_template_part( 'bbpress/feedback',   'no-topics' ); ?>

	<?php endif; ?>

	<?php bbp_reset_query_name(); ?>