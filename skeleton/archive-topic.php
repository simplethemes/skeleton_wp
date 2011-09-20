<?php

/**
 * bbPress - Topic Archive
 *
 * @package bbPress
 * @subpackage Theme
 */

get_header();

st_before_content($columns='');

do_action( 'bbp_template_notices' );
?>

	<div id="topic-front" class="bbp-topics-front">
		<h1 class="entry-title"><?php bbp_topic_archive_title(); ?></h1>
		<div class="entry-content">

			<?php bbp_get_template_part( 'bbpress/content', 'archive-topic' ); ?>

		</div>
	</div><!-- #topics-front -->


<?php
st_after_content();
// get_sidebar('bbpress');
get_footer();
?>