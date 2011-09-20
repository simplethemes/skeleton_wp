<?php
//php get_header('shop');
get_header();
st_before_content($columns='');?>
		
		<?php do_action('jigoshop_before_main_content'); // <div id="container"><div id="content" role="main"> ?>

		<?php global $wp_query; $term = get_term_by( 'slug', get_query_var($wp_query->query_vars['taxonomy']), $wp_query->query_vars['taxonomy']); ?>

		<h1 class="category_title"><?php echo wptexturize($term->name); ?></h1>

		<?php echo wpautop(wptexturize($term->description)); ?>

		<?php get_template_part( 'loop', 'shop' ); ?>

		<?php do_action('jigoshop_pagination'); ?>

	<?php do_action('jigoshop_after_main_content'); // </div></div> ?>

<?php
st_after_content();
get_sidebar('shop');
get_footer();
?>