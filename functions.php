<?php
/**
 * Skeleton theme functions and definitions
 *
 * This theme is largely based on skeleton with some significant modifications
 * mainly to template files, but adds additional helper functions to the layout in general.
 * Other functions are attached to action and filter hooks in WordPress to change core functionality.
 * 
 * Layout Functions:
 * 
 * st_header  // Opening header tag and logo/header text
 * st_header_extras* // Additional content may be added to the header
 * st_navbar // Opening navigation element and WP3 menus
 * st_before_content // Opening content wrapper 
 * st_after_content // Closing content wrapper 
 * st_before_sidebar // Opening sidebar wrapper 
 * st_after_sidebar // Closing sidebar wrapper 
 * st_before_footer // Opening footer wrapper 
 * st_footer // The footer (includes sidebar-footer.php)
 * st_after_footer // The closing footer wrapper 
 * 
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, skeleton_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'skeleton_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */


/*-----------------------------------------------------------------------------------*/
/* Initialize the Options Framework
/* http://wptheming.com/options-framework-theme/
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'optionsframework_init' ) ) {

/* Set the file path based on whether the Options Framework Theme is a parent theme or child theme */

if ( STYLESHEETPATH == TEMPLATEPATH ) {
	define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/admin/');
} else {
	define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/admin/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('stylesheet_directory') . '/admin/');
}

require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');

}

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	
	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}
	
	jQuery('#example_showhidden2').click(function() {
  		jQuery('#section-example_text_hidden2').fadeToggle(400);
	});
	
	if (jQuery('#example_showhidden2:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden2').show();
	}
	
});
</script>

<?php
}


// Register Core Stylesheets
// These are necessary for the theme to function as intended
// Supports the 'Better WordPress Minify' plugin to properly minimize styleshsets into one.
// http://wordpress.org/extend/plugins/bwp-minify/

add_action('get_header', 'st_registerstyles');
function st_registerstyles() {
	$theme  = get_theme( get_current_theme());
	$version = $theme['Version'];
    wp_enqueue_style('base', get_bloginfo('stylesheet_directory').'/base.css', false, $version, 'screen, projection');
    wp_enqueue_style('skeleton', get_bloginfo('stylesheet_directory').'/skeleton.css', 'base', $version, 'screen, projection');
    wp_enqueue_style('layout', get_bloginfo('stylesheet_directory').'/layout.css', 'skeleton', $version, 'screen, projection');
    wp_enqueue_style('formalize', get_bloginfo('stylesheet_directory').'/formalize.css', 'layout', $version, 'screen, projection');
    wp_enqueue_style('superfish', get_bloginfo('stylesheet_directory').'/superfish.css', 'layout', $version, 'screen, projection');
    wp_enqueue_style('theme', get_bloginfo('stylesheet_directory').'/style.css', 'superfish', $version, 'screen, projection');
}

// Build Query vars for dynamic theme option CSS from Options Framework

function production_stylesheet($public_query_vars) {
    $public_query_vars[] = 'get_styles';
    return $public_query_vars;
}
add_filter('query_vars', 'production_stylesheet');

add_action('template_redirect', 'theme_css');
function theme_css(){
    $css = get_query_var('get_styles');
    if ($css == 'css'){
        include_once (TEMPLATEPATH . '/style.php');
        exit;  //This stops WP from loading any further
    }
}

add_action('init', 'st_header_scripts');
function st_header_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('custom',get_bloginfo('template_url') ."/javascripts/app.js",array('jquery'),'1.2.3',true);
	wp_enqueue_script('superfish',get_bloginfo('template_url') ."/javascripts/superfish.js",array('jquery'),'1.2.3',true);
	wp_enqueue_script('formalize',get_bloginfo('template_url') ."/javascripts/jquery.formalize.min.js",array('jquery'),'1.2.3',true);
}
 

/** Tell WordPress to run skeleton_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'skeleton_setup' );

if ( ! function_exists( 'skeleton_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override skeleton_setup() in a child theme, add your own skeleton_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Skeleton 1.0
 */
