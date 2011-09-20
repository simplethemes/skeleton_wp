<?php
//php get_header('shop');
get_header();
st_before_content($columns='');?>

	<?php do_action('jigoshop_before_main_content'); // <div id="container"><div id="content" role="main"> ?>

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); global $_product; $_product = &new jigoshop_product( $post->ID ); ?>

			<?php do_action('jigoshop_before_single_product', $post, $_product); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php do_action('jigoshop_before_single_product_summary', $post, $_product); ?>

				<div class="summary one_third last">

					<h2 class="product_title page-title"><?php the_title(); ?></h2>

					<?php do_action( 'jigoshop_template_single_summary', $post, $_product ); ?>

				</div>
				<div class="clear"></div>
				<?php do_action('jigoshop_after_single_product_summary', $post, $_product); ?>

			</div>

			<?php do_action('jigoshop_after_single_product', $post, $_product); ?>

		<?php endwhile; ?>

	<?php do_action('jigoshop_after_main_content'); // </div></div> ?>

<?php
st_after_content();
get_sidebar('shop');
get_footer();
?>
