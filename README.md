#Skeleton WordPress Theme

For new installations, you may wish to install the [latest stable version from wordpress.org](http://wordpress.org/themes/smpl-skeleton).

__Notice: Before updating Skeleton, please see the notes below as there are three branches to consider.__

* For latest development version, please use the [master ](https://github.com/simplethemes/skeleton_wp/tree/master) branch. 

* If you're updating from Skeleton 1.x, please update from the [1.x branch](https://github.com/simplethemes/skeleton_wp/tree/1.x).

* If you're updating from Skeleton 2.0.x, please update from the [2.x-options-framework ](https://github.com/simplethemes/skeleton_wp/tree/2.x-options-framework) branch.


Why? As of version 2.1.x, the options formerly located within the Options Framework (under Appearance &rarr; Theme Options) have been moved to the native WP theme customizer to allow for acceptance into the WP.org theme repository. If you'd prefer to continue using the Options framework, please switch to the the [2.x-options-framework](https://github.com/simplethemes/skeleton_wp/tree/2.x-options-framework) branch. See additional notes regarding shortcodes below.


##About

Skeleton, authored by Casey Lee at [Simple Themes](http://www.simplethemes.com "WordPress Themes") is a simple, responsive WordPress theme based on the Skeleton Boilerplate.
It has several useful shortcodes, such as tabs, toggles, cross-browser CSS3 buttons, and layout columns.


**Live Demo**: [themes.simplethemes.com/skeleton](http://themes.simplethemes.com/skeleton "Skeleton WordPress Theme Demo")


## Installation & Basic Setup
To install Skeleton, you should unzip the package locally, then upload the **smpl_skeleton** folder to your WP site (via FTP):

It is highly recommended to use a child theme so you don't lose changes.

An example child theme is included in the package in the **skeleton_childtheme** folder.

Your final directory structure should be:

**wp-content/themes/smpl_skeleton**
 
**wp-content/themes/skeleton_childtheme**


Activate **skeleton_childtheme** from Appearance > Themes and enjoy. 

You can configure the options from Appearance &rarr; Theme Options.

If you need to customize any of theme options, copy the parent theme options.php to your child theme directory.

To override any of the parent theme functions, just copy the function(s) from the parent theme into your child theme's functions.php file.
Skeleton will always give priority to the child theme.

##Shortcodes

Because Skeleton is now [hosted in the wordpress.org theme repository](http://wordpress.org/themes/smpl-skeleton), Skeleton's shortcodes and additional styles are considered "plugin territory" and therefore must be installed separately in order to work properly. If you're using Skeleton and would like to take advantage of these shortcodes within the theme, please [download and install the smpl-shortcodes plugin](http://wordpress.org/plugins/smpl-shortcodes/). You can the shortcodes in action on the [shortcodes demo page](http://demos.simplethemes.com/skeleton/documentation).

###Callouts

A callout is (by default) a rounded cornered styled inset box. It has two arguments:

* **align** - aligns the callout left, right, or center
* **width** - Only use this parameter if you must. Defined widths will not scale properly on all devices. Instead, consider embedding them in one of the column shortcodes.

<!---->

	[callout align="center" width="75%"]
	This is a 75% centered callout box
	[/callout]
	
	[callout align="left" width="300px"]
	This is a 300px left aligned callout box
	[/callout]
	
	[callout align="right" width="400px" title="Callout Title"]
	This is a 400px right aligned callout box with title
	[/callout]
	
	[callout title="Callout Title"]
	This is a callout with title and will expand the entire width of its parent container.
	[/callout]

----

###Fluid Columns

You've seen these before. The fractional shortcode combinations allow you to insert scalable columns into your content. The only rule here is, the last column must have a suffix of '_last'. See the example below.

	// Three Columns Example
	[one_third]
	Column One - Add anything you want here
	[/one_third]
	
	[one_third]
	Column Two - Add anything you want here
	[/one_third]
	
	[one_third_last]
	Column Three - Add anything you want here
	[/one_third_last]
	
Available Options – Up to 6 columns

* one_third
* two_thirds
* one_half
* one_fourth
* three_fourths
* one_fifth
* two_fifth
* three_fifth
* four_fifth
* one_sixth
* five_sixth

----

###Cross-Browser CSS3 Buttons
Tested in IE7,IE8,IE9,Webkit, and Mozilla browsers.
[Preview all colors and sizes](http://demos.simplethemes.com/skeleton/button-styles)

	[button align="center" color="white" size="small" link="http://www.simplethemes.com"]Small Button[/button]

----

###Tabs
You can create tabs content within your content as well. Each tab needs a unique id (identifier) in order to work.

[See a preview of the tabs in action here](http://demos.simplethemes.com/skeleton/documentation#t1Tab)

	[tabgroup]
	[tab title="Tab 1" id="t1"]Tab 1 content[/tab]
	[tab title="Tab 2" id="t2"]Tab 2 content[/tab]
	[tab title="Tab 3" id="t3"]Tab 3 content[/tab]
	[/tabgroup]

----

###Accordion Toggles
[See them in action here.](http://demos.simplethemes.com/skeleton/documentation#gist-1142632)

	[toggle title="Button text One"]
	Toggle Content One
	[/toggle]
	
	[toggle title="Button Text Two"]
	Toggle Content Two
	[/toggle]
	
	[toggle title="Button Text Three"]
	Toggle Content Three
	[/toggle]

----

###Latest Posts

Insert a list of your latest posts from specified category(s) into any page with optional thumbnail and excerpt.

	[latest excerpt="true" thumbs="true" width="50" height="50" num="5" cat="8,10,11"]
	
----

###Related Posts

Insert a list of related (tagged) posts.

	[related_posts]

----

###Raw HTML

Sometimes the WordPress editor will strip out your more advanced markup. This can be a real drag. By wrapping your code in [raw] tags, you can eliminate this issue.

	[raw] YOUR SAFE HTML CODE [/raw]

----

###Clearing

If you ever need to clear an element, you can use the “clear” shortcode below.

	[clear]

----

###Clear with Horizontal line:

Similar to “clear”, this does the same thing but adds a horizontal line below.

	[clearline]

----

##Layout Customization Hooks

You can find a list of these functions in the top of the functions.php file:

* __skeleton_above_header__ // Hook to add content before header
* __skeleton_header__ // Opening header tag and logo/header text
* __skeleton_header_extras__ // Additional content may be added to the header
* __skeleton_below_header__ // Hook to add content after header
* __skeleton_navbar__ // Opening navigation element and WP3 menus
* __skeleton_before_content__ // Opening content wrapper
* __skeleton_after_content__ // Closing content wrapper
* __skeleton_before_sidebar__ // Opening sidebar wrapper
* __skeleton_after_sidebar__ // Closing sidebar wrapper
* __skeleton_before_footer__ // Opening footer wrapper
* __skeleton_footer__ // The footer (includes sidebar-footer.php)
* __skeleton_after_footer__ // The closing footer wrapper