function skeleton_setup() {
	
	if ( class_exists( 'bbPress' ) ) {
	add_theme_support( 'bbpress' );
	}
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// Register the available menus
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'skeleton' ),
	));

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'skeleton', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );


		// No support for text inside the header image.
		if ( ! defined( 'NO_HEADER_TEXT' ) )
			define( 'NO_HEADER_TEXT', true );
			
		if ( ! defined( 'HEADER_IMAGE_WIDTH') )
			define( 'HEADER_IMAGE_WIDTH', apply_filters( 'skeleton_header_image_width',960));
			
			
		if ( ! defined( 'HEADER_IMAGE_HEIGHT') )
			define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'skeleton_header_image_height',185 ));

		// Add a way for the custom header to be styled in the admin panel that controls
		// custom headers. See skeleton_admin_header_style(), below.
		add_custom_image_header( '', 'skeleton_admin_header_style' );

		// ... and thus ends the changeable header business.

		// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
		register_default_headers( array(
			'berries' => array(
				'url' => '%s/images/headers/berries.jpg',
				'thumbnail_url' => '%s/images/headers/berries-thumbnail.jpg',
				/* translators: header image description */
				'description' => __( 'Berries', 'skeleton' )
			),
			'cherryblossom' => array(
				'url' => '%s/images/headers/cherryblossoms.jpg',
				'thumbnail_url' => '%s/images/headers/cherryblossoms-thumbnail.jpg',
				/* translators: header image description */
				'description' => __( 'Cherry Blossoms', 'skeleton' )
			),
			'concave' => array(
				'url' => '%s/images/headers/concave.jpg',
				'thumbnail_url' => '%s/images/headers/concave-thumbnail.jpg',
				/* translators: header image description */
				'description' => __( 'Concave', 'skeleton' )
			),
			'fern' => array(
				'url' => '%s/images/headers/fern.jpg',
				'thumbnail_url' => '%s/images/headers/fern-thumbnail.jpg',
				/* translators: header image description */
				'description' => __( 'Fern', 'skeleton' )
			),
			'forestfloor' => array(
				'url' => '%s/images/headers/forestfloor.jpg',
				'thumbnail_url' => '%s/images/headers/forestfloor-thumbnail.jpg',
				/* translators: header image description */
				'description' => __( 'Forest Floor', 'skeleton' )
			),
			'inkwell' => array(
				'url' => '%s/images/headers/inkwell.jpg',
				'thumbnail_url' => '%s/images/headers/inkwell-thumbnail.jpg',
				/* translators: header image description */
				'description' => __( 'Inkwell', 'skeleton' )
			),
			'path' => array(
				'url' => '%s/images/headers/path.jpg',
				'thumbnail_url' => '%s/images/headers/path-thumbnail.jpg',
				/* translators: header image description */
				'description' => __( 'Path', 'skeleton' )
			),
			'sunset' => array(
				'url' => '%s/images/headers/sunset.jpg',
				'thumbnail_url' => '%s/images/headers/sunset-thumbnail.jpg',
				/* translators: header image description */
				'description' => __( 'Sunset', 'skeleton' )
			)
		) );
	}
	endif;

	if ( ! function_exists( 'skeleton_admin_header_style' ) ) :
	/**
	 * Styles the header image displayed on the Appearance > Header admin panel.
	 *
	 * Referenced via add_custom_image_header() in skeleton_setup().
	 *
	 * @since Skeleton 1.0
	 */
	function skeleton_admin_header_style() {
	?>
	<style type="text/css">
	/* Shows the same border as on front end */
	#headimg {
		border-bottom: 100px solid #000;
		border-top: 4px solid #000;
	}
	/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
		#headimg #name { }
		#headimg #desc { }
	*/
	</style>
	<?php
	}
	endif;

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Skeleton 1.0
 * @return int
 */
function skeleton_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'skeleton_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Skeleton 1.0
 * @return string "Continue Reading" link
 */
function skeleton_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'skeleton' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and skeleton_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Skeleton 1.0
 * @return string An ellipsis
 */
