<?php

/**
* @package Skeleton WordPress Theme Framework
* @subpackage skeleton
* @author Simple Themes - www.simplethemes.com
**/

global $wp_query;

// build the font stacks for re-use in CSS

function st_font_stack($face) {
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
	return apply_filters( 'st_font_stack', $face );
}


function importfonts() {

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
	$result = false;
	foreach ($headings as $key => $selector) {
		$item = $selector.'_typography';
		$property = of_get_option($item);
		$face[] = $property['face'];
		if (in_array("droidsans", $face) || in_array("droidserif", $face)) {
			$result = true;
		}
	}
	if ($result) {
		echo '@import url(http://fonts.googleapis.com/css?family=Droid+Sans:400,700|Droid+Serif:400,700);'."\n";
	}

}
importfonts();

// Typography

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

foreach ($headings as $key => $selector) {

		$item = $selector.'_typography';
		$property = of_get_option($item);
		$face = $property['face'];

		echo $key.' {';
		echo 'color:'.$property['color'].';';
		echo 'font-size:'.$property['size'].';';
		echo 'font-family:'.st_font_stack($face).';';
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
?>
a,a:link,a:visited,a:active,#content .gist .gist-file .gist-meta a:visited {color: <?php echo of_get_option('link_color', '#000' ); ?>;}
<?php
	$sidebar_position = of_get_option('page_layout');
	$content_position = ($sidebar_position == "right" ? "left" : "right");
	$sidebar_margin = ($sidebar_position == "right" ? "left" : "right");
?>
#wrap #content {float:<?php echo $content_position; ?>;}
#wrap #sidebar {float:<?php echo $sidebar_position; ?>;}
#wrap #sidebar .widget-container {margin-<?php echo $sidebar_margin; ?>: 20px;margin-<?php echo $sidebar_position; ?>: 0px;}
