<?php
/**
 * @package Skeleton WordPress Theme Framework
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
 *
 * Layout Hooks:
 *
 * skeleton_above_header // Opening header wrapper
 * skeleton_header // header tag and logo/header text
 * skeleton_header_extras // Additional content may be added to the header
 * skeleton_below_header // Closing header wrapper
 * skeleton_navbar // main menu wrapper
 * skeleton_before_content // Opening content wrapper
 * skeleton_after_content // Closing content wrapper
 * skeleton_before_sidebar // Opening sidebar wrapper
 * skeleton_after_sidebar // Closing sidebar wrapper
 * skeleton_footer // Footer
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
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 2.0
 */



/*-----------------------------------------------------------------------------------*/
/* Initialize the Options Framework
/* http://wptheming.com/options-framework-theme/
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'optionsframework_init' ) ) {

define('OPTIONS_FRAMEWORK_URL', get_template_directory_uri() . '/admin/');
define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory() . '/admin/');

require_once ( OPTIONS_FRAMEWORK_DIRECTORY.'options-framework.php');

} // endif



/*-----------------------------------------------------------------------------------*/
/* Customizeable Color Palette Preset
/*-----------------------------------------------------------------------------------*/

if (! function_exists('skeleton_colorpicker_options'))  {

function skeleton_colorpicker_options() {
	wp_enqueue_script( 'colorpicker-options', get_template_directory_uri() . '/javascripts/colorpicker.js', array( 'jquery','wp-color-picker' ),1,true );
}
add_action( 'optionsframework_custom_scripts', 'skeleton_colorpicker_options' );

} // endif function exists


/*-----------------------------------------------------------------------------------*/
/* Define the sidebar and content widths for use in multiple functions
/* These values can be overridden on a conditional basis later on. See comments.
/*-----------------------------------------------------------------------------------*/


if (!of_get_option('sidebar_width')) {
	define('SIDEBARWIDTH', 'five');
} else {
	define('SIDEBARWIDTH', of_get_option('sidebar_width'));
}

if (!of_get_option('content_width')) {
	define('CONTENTWIDTH', 'eleven');
} else {
	define('CONTENTWIDTH', of_get_option('content_width'));
}


// Load theme-specific shortcodes and helpers
require_once (get_template_directory() . '/shortcodes.php');

/*-----------------------------------------------------------------------------------*/
/* Register Core Stylesheets
/* These are necessary for the theme to function as intended
/* Supports the 'Better WordPress Minify' plugin to properly minimize styleshsets into one.
/* http://wordpress.org/extend/plugins/bwp-minify/
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'skeleton_registerstyles' ) ) {

function skeleton_registerstyles() {

	// Set a dynamic version for cache busting
	$theme = wp_get_theme();
	if(is_child_theme()) {
		$parent = $theme->parent();
		$version = $parent['Version'];
		} else {
		$version = $theme['Version'];
	}

	$stylesheets = '';

	// register the various widths based on max_layout_width option
	$maxwidth = of_get_option('max_layout_width');

	if ($maxwidth) {
		// load the appropriate stylesheet
  		$stylesheets .= wp_register_style('skeleton', get_template_directory_uri() .'/css/skeleton-'.$maxwidth.'.css', array(), $version, 'screen, projection');
	} else {
		//fallback to original for legacy theme compatibility
  		$stylesheets .= wp_register_style('skeleton', get_template_directory_uri() .'/css/skeleton-960.css', array(), $version, 'screen, projection');
	}

	// Register all other applicable stylesheets
    $stylesheets .= wp_register_style('layout', get_template_directory_uri().'/css/layout.css', array(), $version, 'screen, projection');
    $stylesheets .= wp_register_style('formalize', get_template_directory_uri().'/css/formalize.css', array(), $version, 'screen, projection');
    $stylesheets .= wp_register_style('superfish', get_template_directory_uri().'/css/superfish.css', array(), $version, 'screen, projection');
    $stylesheets .= wp_register_style('theme', get_stylesheet_directory_uri().'/style.css', array(), $version, 'screen, projection');

	// hook to add additional stylesheets from a child theme
	echo apply_filters ('child_add_stylesheets',$stylesheets);

	// enqueue registered styles
	wp_enqueue_style( 'skeleton');
	wp_enqueue_style( 'theme');
	wp_enqueue_style( 'layout');
	wp_enqueue_style( 'formalize');
	wp_enqueue_style( 'superfish');
}

add_action( 'wp_enqueue_scripts', 'skeleton_registerstyles');

}


/*-----------------------------------------------------------------------------------*/
/* Register Core Javascript
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'skeleton_header_scripts' ) ) {

	add_action('init', 'skeleton_header_scripts');
	function skeleton_header_scripts() {
		$javascripts  = wp_enqueue_script('jquery');
		$javascripts .= wp_enqueue_script('custom',get_template_directory_uri()."/javascripts/app.js",array('jquery'),'1.2.3',true);
		$javascripts .= wp_enqueue_script('superfish',get_template_directory_uri()."/javascripts/superfish.js",array('jquery'),'1.2.3',true);
		$javascripts .= wp_enqueue_script('formalize',get_template_directory_uri()."/javascripts/jquery.formalize.min.js",array('jquery'),'1.2.3',true);
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		$javascripts  =  wp_enqueue_script( 'comment-reply' );
		}
		echo apply_filters ('child_add_javascripts',$javascripts);
	}

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
 * @uses add_theme_support() To add support for post thumbnails, custom-header and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Skeleton 1.0
 */
