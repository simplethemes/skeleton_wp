<?php
/**
* Example Child Theme Functions
*/


/*-----------------------------------------------------------------------------------*/
/* Initialize the Options Framework
/* http://wptheming.com/options-framework-theme/
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'optionsframework_init' ) ) {

define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/admin/');

require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');

}


/* 
 * Overrides the theme options panel custom scripts
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#use_logo_image').click(function() {
		jQuery('#section-header_logo,#section-logo_width,#section-logo_height').fadeToggle(400);
	});
	
	if (jQuery('#use_logo_image:checked').val() !== undefined) {
		jQuery('#section-header_logo,#section-logo_width,#section-logo_height').show();
	}
	
});
</script>

<?php
}


// Append an additional stylesheet(s) after the existing parent theme

add_filter ('child_add_stylesheets','my_custom_stylesheets');

function my_custom_stylesheets() {
	$theme  = get_theme( get_current_theme());
	$version = $theme['Version'];
  $stylesheets = wp_enqueue_style('mycustom', get_bloginfo('template_directory').'/yourstylesheet.css', 'theme', $version, 'screen, projection');
}

// Append additional script(s) after the existing parent theme
// (jQuery dependent)

add_filter ('child_add_javascripts','my_custom_javascripts');

function my_custom_javascripts() {
	$javascripts = wp_enqueue_script('mycustom',get_bloginfo('template_url') ."/javascripts/yourcustomscripts.js",array('jquery'),'1.2.3',true);
}

// Additional markup or content before header
function st_above_header() {
echo '<div id="above_header" class="fourteen columns offset-by-one">I am above the header</div>';
}

// Header container markup

function st_header_open() {
echo "<div id=\"header\" class=\"fourteen columns offset-by-one\">\n<div class=\"inner\">\n";
}


// Additional markup or content inside header

add_filter ('child_header_extras','my_header_extras');

function my_header_extras() {
	if (is_front_page()) {
	$extras  = "<div class=\"header_extras\">";
	$extras .= 'I am an announcement only shown on the front page.';
	$extras .= "</div>";
	}
	echo $extras;
}

// Closing header container

function st_header_close() {
echo "</div></div><!--/#header-->";
}

// Additional markup or content below header

function st_below_header() {
 echo '<div id="below_header" class="fourteen columns offset-by-one">I am below the header</div>';
}

// End Header

// Navigation

function st_navbar() {
	echo '<div id="navigation" class="row fourteen columns offset-by-one">';
	wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary'));
	echo '</div><!--/#navigation-->';
}

// Main Content Area Wrapper (grid)

function child_before_content() {
// Set the default

if (empty($columns)) {
	$columns = 'nine';
	} else {
	// Check the function for a returned variable
	$columns = $columns;
}

// force wide on onecolumn-page template
if (is_page_template('onecolumn-page.php')) {
$columns = 'fourteen';
}

// force wide on bbPress pages

if ( class_exists( 'bbPress' ) ) {

if (is_bbpress()) {
$columns = 'fourteen';
}
// unless it's the member profile
if (bbp_is_user_home()) {
$columns = 'nine';
}

} // bbPress

// Apply the markup
echo "<a name=\"top\" id=\"top\"></a>";
// detect the page layout
$sidebar_position = of_get_option('page_layout');
//sidebar positon left and not a wide page
if ($sidebar_position == "left" && !is_page_template('onecolumn-page.php') && is_dynamic_sidebar()) {
echo "<div id=\"content\" class=\"$columns columns left omega\">";
// sidebar right and 
} elseif ($sidebar_position == "right" && !is_page_template('onecolumn-page.php') && is_dynamic_sidebar()) {
echo "<div id=\"content\" class=\"$columns columns offset-by-one\">";
} else {
echo "<div id=\"content\" class=\"$columns columns wide\">";
}
}


// Closing Main Content Area Wrapper (grid)

function child_after_content() {
	echo "\t\t</div><!-- /.columns (#content) -->\n";
}

// Opening Sidebar Wrapper

function before_sidebar($columns) {

$sidebar_position = of_get_option('page_layout');

// You can specify the number of columns in conditional statements
// See http://codex.wordpress.org/Conditional_Tags for a full list
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
echo '<div id="sidebar" class="'.$columns.' columns '.$sidebar_position.'" role="complementary">';
}

// Footer Wrapper 
function child_before_footer() {
$footerwidgets = is_active_sidebar('first-footer-widget-area') + is_active_sidebar('second-footer-widget-area') + is_active_sidebar('third-footer-widget-area') + is_active_sidebar('fourth-footer-widget-area');
$class = ($footerwidgets == '0' ? 'noborder' : 'normal');
echo '<div id="footer" class="'.$class.' fourteen columns offset-by-one">';
}

function child_after_footer() {
echo "</div><!--/#footer-->"."\n";
echo "</div><!--/#wrap.container-->"."\n";
// Google Analytics
if (of_get_option('footer_scripts') <> "" ) {
	echo '<script type="text/javascript">'.stripslashes(of_get_option('footer_scripts')).'</script>';
}
}




?>