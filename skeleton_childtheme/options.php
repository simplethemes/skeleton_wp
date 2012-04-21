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
	
	// Background Defaults
	
	$body_background_defaults = array(
	'color' => '#fcfcfc',
	'image' => site_url('wp-content/themes/skeleton/images/border_top.png'),
	'repeat' => 'repeat-x',
	'position' => 'top center',
	'attachment'=>'fixed');
	
	
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_bloginfo('template_directory') . '/images/';
		
	$options = array();
						
	$options[] = array( "name" => __("Style Options", "skeleton"),
						"type" => "heading");
						
												
	$options[] = array( "name" => __("Style options", "skeleton"),
						"desc" => __("The following options allow you to apply basic customizations to your theme colors. In some cases however, you will need to edit CSS. <br /> This can be done from <a href=\"theme-editor.php\">stylesheet editor</a> or by navigating to Appearance &rarr; Editor.", "skeleton"),
						"type" => "info");
						
	$options[] = array( "name" => __("Logo Style", "skeleton"),
						"desc" => __("Display a custom image/logo image in place of title header.", "skeleton"),
						"id" => "use_logo_image",
						"type" => "checkbox");


	$options[] = array( "name" => __("Header Logo", "skeleton"),
						"desc" => __("If you prefer to show a graphic logo in place of the header, you can upload or paste the URL here. Set the width and height below. <strong>Your logo should be resized prior to uploading</strong>", "skeleton"),
						"id" => "header_logo",
						"class" => "hidden",
						"type" => "upload");
						
	$options[] = array( "name" => __("Logo Width", "skeleton"),
						"desc" => __("Width (in px) of Your logo.", "skeleton"),
						"id" => "logo_width",
						"std" => "300",
						"class" => "mini hidden",
						"type" => "text");
						
	$options[] = array( "name" => __("Logo Height", "skeleton"),
						"desc" => __("Height (in px) of Your logo.", "skeleton"),
						"id" => "logo_height",
						"std" => "80",
						"class" => "mini hidden",
						"type" => "text");
  	
	$options[] = array( "name" =>  __("Body Background", "skeleton"),
						"desc" => __("Change the background CSS.", "skeleton"),
						"id" => "body_background",
						"std" => $body_background_defaults, 
						"type" => "background");
						
	$options[] = array( "name" => __("Sidebar Position", "skeleton"),
						"desc" => __("Select a sidebar layout position (left or right). You can also select a wide page layout on a per-page basis.", "skeleton"),
						"id" => "page_layout",
						"std" => "right",
						"type" => "images",
						"options" => array(
							'left' => $imagepath . '2cl.png',
							'right' => $imagepath . '2cr.png')
						);
  
	$options[] = array( "name" => __("Header (text) Color", "skeleton"),
						"desc" => __("Header Colors.", "skeleton"),
						"id" => "header_color",
						"std" => "#000000",
						"type" => "color");
  
	$options[] = array( "name" => __("Link Color", "skeleton"),
						"desc" => __("Default hyperlink colors.", "skeleton"),
						"id" => "link_color",
						"std" => "#3568A9",
						"type" => "color");

  $options[] = array( "name" => __("Main Body Typography", "skeleton"),
					"desc" => __("Body Typography.", "skeleton"),
					"id" => "body_typography",
					"std" => array('size' => '14px','face' => 'helvetica','style' => 'normal','color' => '#444444'),
					"type" => "typography");			

						
	$options[] = array( "name" => __("(H1) Heading Typography", "skeleton"),
						"desc" => __("Heading typography.", "skeleton"),
						"id" => "h1_typography",
						"std" => array('size' => '40px','face' => 'helvetica','style' => 'normal','color' => '#181818'),
						"type" => "typography");
  
  $options[] = array( "name" => __("(H2) Heading Typography", "skeleton"),
					"desc" => __("Heading Two typography.", "skeleton"),
					"id" => "h2_typography",
					"std" => array('size' => '35px','face' => 'helvetica','style' => 'normal','color' => '#181818'),
					"type" => "typography");			
				  

  $options[] = array( "name" => __("(H3) Heading Typography", "skeleton"),
					"desc" => __("Heading Three typography.", "skeleton"),
					"id" => "h3_typography",
					"std" => array('size' => '28px','face' => 'helvetica','style' => 'normal','color' => '#181818'),
					"type" => "typography");
	
	$options[] = array( "name" => __("(H4) Heading Typography", "skeleton"),
					"desc" => __("Heading Four typography.", "skeleton"),
					"id" => "h4_typography",
					"std" => array('size' => '21px','face' => 'helvetica','style' => 'bold','color' => '#181818'),
					"type" => "typography");			
	
 $options[] = array( "name" => __("(H5) Heading Typography", "skeleton"),
 				"desc" => __("Heading Five typography.", "skeleton"),
 				"id" => "h5_typography",
 				"std" => array('size' => '17px','face' => 'helvetica','style' => 'bold','color' => '#181818'),
 				"type" => "typography");			

  
  $options[] = array( "name" => __("Extra Header Text", "skeleton"),
						"desc" => __("HTML or text can be inserted into the header. You might add twitter icons, badges, or a site announcement here.", "skeleton"),
						"id" => "header_extra",
						"std" => "",
						"type" => "textarea"); 


	if ( class_exists( 'jigoshop' ) ) {
		$options[] = array( "name" => __("Display Cart", "skeleton"),
							"desc" => __("Jigoshop is installed. Would you like to show a mini cart here instead?", "skeleton"),
							"id" => "show_mini_cart",
							"type" => "checkbox");
	}

  
	$options[] = array( "name" => __("Footer Fine Print", "skeleton"),
						"desc" => __("HTML or text to be inserted into the very bottom after the widgets.", "skeleton"),
						"id" => "footer_text",
						"std" => "",
						"type" => "textarea"); 
						
	$options[] = array( "name" => __("Footer Scripts", "skeleton"),
						"desc" => __("Add custom footer scripts such as Google Analytics. Do not include the &lt;script&gt; tag. This is already done for you.", "skeleton"),
						"id" => "footer_scripts",
						"std" => "",
						"type" => "textarea");
		
	return $options;
}