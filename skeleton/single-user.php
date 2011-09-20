<?php

/**
 * User Profile
 *
 * @package bbPress
 * @subpackage Theme
 */

get_header();
st_before_content($columns='');
do_action( 'bbp_template_notices' );
?>

	<div id="bbp-user-<?php bbp_current_user_id(); ?>" class="bbp-single-user">
		<div class="entry-content">

			<?php bbp_get_template_part( 'bbpress/content', 'single-user' ); ?>

		</div><!-- .entry-content -->
	</div><!-- #bbp-user-<?php bbp_current_user_id(); ?> -->

<?php
st_after_content();
get_sidebar('bbpress');
get_footer();
?>