function skeleton_setup() {
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

 	// Use Regenerate Thumbnails Plugin to create these images on an existing install..
	// Set default thumbnail size
  	set_post_thumbnail_size( 150, 150 );
	// 150px square
	add_image_size( $name = 'squared150', $width = 150, $height = 150, $crop = true );
	// 250px square
	add_image_size( $name = 'squared250', $width = 250, $height = 250, $crop = true );
	// 4:3 Video
	add_image_size( $name = 'video43', $width = 320, $height = 240, $crop = true );
	// 16:9 Video
	add_image_size( $name = 'video169', $width = 320, $height = 180, $crop = true );


	// Register the available menus
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'smpl' ),
		'footer'	=> __( 'Footer Navigation', 'smpl' )
	));

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'smpl', get_template_directory() . '/languages' );


}
endif; // end skeleton_setup


/*-----------------------------------------------------------------------------------*/
// Main opening theme wrapper
/*-----------------------------------------------------------------------------------*/

// Hook to add content before header

if ( !function_exists( 'skeleton_above_header' ) ) {

function skeleton_above_header() {
    do_action('skeleton_above_header');
}

} // endif


if ( !function_exists( 'skeleton_wrapper_open' ) ) {

	function skeleton_wrapper_open() {
		echo "<div id=\"wrap\" class=\"container\">";
		//closed in skeleton_after_footer()
	}

} // endif

add_action('skeleton_above_header','skeleton_wrapper_open', 1);


/*-----------------------------------------------------------------------------------*/
// Opening #header
/*-----------------------------------------------------------------------------------*/

// Primary Header Function

if ( !function_exists( 'skeleton_header' ) ) {

	function skeleton_header() {
		do_action('skeleton_header');
	}

}

if ( !function_exists( 'skeleton_header_open' ) ) {

	function skeleton_header_open() {
	  	echo "<div id=\"header\" class=\"sixteen columns\">\n<div class=\"inner\">\n";
	}

} // endif

add_action('skeleton_header','skeleton_header_open', 1);


/*-----------------------------------------------------------------------------------*/
// Hookable theme option field to add add'l content to header
// such as social icons, phone number, widget, etc...
// Child Theme Override: child_header_extras();
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'skeleton_header_extras' ) ) {

	function skeleton_header_extras() {
		if (of_get_option('header_extra')) {
			$extras  = "<div class=\"header_extras\">";
			$extras .= of_get_option('header_extra');
			$extras .= "</div>";
			echo apply_filters ('child_header_extras',$extras);
		}
	}

} // endif

add_action('skeleton_header','skeleton_header_extras', 2);


