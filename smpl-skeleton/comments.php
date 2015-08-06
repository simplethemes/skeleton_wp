<?php
/**
* @package Skeleton WordPress Theme
* @subpackage skeleton
* @author Simple Themes - www.simplethemes.com
*/

if ( post_password_required() ) {
	return;
}

?>
<div id="comments">

<!-- You can start editing here. -->
<?php if ( have_comments() ) : ?>

	<h2><?php printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'smpl' ), number_format_i18n( get_comments_number() ), '<span class="normal">&quot;'.get_the_title().'&quot;</span>' );?></h2>

	<ul class="commentlist">
	<?php wp_list_comments("callback=skeleton_comments"); ?>
	</ul>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>

 <?php else : // this is displayed if there are no comments so far ?>

<?php endif; ?>


<?php if ( comments_open() ) : ?>


<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php
$aria_req = ( $req ? " aria-required='true'" : '' );
$comment_args = array(
		'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' => '<p class="comment-form-author">' .
					( $req ? '<span class="required">*</span>' : '' ) .
					'<label for="author">' . __( 'Your Name','smpl' ) . '</label> <br />' .
					'<input id="author" name="author" type="text" value="' .
					esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' .
					'</p>',
    			'email'  => '<p class="comment-form-email">' .
    				( $req ? '<span class="required">*</span>' : '' ) .
    				'<label for="email">' . __( 'Your Email','smpl' ) . '</label> <br />' .
    				'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' .
    				'</p>',
    			'url' =>
    				'<p class="comment-form-url"><label for="url">' .
    				__( 'Website', 'domainreference' ) . '</label> <br />' .
    				'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>' ) ),
				'comment_field' => '<p class="comment-form-comment">' .
					'<label for="comment"><span class="required">*</span>' . __( 'Comment:','smpl' ) . '</label><br />' .
					'<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>' .
					'</p>',
				'comment_notes_after' => ''
			);
if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
	<p> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('You must be logged in to post a comment.','smpl');?></a> </p>
<?php else : comment_form($comment_args); ?>
<?php endif; // If registration required and not logged in ?>
<?php endif;?>
</div>
