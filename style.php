<?php
if(extension_loaded('zlib')){ob_start('ob_gzhandler');}

header("Content-type: text/css; charset: UTF-8");
header("Cache-Control: must-revalidate");
$offset = 60 * 60 ;
$ExpStr = "Expires: " .
gmdate("D, d M Y H:i:s",
time() + $offset) . " GMT";
header($ExpStr);

// $absolute_path = __FILE__;
// $path_to_file = explode( 'wp-content', $absolute_path );
// $path_to_wp = $path_to_file[0];
// require_once( $path_to_wp.'/wp-load.php' );

// Declare CSS Font Stacks for reuse

$helvetica = '"HelveticaNeue", "Helvetica Neue", Helvetica, Arial, sans-serif';
$arial		 = 'Arial, Helvetica, sans-serif';
$georgia	 = 'Constantia, "Lucida Bright", Lucidabright, "Lucida Serif", Lucida, "DejaVu Serif", "Bitstream Vera Serif", "Liberation Serif", Georgia, serif';
$cambria	 = 'Cambria, "Hoefler Text", Utopia, "Liberation Serif", "Nimbus Roman No9 L Regular", Times, "Times New Roman", serif';
$tahoma		 = 'Tahoma, Verdana, Segoe, sans-serif';
$palatino	 = '"Palatino Linotype", Palatino, Baskerville, Georgia, serif';




// Begin theme options
$body_background = of_get_option('body_background');
$typography = of_get_option('body_typography');
// Main Body Styles
echo 'body {';
if ($typography) {
	if ($typography[face] == "helvetica") {
		$fontstack = $helvetica;
	} elseif ($typography[face] == "arial") {
		$fontstack = $arial;
	} elseif ($typography[face] == "georgia") {
		$fontstack = $georgia;
	} elseif ($typography[face] == "cambria") {
		$fontstack = $cambria;
	} elseif ($typography[face] == "tahoma") {
		$fontstack = $tahoma;
	} elseif ($typography[face] == "palatino") {
		$fontstack = $palatino;
	}
		echo 'color:'.$typography[color].';';
		echo 'font-size:'.$typography[size].';';
		echo 'font-family:'.$fontstack.';';
		echo 'font-weight:'.$typography[style].';';
		echo 'font-style:'.$typography[style].';';
	}
	
// Custom Background
		if ($body_background) {
				if ($body_background['image']) {
				echo 'background:'.$body_background[color].' url('.$body_background[image].') '.$body_background[repeat].' '.$body_background[position].' '.$body_background[scroll].'';
				} elseif ($body_background['color']) {
				echo 'background-color:'.$body_background[color].';';
				}
			}
// End Body Styles
echo '}';

// H1 Settings
$h1 = of_get_option('h1_typography');

echo 'h1 {';
if ($h1) {
	if ($h1[face] == "helvetica") {
		$fontstack = $helvetica;
	} elseif ($h1[face] == "arial") {
		$fontstack = $arial;
	} elseif ($h1[face] == "georgia") {
		$fontstack = $georgia;
	} elseif ($h1[face] == "cambria") {
		$fontstack = $cambria;
	} elseif ($h1[face] == "tahoma") {
		$fontstack = $tahoma;
	} elseif ($h1[face] == "palatino") {
		$fontstack = $palatino;
	}
		echo 'color:'.$h1[color].';';
		echo 'font-size:'.$h1[size].';';
		echo 'font-family:'.$fontstack.';';
		echo 'font-weight:'.$h1[style].';';
		echo 'font-style:'.$h1[style].';';
	}
	echo '}';
	
// H2 Settings
$h2 = of_get_option('h2_typography');

echo 'h2 {';
if ($h2) {
	if ($h2[face] == "helvetica") {
		$fontstack = $helvetica;
	} elseif ($h2[face] == "arial") {
		$fontstack = $arial;
	} elseif ($h2[face] == "georgia") {
		$fontstack = $georgia;
	} elseif ($h2[face] == "cambria") {
		$fontstack = $cambria;
	} elseif ($h2[face] == "tahoma") {
		$fontstack = $tahoma;
	} elseif ($h2[face] == "palatino") {
		$fontstack = $palatino;
	}
		echo 'color:'.$h2[color].';';
		echo 'font-size:'.$h2[size].';';
		echo 'font-family:'.$fontstack.';';
		echo 'font-weight:'.$h2[style].';';
		echo 'font-style:'.$h2[style].';';
	}
	echo '}';

// H3 Settings
$h3 = of_get_option('h3_typography');

echo 'h3 {';
if ($h3) {
	if ($h3[face] == "helvetica") {
		$fontstack = $helvetica;
	} elseif ($h3[face] == "arial") {
		$fontstack = $arial;
	} elseif ($h3[face] == "georgia") {
		$fontstack = $georgia;
	} elseif ($h3[face] == "cambria") {
		$fontstack = $cambria;
	} elseif ($h3[face] == "tahoma") {
		$fontstack = $tahoma;
	} elseif ($h3[face] == "palatino") {
		$fontstack = $palatino;
	}
		echo 'color:'.$h3[color].';';
		echo 'font-size:'.$h3[size].';';
		echo 'font-family:'.$fontstack.';';
		echo 'font-weight:'.$h3[style].';';
		echo 'font-style:'.$h3[style].';';
	}
	echo '}';
	
// H4 Settings
$h4 = of_get_option('h4_typography');

echo 'h4 {';
if ($h4) {
	if ($h4[face] == "helvetica") {
		$fontstack = $helvetica;
	} elseif ($h4[face] == "arial") {
		$fontstack = $arial;
	} elseif ($h4[face] == "georgia") {
		$fontstack = $georgia;
	} elseif ($h4[face] == "cambria") {
		$fontstack = $cambria;
	} elseif ($h4[face] == "tahoma") {
		$fontstack = $tahoma;
	} elseif ($h4[face] == "palatino") {
		$fontstack = $palatino;
	}
		echo 'color:'.$h4[color].';';
		echo 'font-size:'.$h4[size].';';
		echo 'font-family:'.$fontstack.';';
		echo 'font-weight:'.$h4[style].';';
		echo 'font-style:'.$h4[style].';';
	}
	echo '}';

// h5 Settings
$h5 = of_get_option('h5_typography');

echo 'h5 {';
if ($h5) {
	if ($h5[face] == "helvetica") {
		$fontstack = $helvetica;
	} elseif ($h5[face] == "arial") {
		$fontstack = $arial;
	} elseif ($h5[face] == "georgia") {
		$fontstack = $georgia;
	} elseif ($h5[face] == "cambria") {
		$fontstack = $cambria;
	} elseif ($h5[face] == "tahoma") {
		$fontstack = $tahoma;
	} elseif ($h5[face] == "palatino") {
		$fontstack = $palatino;
	}
		echo 'color:'.$h5[color].';';
		echo 'font-size:'.$h5[size].';';
		echo 'font-family:'.$fontstack.';';
		echo 'font-weight:'.$h5[style].';';
		echo 'font-style:'.$h5[style].';';
	}
	echo '}';
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
#site-title a {
	color: <?php echo of_get_option('header_color');?>;
}

<?php
if(extension_loaded('zlib')){ob_end_flush();}
?>