function skeleton_auto_excerpt_more( $more ) {
	return ' &hellip;' . skeleton_continue_reading_link();
}
add_filter( 'excerpt_more', 'skeleton_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Skeleton 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function skeleton_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= skeleton_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'skeleton_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Skeleton's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 * @since Skeleton 1.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 *
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 *
 * @since Skeleton 1.0
 * @deprecated Deprecated in Skeleton 1.2 for WordPress 3.1
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function skeleton_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'skeleton_remove_gallery_css' );


/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override st_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @uses register_sidebar
 */
//

function remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) {
	$end = strpos($link, '"',$offset);
	}
	if ($end) {
	$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
	}
	add_filter('the_content_more_link', 'remove_more_jump_link');



function st_widgets_init() {
		// Area 1, located at the top of the sidebar.
		register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'skeleton' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'skeleton' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );


	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'skeleton' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'skeleton' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'skeleton' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'skeleton' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'skeleton' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'skeleton' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'skeleton' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'skeleton' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'skeleton' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'skeleton' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Register bbPress sidebar if plugin is installed
	if ( class_exists( 'bbPress' ) ) {
	register_sidebar( array(
		'name' => __( 'Forum Sidebar', 'skeleton' ),
		'id' => 'bbpress-widget-area',
		'description' => __( 'Sidebar displayed in forum', 'skeleton' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	}
}
/** Register sidebars by running skeleton_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'st_widgets_init' );

/** Comment Styles */

if ( ! function_exists( 'st_comments' ) ) :
function st_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>" class="single-comment clearfix">
				<div class="comment-author vcard"> <?php echo get_avatar($comment,$size='64',$default='<path_to_url>' ); ?></div>
				<div class="comment-meta commentmetadata">
						<?php if ($comment->comment_approved == '0') : ?>
						<em><?php _e('Comment is awaiting moderation','smpl');?></em> <br />
						<?php endif; ?>
						<h6><?php echo __('By','smpl').' '.get_comment_author_link(). ' '. get_comment_date(). '  -  ' . get_comment_time(); ?></h6>
						<?php comment_text() ?>
						<?php edit_comment_link(__('Edit comment','smpl'),'  ',''); ?>
						<?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply','smpl'),'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				</div>
		</div>
<!-- </li> -->
<?php  }
endif;

if ( ! function_exists( 'skeleton_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Skeleton 1.0
 */
function skeleton_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'skeleton' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'skeleton' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'skeleton_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Skeleton 1.0
 */
function skeleton_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'skeleton' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'skeleton' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'skeleton' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

// You can change the global layout based on the actions below
// If you want to apply conditional layouts based on page/post/category,
// see the commented code at the bottom of this section.


// Header
function st_header() {
    do_action('st_header');
	$heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';
  echo '<div id="header" class="row sixteen columns">'. "\n";
	echo '<'.$heading_tag.' id="site-title"><a href="'.get_home_url( '/' ).'" title="'.esc_attr( get_bloginfo('name','display')).'">'.get_bloginfo('name').'</a></'.$heading_tag.'>'. "\n";
	echo '<span class="site-desc">'.get_bloginfo('description').'</span>'. "\n";
	echo '</div><!--/#header-->';
}


// Navigation (menu)
function st_navbar() {
	echo '<div id="navigation" class="row sixteen columns">';
	wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary'));
	echo '</div><!--/#navigation-->';
}



// Before Content - do_action('st_before_content')

if (!function_exists('st_before_content')) {
	// create our hook
	add_action( 'st_before_content', 'before_content');  
	// call up the action
	function before_content($columns) {
	// You can specify the number of columns in conditional statements
	// See http://codex.wordpress.org/Conditional_Tags for a full list
	//
	// If necessary, you can also pass $columns as a variable in your template files:
	// do_action('st_before_sidebar','six');
	//
	if (empty($columns)) {
	// Set the default
	$columns = 'eleven';
	} else {
	// Check the function for a returned variable
	$columns = $columns;
	}
	// Example of further conditionals:
	// (be sure to add the excess of 16 to st_before_sidebar as well)
	if (is_page_template('onecolumn-page.php')) {
	$columns = 'sixteen';
	}
	// check to see if bbpress is installed
	if ( class_exists( 'bbPress' ) ) {
	// force wide on bbPress pages
	if (is_bbpress()) {
	$columns = 'sixteen';
	}
	// unless it's the member profile
	if (bbp_is_user_home()) {
	$columns = 'eleven';
	}
	}
	// Apply the markup
	echo '<a name="top" id="top"></a>';
	echo '<div id="content" class="'.$columns.' columns">';
	}	
}


// After Content

if (!function_exists('st_after_content')) {
	add_action( 'st_after_content', 'after_content');  
	function after_content() {
	// Additional Content could be added here
  echo '</div><!-- /.columns (#content) -->';
	}
}



// Before Sidebar - do_action('st_before_sidebar')

if (!function_exists('st_before_sidebar')) {
	// create our hook
	add_action( 'st_before_sidebar', 'before_sidebar');  
	// call up the action
	function before_sidebar($columns) {
	// You can specify the number of columns in conditional statements
	// See http://codex.wordpress.org/Conditional_Tags for a full list
	//
	// If necessary, you can also pass $columns as a variable in your template files:
	// do_action('st_before_sidebar','six');
	//
	if (empty($columns)) {
	// Set the default
	$columns = 'five';
	} else {
	// Check the function for a returned variable
	$columns = $columns;
	}
	// Example of further conditionals:
	// (be sure to add the excess of 16 to st_before_content as well)
	// if (is_page() || is_single()) {
	// $columns = 'five';
	// } else {
	// $columns = 'four';
	// }
	// Apply the markup
	echo '<div id="sidebar" class="'.$columns.' columns" role="complementary">';
	}	
}



// After Sidebar
if (!function_exists('st_after_sidebar')) {
	add_action( 'st_after_sidebar', 'after_sidebar');  
	function after_sidebar() {
	// Additional Content could be added here
	   echo '</div><!-- #sidebar -->';
	}
}

// Before Footer
if (!function_exists('st_before_footer')) {
	do_action('st_before_footer');
	function st_before_footer() {
		$footerwidgets = is_active_sidebar('first-footer-widget-area') + is_active_sidebar('second-footer-widget-area') + is_active_sidebar('third-footer-widget-area') + is_active_sidebar('fourth-footer-widget-area');
		$class = ($footerwidgets == '0' ? 'noborder' : 'normal');
		echo '<div id="footer" class="'.$class.' sixteen columns">';
	}
}


// The Footer
add_action('wp_footer', 'st_footer');
if (!function_exists('st_footer')) {
	do_action('st_footer');
	function st_footer() {
		//loads sidebar-footer.php
		get_sidebar( 'footer' );
		echo '<div id="credits">';
		echo of_get_option('footer_text');
		// if (of_get_option('remove_attrib')) {
		echo '<br /><a class="themeauthor" href="http://www.simplethemes.com" title="WordPress Themes">Theme by Simple Themes</a></div>';
		// }
	}
}


// After Footer
if (!function_exists('st_after_footer')) {
	do_action('st_after_footer');
	function st_after_footer() {
	   echo '</div><!--/#footer-->';
	}
}

// Conditional Examples

// function st_before_content()  
// {
// 	if (is_page()) {
//    echo '<div id="content" class="twelve columns">';
// 	}
// 	if (is_single()) {
//    echo '<div id="content" class="ten columns alpha offset-by-one">';
// 	}
// }
// add_action('loop_start', 'st_before_content');

// Begin Shortcodes


// Columns

// 1-3 col 
function st_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'st_one_third');

function st_one_third_last( $atts, $content = null ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'st_one_third_last');

function st_two_thirds( $atts, $content = null ) {
   return '<div class="two_thirds">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_thirds', 'st_two_thirds');

function st_two_thirds_last( $atts, $content = null ) {
   return '<div class="two_thirds last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_thirds_last', 'st_two_thirds_last');

// 1-4 col 

function st_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'st_one_half');


function st_one_half_last( $atts, $content = null ) {
   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'st_one_half_last');


function st_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'st_one_fourth');