/*-----------------------------------------------------------------------------------*/
/* SEO Logo
/* Displays H1 or DIV based on whether we are on the home page or not (for SEO)
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'skeleton_logo' ) ) {

	function skeleton_logo() {
		$heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';
		if (of_get_option('use_logo_image')) {
			$class="graphic";
		} else {
			$class="text";
		}
		$skeleton_logo  = '<'.$heading_tag.' id="site-title" class="'.$class.'"><a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo('name','display')).'">'.get_bloginfo('name').'</a></'.$heading_tag.'>'. "\n";
		$skeleton_logo .= '<span class="site-desc '.$class.'">'.get_bloginfo('description').'</span>'. "\n";
		echo apply_filters ( 'child_logo', $skeleton_logo);
	}
	add_action('skeleton_header','skeleton_logo', 3);

} // endif


/*-----------------------------------------------------------------------------------*/
// Example of child theme logo replacement override
/*-----------------------------------------------------------------------------------*/


//	function my_custom_logo() {
//		$skeleton_logo = '<img src="http://placehold.it/320x150/000/FFF" alt="Logo"/>';
//		return $skeleton_logo;
//	}
//
//	add_filter('skeleton_logo','my_custom_logo');



/*-----------------------------------------------------------------------------------*/
/* Output CSS for Graphic Logo
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'skeleton_logostyle' ) ) {

function skeleton_logostyle() {
	if (of_get_option('use_logo_image')) {
		echo '<style type="text/css">#header #site-title.graphic a {background-image: url('.of_get_option('header_logo').');width: '.of_get_option('logo_width').'px;height: '.of_get_option('logo_height').'px;}</style>';
	}
}
add_action('wp_head', 'skeleton_logostyle');

} //endif


/*-----------------------------------------------------------------------------------*/
/* Closes the #header markup
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'skeleton_header_close' ) ) {

	function skeleton_header_close() {
		echo "</div>"."\n";
		echo "</div>"."\n";
		echo "<!--/#header-->"."\n";
	}
	add_action('skeleton_header','skeleton_header_close', 4);

} //endif


/*-----------------------------------------------------------------------------------*/
/* Hook to add custom content immediately after #header
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'skeleton_below_header' ) ) {

	function skeleton_below_header() {
		do_action('skeleton_below_header');
	}

} //endif


/*-----------------------------------------------------------------------------------*/
/* Navigation Hook
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'skeleton_navbar' ) ) {

	function skeleton_navbar() {
		do_action('skeleton_navbar');
	}

} //endif


if ( !function_exists( 'skeleton_main_menu' ) ) {

	function skeleton_main_menu() {
		echo '<div id="navigation" class="row sixteen columns">';
		wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary'));
		echo '</div><!--/#navigation-->';
	}

	add_action('skeleton_navbar','skeleton_main_menu', 1);

} //endif


/*-----------------------------------------------------------------------------------*/
/* Before Content - skeleton_before_content();
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'skeleton_before_content' ) ) {
	function skeleton_before_content() {
		do_action('skeleton_before_content');
	}
}


/*-----------------------------------------------------------------------------------*/
/* Filterable utility function to set the content width - skeleton_content_width()
/* Specifies the column classes via conditional statements
/* See http://codex.wordpress.org/Conditional_Tags for a full list
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'skeleton_content_width' ) ) {

	function skeleton_content_width() {

		global $post;

		// Single Posts
		if ( is_single() ) {
			$post_wide = get_post_meta($post->ID, "sidebars", $single = true) ==  "false";

			// make sure no Post widgets are active
			if ( !is_active_sidebar('primary-widget-area') || $post_wide ) {
				$columns = 'sixteen';
			// widgets are active
			} elseif ( is_active_sidebar('primary-widget-area') && !$post_wide ) {
				$columns = CONTENTWIDTH;
			}

		// Single Pages
		} elseif ( is_page() ) {
			$page_wide = is_page_template('onecolumn-page.php');

			// make sure no Page widgets are active
			if ( !is_active_sidebar('secondary-widget-area') || $page_wide ) {
				$columns = 'sixteen';
			// widgets are active
			} elseif ( is_active_sidebar('secondary-widget-area') && !$page_wide ) {
				$columns = CONTENTWIDTH;
			}

		// All Others
		} else {
			$columns = CONTENTWIDTH;
		}

		return $columns;

	}
	// Create filter
	add_filter('skeleton_set_colwidth', 'skeleton_content_width', 10, 1);

}


/*-----------------------------------------------------------------------------------*/
// Content Wrap Markup - skeleton_content_wrap()
// Be sure to add the excess of 16 to skeleton_before_sidebar() as well
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'skeleton_content_wrap' ) )  {

	function skeleton_content_wrap() {

	$columns = '';
	$columns = apply_filters('skeleton_set_colwidth', $columns, 1);


	// Apply the markup
	echo '<a id="top"></a>';
	echo '<div id="content" class="'.$columns.' columns">';

	}
	// hook to skeleton_before_content()
	add_action( 'skeleton_before_content', 'skeleton_content_wrap', 1 );

} //endif



