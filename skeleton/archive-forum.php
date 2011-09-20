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
<a id="toggle">
	<?php if ( !is_user_logged_in() ) { echo 'Register/Login'; } else {echo 'Your Profile';}?>
</a>

<div id="login-form" style="display: none;">
	<?php if ( is_user_logged_in() ) { ?>
    <div class="fullwidth">
			<a id="author-avatar" href="<?php bbp_user_profile_url( bbp_get_current_user_id() ); ?>">
				<?php echo get_avatar( bbp_get_current_user_id(), '64' ); ?>
			</a>
			<h4>Welcome back, <?php bbp_user_profile_link( bbp_get_current_user_id() );?>!</h4>
				<a href="<?php echo bbp_get_user_profile_url( bbp_get_current_user_id() );?>">Your Profile</a>
				 | 
				<a href="<?php echo wp_logout_url(); ?>" title="Log Out">Logout</a>
			<div class="clear"></div>
		</div>
		
		<?php } else { ?>
			
    <div class="one_third">
			<?php bbp_get_template_part( 'bbpress/form', 'user-login' );?>
    </div>
		
		<div class="one_third">
	  	<?php bbp_get_template_part( 'bbpress/form', 'user-lost-pass' );?>
		</div>
		
		<div class="one_third last">
    	<?php bbp_get_template_part( 'bbpress/form', 'user-register' );?>
   	</div>
		<div class="clear"></div>
<?php	} ?>
</div>

<div id="forum-front" class="bbp-forum-front">
	<h2 class="entry-title"><?php bbp_forum_archive_title(); ?></h2>
	<div class="entry-content">

		<?php bbp_get_template_part( 'bbpress/content', 'archive-forum' ); ?>

	</div>
</div><!-- #forum-front -->

<?php
st_after_content();
// get_sidebar('bbpress');
get_footer();
?>