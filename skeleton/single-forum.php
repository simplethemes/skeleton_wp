<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */
get_header();

st_before_content($columns='');

do_action( 'bbp_template_notices' );
?>


	<?php while ( have_posts() ) : the_post(); ?>

		<?php if ( bbp_user_can_view_forum() ) : ?>

			<div id="forum-<?php bbp_forum_id(); ?>" class="bbp-forum-content">
				<h1 class="entry-title"><?php bbp_forum_title(); ?></h1>
				<div class="entry-content">

					<?php bbp_get_template_part( 'bbpress/content', 'single-forum' ); ?>

				</div>
			</div><!-- #forum-<?php bbp_forum_id(); ?> -->

		<?php else : // Forum exists, user no access ?>

			<?php bbp_get_template_part( 'bbpress/feedback', 'no-access' ); ?>

		<?php endif; ?>

	<?php endwhile; ?>


<?php
st_after_content();

// get_sidebar('bbpress');
get_footer();
?>