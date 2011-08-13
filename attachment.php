<?php
/**
 * The template for displaying attachments.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */

get_header();
do_action('st_before_content');
/* Run the loop to output the attachment.
 * If you want to overload this in a child theme then include a file
 * called loop-attachment.php and that will be used instead.
 */
get_template_part( 'loop', 'attachment' );
do_action('st_after_content');
get_sidebar();
get_footer();
?>