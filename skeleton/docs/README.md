#Skeleton WordPress Theme

##About

**Live Demo**: [themes.simplethemes.com/skeleton](http://themes.simplethemes.com/skeleton "Skeleton WordPress Theme Demo")


Skeleton, authored by Casey Lee at [Simple Themes](http://www.simplethemes.com "WordPress Themes") is a simple, responsive WordPress theme based on the Skeleton Boilerplate.
It has several useful shortcodes, such as tabs, toggles, cross-browser CSS3 buttons, and layout columns.

Special thanks to the following people/sites for code and inspiration:
 
* [Skeleton Responsive Boilerplate](http://www.getskeleton.com/) // Responsive Layout Framework by Dave Gamache
* [Theme Options Framework](http://wptheming.com/options-framework-plugin/) // Powerful Customizeable Theme Options by Devin Price
* [Thematic Framework](http://themeshaper.com/thematic/) // Code Inspiration and learning - Ian Stewart
* [Formalize](https://github.com/nathansmith/formalize) // Better forms styling - Nathan Smith
* TwentyTen Theme // Default WordPress Loops


## Installation & Basic Setup
To install Skeleton, you should unzip the package you downloaded from here locally, then upload the folders within to your WP site (via FTP) with the following directory structure:

**wp-content/themes/skeleton**
and
**wp-content/themes/skeleton_childtheme**

Next, activate the **child theme** from Appearance > Themes. 

You can configure its options from Appearance &rarr; Theme Options.

If you need to customize any of theme options, copy the parent theme options.php to your child theme directory.
To override any of the parent theme functions, just copy the function(s) from the parent theme into your child theme's functions.php file.
Skeleton will always give priority to the child theme.

##Shortcodes

Skeleton has several built in shortcodes. You can see them in action on the [shortcodes demo page](http://demos.simplethemes.com/skeleton/documentation).

###Callouts

A callout is (by default) a rounded cornered styled inset box. It has two arguments:

* **align** - aligns the callout left, right, or center
* **width** - Only use this parameter if you must. Defined widths will not scale properly on all devices. Instead, consider embedding them in one of the column shortcodes.

<!---->

	[callout align="center" width="400"]
	This is a 400px centered callout box
	[/callout]
	
	[callout align="left" width="200"]
	This is a 200px left aligned callout box
	[/callout]
	
	[callout align="right" width="100"]
	This is a 100px right aligned callout box
	[/callout]
	
	[callout]
	This is a callout that will expand the entire width of its parent container.
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

* __st_above_header__ // Hook to add content before header
* __st_header__ // Opening header tag and logo/header text
* __st_header_extras__ // Additional content may be added to the header
* __st_below_header__ // Hook to add content after header
* __st_navbar__ // Opening navigation element and WP3 menus
* __st_before_content__ // Opening content wrapper
* __st_after_content__ // Closing content wrapper
* __st_before_sidebar__ // Opening sidebar wrapper
* __st_after_sidebar__ // Closing sidebar wrapper
* __st_before_footer__ // Opening footer wrapper
* __st_footer__ // The footer (includes sidebar-footer.php)
* __st_after_footer__ // The closing footer wrapper
