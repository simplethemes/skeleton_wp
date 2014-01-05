#Skeleton WordPress Theme

##About

[Documentation & Overview](http://simplethemes.com/wordpress-themes/theme/skeleton)
<br />
[Skeleton WordPress Theme Demo](http://themes.simplethemes.com/skeleton)

##Shortcodes

Skeleton has several built in shortcodes. You can see them in action on the [shortcodes demo page](http://demos.simplethemes.com/skeleton/documentation).

####Callout Dialogs

A callout is (by default) a rounded cornered styled inset box. It has two arguments:

* **title** - adds a title to the callout
* **align** - aligns the callout left, right, or center
* **width** - any valid CSS property (e.g; 50% or 100px)

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

####Fluid Columns

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

####Cross-Browser CSS3 Buttons
Tested in IE7,IE8,IE9,Webkit, and Mozilla browsers.
[Preview all colors and sizes](http://themes.simplethemes.com/skeleton/button-styles)

	[button align="center" color="white" size="small" link="http://www.simplethemes.com"]Small Button[/button]

----

####Tabs
You can create tabs content within your content as well. Each tab needs a unique id (identifier) in order to work.

[See a preview of the tabs in action here](http://themes.simplethemes.com/skeleton/documentation#t1Tab)

	[tabgroup]
	[tab title="Tab 1" id="t1"]Tab 1 content[/tab]
	[tab title="Tab 2" id="t2"]Tab 2 content[/tab]
	[tab title="Tab 3" id="t3"]Tab 3 content[/tab]
	[/tabgroup]

----

####Accordion Toggles
[See them in action here.](http://themes.simplethemes.com/skeleton/documentation#gist-1142632)

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

####Latest Posts

Insert a list of your latest posts from specified category(s) into any page with optional thumbnail and excerpt.

	[latest excerpt="true" thumbs="true" width="50" height="50" num="5" cat="8,10,11"]

----

####Related Posts

Insert a list of related (tagged) posts.

	[related_posts]

----

####Content Formatting

If you find the WordPress editor is stripping out your markup or adding unwanted P tags, you can eliminate this by disabling wpautop on a Page or Post basis.

Create a custom field named __wpautop__ with a value of __false__.

----

####Clearing

If you ever need to clear an element, you can use the “clear” shortcode below.

	[clear]

----

####Clear with Horizontal line:

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