/*-----------------------------------------------------------------------------------*/
/* After Content Hook
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'skeleton_after_content' ) ) {

	function skeleton_after_content() {
		do_action('skeleton_after_content');
	}

} //endif



/*-----------------------------------------------------------------------------------*/
// After Content Wrap Markup - skeleton_content_wrap_close()
/*-----------------------------------------------------------------------------------*/


if (! function_exists('skeleton_content_wrap_close'))  {

    function skeleton_content_wrap_close() {
    	echo "\t\t</div><!-- /.columns (#content) -->\n";
    }

    add_action( 'skeleton_after_content', 'skeleton_content_wrap_close', 1 );
}



/*-----------------------------------------------------------------------------------*/
/* Before Sidebar Hook - skeleton_before_sidebar()
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'skeleton_before_sidebar' ) ) {

	function skeleton_before_sidebar() {
		do_action('skeleton_before_sidebar');
	}

} //endif


/*-----------------------------------------------------------------------------------*/
/* Filterable utility function to set the sidebar width - skeleton_sidebar_width()
/* Specifies the column classes via conditional statements
/* See http://codex.wordpress.org/Conditional_Tags for a full list
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'skeleton_sidebar_width' ) ) {

	function skeleton_sidebar_width() {
	global $post;

	if ( is_single() ) {
		// Posts: check for custom field of sidebars => false
		$post_wide = get_post_meta($post->ID, "sidebars", $single = true) ==  "false";

		// make sure no Post widgets are active
		if ( !is_active_sidebar('primary-widget-area') || $post_wide ) {
			$columns = false;
		// widgets are active
		} elseif ( is_active_sidebar('primary-widget-area') && !$post_wide ) {
			$columns = SIDEBARWIDTH;
		}

	} elseif ( is_page() ) {
		// Pages: check for custom page template
		$page_wide = is_page_template('onecolumn-page.php');

		// make sure no Page widgets are active
		if ( !is_active_sidebar('secondary-widget-area') || $page_wide ) {
			$columns = false;
		// widgets are active
		} elseif ( is_active_sidebar('secondary-widget-area') && !$page_wide ) {
			$columns = SIDEBARWIDTH;
		}

	} else {
		$columns = SIDEBARWIDTH;
	}

	return $columns;


	}
	// Create filter
	add_filter('skeleton_set_sidebarwidth', 'skeleton_sidebar_width', 10, 1);

} //endif


/*-----------------------------------------------------------------------------------*/
// Sidebar Wrap Markup - skeleton_sidebar_wrap()
// Be sure to add the excess of 16 to skeleton_content_wrap() as well
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'skeleton_sidebar_wrap' ) )  {

	function skeleton_sidebar_wrap() {

	$columns = '';
	$columns = apply_filters('skeleton_set_sidebarwidth', $columns, 1);


	// Apply the markup
	echo '<div id="sidebar" class="'.$columns.' columns" role="complementary">';

	}
	// hook to skeleton_before_content()
	add_action( 'skeleton_before_sidebar', 'skeleton_sidebar_wrap', 1 );

} //endif