function st_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'st_one_fourth_last');

function st_three_fourths( $atts, $content = null ) {
   return '<div class="three_fourths">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourths', 'st_three_fourths');


function st_three_fourths_last( $atts, $content = null ) {
   return '<div class="three_fourths last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fourths_last', 'st_three_fourths_last');


function st_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'st_one_fifth');

function st_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'st_two_fifth');

function st_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'st_three_fifth');

function st_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'st_four_fifth');

//

function st_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 'st_one_fifth_last');

function st_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_fifth_last', 'st_two_fifth_last');

function st_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fifth_last', 'st_three_fifth_last');

function st_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('four_fifth_last', 'st_four_fifth_last');

// 1-6 col 

// one_sixth
function st_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'st_one_sixth');

function st_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 'st_one_sixth_last');

// five_sixth
function st_five_sixth( $atts, $content = null ) {
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'st_five_sixth');

function st_five_sixth_last( $atts, $content = null ) {
   return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('five_sixth_last', 'st_five_sixth_last');



// Buttons
function st_button( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'link' => '',
		'size' => 'medium',
		'color' => '',
		'target' => '_self',
		'caption' => '',
		'align' => 'right'
    ), $atts));	
	$button;
	$button .= '<div class="button '.$size.' '. $align.'">';
	$button .= '<a target="'.$target.'" class="button '.$color.'" href="'.$link.'">';
	$button .= $content;
	if ($caption != '') {
	$button .= '<br /><span class="btn_caption">'.$caption.'</span>';
	};
	$button .= '</a></div>';
	return $button;
}
add_shortcode('button', 'st_button');


