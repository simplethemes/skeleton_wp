<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	// Color Options
	$color_styles = array(
	"style1" => "Style One",
	"style2" => "Style Two",
	"style3" => "Style Three",
	"style4" => "Style Four",
	"style5" => "Style Five",
	"style6" => "Style Six",
	"style7" => "Style Seven");
	
	// Multicheck Array
	$multicheck_array = array("one" => "French Toast", "two" => "Pancake", "three" => "Omelette", "four" => "Crepe", "five" => "Waffle");
	
	// Multicheck Defaults
	$multicheck_defaults = array("one" => "1","five" => "1");
	
	// Background Defaults
	
	$body_background_defaults = array(
	'color' => '#fcfcfc',
	'image' => 'wp-content/themes/skeleton/images/border_top.png',
	'repeat' => 'repeat-x',
	'position' => 'top center',
	'attachment'=>'fixed');
	
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_bloginfo('stylesheet_directory') . '/images/';
		
	$options = array();
		
	$options[] = array( "name" => "Basic Settings",
						"type" => "heading");
						
	$options[] = array( "name" => "Color Style",
					"desc" => "Select your default color style to be used.",
					"id" => "style_select",
					"std" => "style3",
					"type" => "select",
					"class" => "mini", //mini, tiny, small
					"options" => $color_styles);			 

							
	$options[] = array( "name" => "Input Text Mini",
						"desc" => "A mini text input field.",
						"id" => "example_text_mini",
						"std" => "Default",
						"class" => "mini",
						"type" => "text");
								
	$options[] = array( "name" => "Input Text",
						"desc" => "A text input field.",
						"id" => "example_text",
						"std" => "Default Value",
						"type" => "text");
							
	$options[] = array( "name" => "Footer Fine Print",
						"desc" => "HTML or text to be inserted into the very bottom after the widgets.",
						"id" => "footer_text",
						"std" => "",
						"type" => "textarea"); 
						
						
	$options[] = array( "name" => "Input Select Wide",
						"desc" => "A wider select box.",
						"id" => "example_select_wide",
						"std" => "two",
						"type" => "select",
						"options" => $color_styles);
						
	$options[] = array( "name" => "Select a Category",
						"desc" => "Passed an array of categories with cat_ID and cat_name",
						"id" => "example_select_categories",
						"type" => "select",
						"options" => $options_categories);
						
	$options[] = array( "name" => "Select a Page",
						"desc" => "Passed an pages with ID and post_title",
						"id" => "example_select_pages",
						"type" => "select",
						"options" => $options_pages);
						
	$options[] = array( "name" => "Input Radio (one)",
						"desc" => "Radio select with default options 'one'.",
						"id" => "example_radio",
						"std" => "one",
						"type" => "radio",
						"options" => $color_styles);
							
	$options[] = array( "name" => "Example Info",
						"desc" => "This is just some example information you can put in the panel.",
						"type" => "info");
											
	// $options[] = array( "name" => "Author Attribution",
	// 					"desc" => "Allows you to show appreciation for by displaying a subtle link to our site in your footer.",
	// 					"id" => "remove_attrib",
	// 					"std" => "1",
	// 					"type" => "checkbox");
						
	$options[] = array( "name" => "Advanced Settings",
						"type" => "heading");
						
	$options[] = array( "name" => "Check to Show a Hidden Text Input",
						"desc" => "Click here and see what happens.",
						"id" => "example_showhidden",
						"type" => "checkbox");
	
	$options[] = array( "name" => "Hidden Text Input",
						"desc" => "This option is hidden unless activated by a checkbox click.",
						"id" => "example_text_hidden",
						"std" => "Hello",
						"class" => "hidden",
						"type" => "text");

	$options[] = array( "name" => "Check to Show a Hidden Text Input",
						"desc" => "Click here and see what happens.",
						"id" => "example_showhidden2",
						"type" => "checkbox");
  
	$options[] = array( "name" => "Hidden Text Input",
						"desc" => "This option is hidden unless activated by a checkbox click.",
						"id" => "example_text_hidden2",
						"std" => "Hello",
						"class" => "hidden",
						"type" => "text");
  
						
	$options[] = array( "name" => "Uploader Test",
						"desc" => "This creates a full size uploader that previews the image.",
						"id" => "example_uploader",
						"type" => "upload");
						
	$options[] = array( "name" => "Layout Style",
						"desc" => "Select a sidebar layout (left or right). You can also select a wide page layout on a per-page basis.",
						"id" => "page_layout",
						"std" => "right",
						"type" => "images",
						"options" => array(
							'left' => $imagepath . '2cl.png',
							'right' => $imagepath . '2cr.png')
						);
						
	$options[] = array( "name" =>  "Body Background",
						"desc" => "Change the background CSS.",
						"id" => "body_background",
						"std" => $body_background_defaults, 
						"type" => "background");
								
	$options[] = array( "name" => "Multicheck",
						"desc" => "Multicheck description.",
						"id" => "example_multicheck",
						"std" => $multicheck_defaults, // These items get checked by default
						"type" => "multicheck",
						"options" => $multicheck_array);
							

	$options[] = array( "name" => "Link Color",
						"desc" => "Default hyperlink colors.",
						"id" => "link_color",
						"std" => "#3568A9",
						"type" => "color");

  $options[] = array( "name" => "Main Typography",
					"desc" => "Body Typography.",
					"id" => "body_typography",
					"std" => array('size' => '12px','face' => 'helvetica','style' => 'normal','color' => '#444444'),
					"type" => "typography");			

						
	$options[] = array( "name" => "Heading Typography (H1)",
						"desc" => "Heading typography.",
						"id" => "h1_typography",
						"std" => array('size' => '40px','face' => 'helvetica','style' => 'normal','color' => '#181818'),
						"type" => "typography");
  
  $options[] = array( "name" => "Heading Typography (H2)",
					"desc" => "Heading Two typography.",
					"id" => "h2_typography",
					"std" => array('size' => '35px','face' => 'helvetica','style' => 'normal','color' => '#181818'),
					"type" => "typography");			
				  

  $options[] = array( "name" => "Heading Typography (H3)",
					"desc" => "Heading Three typography.",
					"id" => "h3_typography",
					"std" => array('size' => '28px','face' => 'helvetica','style' => 'normal','color' => '#181818'),
					"type" => "typography");
	
	$options[] = array( "name" => "Heading Typography (H4)",
					"desc" => "Heading Four typography.",
					"id" => "h4_typography",
					"std" => array('size' => '21px','face' => 'helvetica','style' => 'bold','color' => '#181818'),
					"type" => "typography");			
	
 $options[] = array( "name" => "Heading Typography (H5)",
 				"desc" => "Heading Five typography.",
 				"id" => "h5_typography",
 				"std" => array('size' => '17px','face' => 'helvetica','style' => 'bold','color' => '#181818'),
 				"type" => "typography");			
 

	return $options;
}