/*-----------------------------------------------------------------------------------*/
/* After Sidebar Hook - skeleton_after_sidebar()
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'skeleton_after_sidebar' ) ) {

	function skeleton_after_sidebar() {
		do_action('skeleton_after_sidebar');
	}

} //endif


/*-----------------------------------------------------------------------------------*/
/* After Sidebar Markup
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'skeleton_sidebar_wrap_close' ) ) {
	function skeleton_sidebar_wrap_close() {
	// Additional Content could be added here
	   echo '</div><!-- #sidebar -->';
	}
} //endif

add_action( 'skeleton_after_sidebar', 'skeleton_sidebar_wrap_close');


/*-----------------------------------------------------------------------------------*/
// Sidebar Positioning Utility (sidebar-left | sidebar-right)
// Sets a body class for source ordered sidebar positioning
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'skeleton_sidebar_position' ) ) {

function skeleton_sidebar_position($class) {
		//global $post;
		$sidebar_position = of_get_option('page_layout');
		$sidebar_position = ($sidebar_position == "right" ? "right" : "left");
		$class[] = 'sidebar-'.$sidebar_position;
		return $class;
	}
	add_filter('body_class','skeleton_sidebar_position');
}  // endif


/*-----------------------------------------------------------------------------------*/
// Global hook for footer actions
/*-----------------------------------------------------------------------------------*/

function skeleton_footer() {
	do_action('skeleton_footer');
}
add_action('wp_footer', 'skeleton_footer',1);


/*-----------------------------------------------------------------------------------*/
/* Before Footer
/*-----------------------------------------------------------------------------------*/

if (!function_exists('skeleton_before_footer'))  {
    function skeleton_before_footer() {
			$footerwidgets = is_active_sidebar('first-footer-widget-area') + is_active_sidebar('second-footer-widget-area') + is_active_sidebar('third-footer-widget-area') + is_active_sidebar('fourth-footer-widget-area');
			$class = ($footerwidgets == '0' ? 'noborder' : 'normal');
			echo '<div class="clear"></div><div id="footer" class="'.$class.' sixteen columns">';
    }
    add_action('skeleton_footer', 'skeleton_before_footer',1);
}


/*-----------------------------------------------------------------------------------*/
// Footer Widgets
/*-----------------------------------------------------------------------------------*/

if (! function_exists('skeleton_footer_widgets'))  {
	function skeleton_footer_widgets() {
		//loads sidebar-footer.php
		get_sidebar( 'footer' );
	}
	add_action('skeleton_footer', 'skeleton_footer_widgets',2);
}



/*-----------------------------------------------------------------------------------*/
// Footer Navigation
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'skeleton_footer_nav' ) ) {

	function skeleton_footer_nav() {

		$defaults = array(
		  'theme_location'  => 'footer',
		  'container'       => 'div',
		  'container_id' 	=> 'footermenu',
		  'menu_class'      => 'menu',
		  'echo'            => true,
		  'fallback_cb'     => 'wp_page_menu',
		  'after'           => '<span> | </span>',
		  'depth'           => 1);
		wp_nav_menu($defaults);
		echo '<div class="clear"></div>';

	}
	add_action('skeleton_footer', 'skeleton_footer_nav',3);
} //endif


/*-----------------------------------------------------------------------------------*/
/* Footer Credits
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'skeleton_footer_credits' ) ) {
	function skeleton_footer_credits() {
		echo '<div id="credits">';
		echo of_get_option('footer_text');
		echo '<div class="themeauthor">WordPress Theme by <a href="http://www.simplethemes.com">Simple Themes</a></div></div>';
	}
	add_action('skeleton_footer', 'skeleton_footer_credits',4);
}



/*-----------------------------------------------------------------------------------*/
/* After Footer
/*-----------------------------------------------------------------------------------*/

if (!function_exists('skeleton_after_footer'))  {

    function skeleton_after_footer() {
			echo "</div><!--/#footer-->"."\n";
			echo "</div><!--/#wrap.container-->"."\n";
			// Custom Scripts
			if (of_get_option('footer_scripts') <> "" ) {
				echo '<script type="text/javascript">'.stripslashes(of_get_option('footer_scripts')).'</script>';
			}
    }
	add_action('skeleton_footer', 'skeleton_after_footer',5);
}


