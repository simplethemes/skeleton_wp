<?php
/**
 * The template for displaying attachments.
 *
 * @package Skeleton WordPress Theme Framework
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
 */

get_header();
st_before_content('sixteen');

/* Run the loop to output the attachment.
 * If you want to overload this in a child theme then include a file
 * called loop-attachment.php and that will be used instead.
 */
get_template_part( 'loop', 'attachment' );
st_after_content();
// get_sidebar();
get_footer();
?>