// Tabs
add_shortcode( 'tabgroup', 'st_tabgroup' );

function st_tabgroup( $atts, $content ){
	
$GLOBALS['tab_count'] = 0;
do_shortcode( $content );

if( is_array( $GLOBALS['tabs'] ) ){
	
foreach( $GLOBALS['tabs'] as $tab ){
$tabs[] = '<li><a href="#'.$tab['id'].'">'.$tab['title'].'</a></li>';
$panes[] = '<li id="'.$tab['id'].'Tab">'.$tab['content'].'</li>';
}
$return = "\n".'<!-- the tabs --><ul class="tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<!-- tab "panes" --><ul class="tabs-content">'.implode( "\n", $panes ).'</ul>'."\n";
}
return $return;

}

add_shortcode( 'tab', 'st_tab' );
function st_tab( $atts, $content ){
extract(shortcode_atts(array(
	'title' => '%d',
	'id' => '%d'
), $atts));

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array(
	'title' => sprintf( $title, $GLOBALS['tab_count'] ),
	'content' =>  $content,
	'id' =>  $id );

$GLOBALS['tab_count']++;
}


// Toggle
function st_toggle( $atts, $content = null ) {
	extract(shortcode_atts(array(
		 'title' => '',
		 'style' => 'list'
    ), $atts));
	output;
	$output .= '<div class="'.$style.'"><p class="trigger"><a href="#">' .$title. '</a></p>';
	$output .= '<div class="toggle_container"><div class="block">';
	$output .= do_shortcode($content);
	$output .= '</div></div></div>';

	return $output;
	}
add_shortcode('toggle', 'st_toggle');


// Latest Posts