/*-----------------------------------------------------------------------------------*/
//	Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
//	To override skeleton_widgets_init() in a child theme, remove the action hook and add your own
//	function tied to the init hook.
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'skeleton_widgets_init' ) ) {

function skeleton_widgets_init() {
		// Area 1, located at the top of the sidebar.
		register_sidebar( array(
		'name' => __( 'Posts Widget Area', 'smpl' ),
		'id' => 'primary-widget-area',
		'description' => __( 'Shown only in Blog Posts, Archives, Categories, etc.', 'smpl' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );


	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Pages Widget Area', 'smpl' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'Shown only in Pages', 'smpl' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'smpl' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'smpl' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'smpl' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'smpl' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'smpl' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'smpl' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'smpl' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'smpl' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

/** Register sidebars by running skeleton_widgets_init() on the widgets_init hook. */

add_action( 'widgets_init', 'skeleton_widgets_init' );

}


/*-----------------------------------------------------------------------------------*/
// Featured Thumbnails
// Utility function for defining conditional featured image settings
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'skeleton_thumbnailer' ) ) {

	function skeleton_thumbnailer($content) {
		global $post;
		global $id;
		$size = 'squared150';
		$align = 'alignleft scale-with-grid';
		$image = get_the_post_thumbnail($id, $size, array('class' => $align));
		$content =  $image . $content;
		return $content;
	}
	add_filter('the_content','skeleton_thumbnailer');

}


/*-----------------------------------------------------------------------------------*/
// Sets the post excerpt length to 40 characters.
// To override this length in a child theme, remove the filter and add your own
// function tied to the excerpt_length filter hook.
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'skeleton_excerpt_length' ) ) {

	function skeleton_excerpt_length( $length ) {
		return 40;
	}
	add_filter( 'excerpt_length', 'skeleton_excerpt_length' );

}



/*-----------------------------------------------------------------------------------*/
// Returns a "Continue Reading" link for excerpts
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'skeleton_continue_reading_link' ) ) {

	function skeleton_continue_reading_link() {
		return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'smpl' ) . '</a>';
	}
}


/*-----------------------------------------------------------------------------------*/
// Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis
// and skeleton_continue_reading_link().
//
// To override this in a child theme, remove the filter and add your own
// function tied to the excerpt_more filter hook.
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'skeleton_auto_excerpt_more' ) ) {

	function skeleton_auto_excerpt_more( $more ) {
		return ' &hellip;' . skeleton_continue_reading_link();
	}
	add_filter( 'excerpt_more', 'skeleton_auto_excerpt_more' );

}

/*-----------------------------------------------------------------------------------*/
// Adds a pretty "Continue Reading" link to custom post excerpts.
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'skeleton_custom_excerpt_more' ) ) {

	function skeleton_custom_excerpt_more( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$output .= skeleton_continue_reading_link();
		}
		return $output;
	}
	add_filter( 'get_the_excerpt', 'skeleton_custom_excerpt_more' );

}



/*-----------------------------------------------------------------------------------*/
// Removes the page jump when read more is clicked through
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'remove_more_jump_link' ) ) {

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

}



/*-----------------------------------------------------------------------------------*/
//	Comment Styles
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'skeleton_comments' ) ) :
	function skeleton_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="single-comment clearfix">
			<div class="comment-author vcard"> <?php echo get_avatar($comment,$size='64'); ?></div>
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
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'smpl' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'smpl' ), get_the_author() ),
			get_the_author()
		)
	);
}

endif;

if ( ! function_exists( 'skeleton_posted_in' ) ) :

	 // Prints HTML with meta information for the current post (category, tags and permalink).
	function skeleton_posted_in() {
		// Retrieves tag list of current post, separated by commas.
		$tag_list = get_the_tag_list( '', ', ' );
		if ( $tag_list ) {
			$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'smpl' );
		} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
			$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'smpl' );
		} else {
			$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'smpl' );
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


/*-----------------------------------------------------------------------------------*/
/* Enable Shortcodes in excerpts and widgets
/*-----------------------------------------------------------------------------------*/


add_filter('widget_text', 'do_shortcode');
add_filter( 'the_excerpt', 'do_shortcode');
add_filter('get_the_excerpt', 'do_shortcode');


/*-----------------------------------------------------------------------------------*/
/* Override default embeddable content width
/*-----------------------------------------------------------------------------------*/

