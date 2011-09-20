<?php

/**
 * Merge topic page
 *
 * @package bbPress
 * @subpackage Theme
 */

get_header();

st_before_content($columns='');

do_action( 'bbp_template_notices' );
?>

	<?php while ( have_posts() ) the_post(); ?>

		<div id="bbp-edit-page" class="bbp-edit-page">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content">

				<?php bbp_get_template_part( 'bbpress/form', 'topic-merge' ); ?>

			</div>
		</div><!-- #bbp-edit-page -->

<?php
st_after_content();

// get_sidebar('bbpress');
get_footer();
?>