<?php
//php get_header('shop');
get_header();
st_before_content($columns='');?>

	<?php do_action('jigoshop_before_main_content'); // <div id="container"><div id="content" role="main"> ?>

		<?php if (is_search()) : ?>		
			<h1 class="page-title"><?php _e('Search Results:', 'jigoshop'); ?> &ldquo;<?php the_search_query(); ?>&rdquo; <?php if (get_query_var('paged')) echo ' &mdash; Page '.get_query_var('paged'); ?></h1>
		<?php endif; ?>

		<?php get_template_part( 'loop', 'shop' ); ?>

		<?php do_action('jigoshop_pagination'); ?>

	<?php do_action('jigoshop_after_main_content'); // </div></div> ?>


<?php
st_after_content();
get_sidebar('shop');
get_footer();
?>