<?php
/**
 * The loop that displays a page.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-page.php.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								
				<?php if (!is_page_template('onecolumn-page.php')) { ?>
					<?php if (is_front_page() && !get_post_meta($post->ID, 'hidetitle', true)) { ?>
						
						<h2 class="entry-title"><?php the_title(); ?></h2>
						
					<?php } elseif (!get_post_meta($post->ID, 'hidetitle', true)) { ?>
						
						<h1 class="entry-title"><?php the_title(); ?></h1>
						
					<?php } else {
						echo '<br />';
					} ?>
				<?php } ?>
				
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'skeleton' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'skeleton' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>