function st_latest($atts, $content = null) {
	extract(shortcode_atts(array(
	"num" => '5',
	"thumbs" => 'false',
	"excerpt" => 'false',
	"width" => '100',
	"height" => '100',
	"cat" => ''
	), $atts));
	global $post;
	
	$myposts = new WP_Query('cat='.$cat.'&posts_per_page='.$num.'&orderby=post_date&order=DESC');

	$result='<ul class="captionlist">';

	while($myposts->have_posts()) : $myposts->the_post();
		$result.='<li class="clearfix">';
			if (has_post_thumbnail() && $thumbs == 'true') {
				$result.= '<img alt="'.get_the_title().'" class="alignleft" src="'.get_bloginfo('stylesheet_directory').'/thumb.php?src='.get_image_path().'&amp;h='.$height.'&amp;w='.$width.'"/>';
			}
		$result.='<a href="'.get_permalink().'">'.the_title("","",false).'</a>';
		if ($excerpt == 'true') {
			$result.= '<ul><li>'.get_the_excerpt().'</li></ul>';
		}
		$result.='</li>';
  endwhile;
	wp_reset_postdata();
	$result.='</ul> ';
	return $result;
}
add_shortcode("latest", "st_latest");
// Example Use: [latest excerpt="true" thumbs="true" width="50" height="50" num="5" cat="8,10,11"]


// Related Posts - [related_posts]
add_shortcode('related_posts', 'st_related_posts');
function st_related_posts( $atts ) {
	extract(shortcode_atts(array(
	    'limit' => '5',
	), $atts));

	global $wpdb, $post, $table_prefix;

	if ($post->ID) {
		$retval = '<div class="st_relatedposts">';
		$retval .= '<h4>Related Posts</h4>';
		$retval .= '<ul>';
 		// Get tags
		$tags = wp_get_post_tags($post->ID);
		$tagsarray = array();
		foreach ($tags as $tag) {
			$tagsarray[] = $tag->term_id;
		}
		$tagslist = implode(',', $tagsarray);

		// Do the query
		$q = "SELECT p.*, count(tr.object_id) as count
			FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p WHERE tt.taxonomy ='post_tag' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id  = p.ID AND tt.term_id IN ($tagslist) AND p.ID != $post->ID
				AND p.post_status = 'publish'
				AND p.post_date_gmt < NOW()
 			GROUP BY tr.object_id
			ORDER BY count DESC, p.post_date_gmt DESC
			LIMIT $limit;";

		$related = $wpdb->get_results($q);
 		if ( $related ) {
			foreach($related as $r) {
				$retval .= '<li><a title="'.wptexturize($r->post_title).'" href="'.get_permalink($r->ID).'">'.wptexturize($r->post_title).'</a></li>';
			}
		} else {
			$retval .= '
	<li>No related posts found</li>';
		}
		$retval .= '</ul>';
		$retval .= '</div>';
		return $retval;
	}
	return;
}

// Break
function st_break( $atts, $content = null ) {
	return '<div class="clear"></div>';
}
add_shortcode('clear', 'st_break');


// Line Break
function st_linebreak( $atts, $content = null ) {
	return '<hr /><div class="clear"></div>';
}
add_shortcode('clearline', 'st_linebreak');


// Editor Typography Improvements
function st_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}


remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');
add_filter('the_content', 'st_formatter', 99);
add_filter('widget_text', 'st_formatter', 99);
add_filter('the_excerpt', 'st_formatter', 99);
add_filter('get_the_excerpt', 'st_formatter', 99);


// Enable Shortcodes in excerpts and widgets
add_filter('widget_text', 'do_shortcode');
add_filter( 'the_excerpt', 'do_shortcode');
add_filter('get_the_excerpt', 'do_shortcode');


// bbPress


if ( ! function_exists( 'bbp_skeleton_setup' ) ):

/**
 * Sets up theme support for bbPress
 *
 * If you're looking to add bbPress support into your own custom theme, you'll
 * want to make sure to use: add_theme_support( 'bbpress' );
 *
 * @since bbPress (r2652)
 */
function bbp_skeleton_setup() {
	// This theme comes bundled with bbPress template files
	add_theme_support( 'bbpress' );
}
/** Tell WordPress to run skeleton_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'bbp_skeleton_setup' );

endif;


if ( !function_exists( 'bbp_skeleton_enqueue_styles' ) ) :
/**
 * Load the theme CSS
 *
 * @since bbPress (r2652)
 *
 * @uses wp_enqueue_style() To enqueue the styles
 */