if (!function_exists('skeleton_content_width'))  {
	function skeleton_content_width() {
		$content_width = 580;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Filters wp_title to print a proper <title> tag based on content
/*-----------------------------------------------------------------------------------*/
if (!function_exists('skeleton_wp_title'))  {

	function skeleton_wp_title( $title, $sep ) {
		global $page, $paged;

		if ( is_feed() )
			return $title;

		// Add the blog name
		$title .= get_bloginfo( 'name' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title .= " $sep $site_description";

		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			$title .= " $sep " . sprintf( __( 'Page %s', 'skeleton' ), max( $paged, $page ) );

		return apply_filters ('skeleton_child_wp_title',$title);
	}
}
add_filter( 'wp_title', 'skeleton_wp_title', 10, 2 );

/*-----------------------------------------------------------------------------------*/
/* Override default filter for theme options 'textarea' sanitization.
/*-----------------------------------------------------------------------------------*/


function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'skeleton_custom_sanitize_textarea' );
}

add_action('admin_init','optionscheck_change_santiziation', 100);


function skeleton_custom_sanitize_textarea($input) {
    global $allowedposttags;
    	$custom_allowedtags["embed"] = array(
    		"src" => array(),
    		"type" => array(),
    		"allowfullscreen" => array(),
    		"allowscriptaccess" => array(),
    		"height" => array(),
    		"width" => array()
    	);
    	$custom_allowedtags["script"] = array();
    	$custom_allowedtags["a"] = array('href' => array(),'title' => array());
    	$custom_allowedtags["img"] = array('src' => array(),'title' => array(),'alt' => array());
    	$custom_allowedtags["br"] = array();
    	$custom_allowedtags["em"] = array();
    	$custom_allowedtags["strong"] = array();
      	$custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
      	$output = wp_kses( $input, $custom_allowedtags);
      	return $output;
}



/*-----------------------------------------------------------------------------------*/
/* Theme Customization Options
/*-----------------------------------------------------------------------------------*/
if (!function_exists('skeleton_options_styles'))  {

	function skeleton_options_styles() {

		// build an array of styleable heading tags
		$headings = array(
			'body' => 'body',
			'#site-title a' => 'header',
			'.site-desc.text' => 'tagline',
			'h1' => 'h1',
			'h2' => 'h2',
			'h3' => 'h3',
			'h4' => 'h4',
			'h5' => 'h5'
		);

		$stackarray = array(
			'helvetica'  => '"HelveticaNeue", "Helvetica Neue", Helvetica, Arial, sans-serif',
			'arial' 	 => 'Arial, Helvetica, sans-serif',
			'georgia' 	 => 'Constantia, "Lucida Bright", Lucidabright, "Lucida Serif", Lucida, "DejaVu Serif", "Bitstream Vera Serif", "Liberation Serif", Georgia, serif',
			'cambria' 	 => 'Cambria, "Hoefler Text", Utopia, "Liberation Serif", "Nimbus Roman No9 L Regular", Times, "Times New Roman", serif',
			'tahoma' 	 => 'Tahoma, Verdana, Segoe, sans-serif',
			'palatino' 	 => '"Palatino Linotype", Palatino, Baskerville, Georgia, serif',
			'droidsans'  => '"Droid Sans", sans-serif',
			'droidserif' => '"Droid Serif", serif',
		);


		echo '<style type="text/css">';

		foreach ($headings as $key => $selector) {
			$item = $selector.'_typography';
			$property = of_get_option($item);
			$face = $property['face'];
			echo $key.' {';
			echo 'color:'.$property['color'].';';
			echo 'font-size:'.$property['size'].';';
			echo 'font-family:'.$stackarray[$property['face']].';';
			if ($property['style'] == "bold italic") {
			echo 'font-weight:bold;';
			echo 'font-style:italic;';
			} else {
			echo 'font-weight:'.$property['style'].';';
			}
			echo '}'."\n";
		}

		// Body Background
		echo 'body {';
		// Custom Background
		$body_background = of_get_option('body_background');
		if ($body_background) {
			if ($body_background['image']) {
				echo 'background:'.$body_background['color'].' url('.$body_background['image'].') '.$body_background['repeat'].' '.$body_background['position'].' '.$body_background['attachment'].';';
			} elseif ($body_background['color']) {
				echo 'background-color:'.$body_background['color'].';';
			}
		}
		// End Body Styles
		echo '}'."\n";
		echo 'a { color: '.of_get_option('link_color', '#000').';}';
		echo '</style>';
	}
}
add_action('wp_head','skeleton_options_styles',10);