function bbp_skeleton_enqueue_styles () {

	$version = '20110807b';
		// bbPress specific styles
		wp_enqueue_style( 'bbp-skeleton-bbpress', get_stylesheet_directory_uri() . '/bbpress.css', 'skeleton', $version, 'screen' );
}
add_action( 'bbp_enqueue_scripts', 'bbp_skeleton_enqueue_styles' );

endif;



if ( !function_exists( 'bbp_skeleton_enqueue_scripts' ) ) :
/**
 * Enqueue the required Javascript files
 *
 * @since bbPress (r2652)
 *
 * @uses bbp_is_single_topic() To check if it's the topic page
 * @uses get_stylesheet_directory_uri() To get the stylesheet directory uri
 * @uses bbp_is_single_user_edit() To check if it's the profile edit page
 * @uses wp_enqueue_script() To enqueue the scripts
 */
function bbp_skeleton_enqueue_scripts () {

	$version = '20110807b';

	if ( bbp_is_single_topic() )
		wp_enqueue_script( 'bbp_topic', get_stylesheet_directory_uri() . '/js/topic.js', array( 'wp-lists' ), $version );

	if ( bbp_is_single_user_edit() )
		wp_enqueue_script( 'user-profile' );
}
add_action( 'bbp_enqueue_scripts', 'bbp_skeleton_enqueue_scripts' );
endif;

if ( !function_exists( 'bbp_skeleton_scripts' ) ) :
/**
 * Put some scripts in the header, like AJAX url for wp-lists
 *
 * @since bbPress (r2652)
 *
 * @uses bbp_is_single_topic() To check if it's the topic page
 * @uses admin_url() To get the admin url
 * @uses bbp_is_single_user_edit() To check if it's the profile edit page
 */
function bbp_skeleton_scripts () {
	if ( bbp_is_single_topic() ) : ?>

	<script type='text/javascript'>
		/* <![CDATA[ */
		var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
		/* ]]> */
	</script>

	<?php elseif ( bbp_is_single_user_edit() ) : ?>

	<script type="text/javascript" charset="utf-8">
		if ( window.location.hash == '#password' ) {
			document.getElementById('pass1').focus();
		}
	</script>

	<?php
	endif;
	}
add_filter( 'bbp_head', 'bbp_skeleton_scripts', -1 );
endif;

if ( !function_exists( 'bbp_skeleton_topic_script_localization' ) ) :

/**
 * Load localizations for topic script.
 *
 * These localizations require information that may not be loaded even by init.
 *
 * @since bbPress (r2652)
 *
 * @uses bbp_is_single_topic() To check if it's the topic page
 * @uses bbp_get_current_user_id() To get the current user id
 * @uses bbp_get_topic_id() To get the topic id
 * @uses bbp_get_favorites_permalink() To get the favorites permalink
 * @uses bbp_is_user_favorite() To check if the topic is in user's favorites
 * @uses bbp_is_subscriptions_active() To check if the subscriptions are active
 * @uses bbp_is_user_subscribed() To check if the user is subscribed to topic
 * @uses bbp_get_topic_permalink() To get the topic permalink
 * @uses wp_localize_script() To localize the script
*/

function bbp_skeleton_topic_script_localization () {
	if ( !bbp_is_single_topic() )
		return;

	$user_id = bbp_get_current_user_id();

	$localizations = array(
		'currentUserId' => $user_id,
		'topicId'       => bbp_get_topic_id(),
	);

	// Favorites
	if ( bbp_is_favorites_active() ) {
		$localizations['favoritesActive'] = 1;
		$localizations['favoritesLink']   = bbp_get_favorites_permalink( $user_id );
		$localizations['isFav']           = (int) bbp_is_user_favorite( $user_id );
		$localizations['favLinkYes']      = __( 'favorites',                                         'bbpress' );
		$localizations['favLinkNo']       = __( '?',                                                 'bbpress' );
		$localizations['favYes']          = __( 'This topic is one of your %favLinkYes% [%favDel%]', 'bbpress' );
		$localizations['favNo']           = __( '%favAdd% (%favLinkNo%)',                            'bbpress' );
		$localizations['favDel']          = __( '&times;',                                           'bbpress' );
		$localizations['favAdd']          = __( 'Add this topic to your favorites',                  'bbpress' );
	} else {
		$localizations['favoritesActive'] = 0;
	}

	// Subscriptions
	if ( bbp_is_subscriptions_active() ) {
		$localizations['subsActive']   = 1;
		$localizations['isSubscribed'] = (int) bbp_is_user_subscribed( $user_id );
		$localizations['subsSub']      = __( 'Subscribe',   'bbpress' );
		$localizations['subsUns']      = __( 'Unsubscribe', 'bbpress' );
		$localizations['subsLink']     = bbp_get_topic_permalink();
	} else {
		$localizations['subsActive'] = 0;
	}

	wp_localize_script( 'bbp_topic', 'bbpTopicJS', $localizations );
}
add_filter( 'bbp_enqueue_scripts', 'bbp_skeleton_topic_script_localization' );
endif;

if ( !function_exists( 'bbp_skeleton_dim_favorite' ) ) :
/**
 * Add or remove a topic from a user's favorites
 *
 * @since bbPress (r2652)
 *
 * @uses bbp_get_current_user_id() To get the current user id
 * @uses current_user_can() To check if the current user can edit the user
 * @uses bbp_get_topic() To get the topic
 * @uses check_ajax_referer() To verify the nonce & check the referer
 * @uses bbp_is_user_favorite() To check if the topic is user's favorite
 * @uses bbp_remove_user_favorite() To remove the topic from user's favorites
 * @uses bbp_add_user_favorite() To add the topic from user's favorites
 */
function bbp_skeleton_dim_favorite () {
	$user_id = bbp_get_current_user_id();
	$id      = intval( $_POST['id'] );

	if ( !current_user_can( 'edit_user', $user_id ) )
		die( '-1' );

	if ( !$topic = bbp_get_topic( $id ) )
		die( '0' );

	check_ajax_referer( "toggle-favorite_$topic->ID" );

	if ( bbp_is_user_favorite( $user_id, $topic->ID ) ) {
		if ( bbp_remove_user_favorite( $user_id, $topic->ID ) )
			die( '1' );
	} else {
		if ( bbp_add_user_favorite( $user_id, $topic->ID ) )
			die( '1' );
	}

	die( '0' );
}
add_action( 'wp_ajax_dim-favorite', 'bbp_skeleton_dim_favorite' );
endif;

if ( !function_exists( 'bbp_skeleton_dim_subscription' ) ) :
/**
 * Subscribe/Unsubscribe a user from a topic
 *
 * @since bbPress (r2668)
 *
 * @uses bbp_is_subscriptions_active() To check if the subscriptions are active
 * @uses bbp_get_current_user_id() To get the current user id
 * @uses current_user_can() To check if the current user can edit the user
 * @uses bbp_get_topic() To get the topic
 * @uses check_ajax_referer() To verify the nonce & check the referer
 * @uses bbp_is_user_subscribed() To check if the topic is in user's
 *                                 subscriptions
 * @uses bbp_remove_user_subscriptions() To remove the topic from user's
 *                                        subscriptions
 * @uses bbp_add_user_subscriptions() To add the topic from user's subscriptions
 */
function bbp_skeleton_dim_subscription () {
	if ( !bbp_is_subscriptions_active() )
		return;

	$user_id = bbp_get_current_user_id();
	$id      = intval( $_POST['id'] );

	if ( !current_user_can( 'edit_user', $user_id ) )
		die( '-1' );

	if ( !$topic = bbp_get_topic( $id ) )
		die( '0' );

	check_ajax_referer( "toggle-subscription_$topic->ID" );

	if ( bbp_is_user_subscribed( $user_id, $topic->ID ) ) {
		if ( bbp_remove_user_subscription( $user_id, $topic->ID ) )
			die( '1' );
	} else {
		if ( bbp_add_user_subscription( $user_id, $topic->ID ) )
			die( '1' );
	}

	die( '0' );
}
add_action( 'wp_ajax_dim-subscription', 'bbp_skeleton_dim_subscription' );
endif;
