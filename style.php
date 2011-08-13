<?php
if(extension_loaded('zlib')){ob_start('ob_gzhandler');}
header("Content-type: text/css");

//get the last-modified-date of this very file
$lastModified=filemtime(__FILE__);
//get a unique hash of this file (etag)
$etagFile = md5_file(__FILE__);
//get the HTTP_IF_MODIFIED_SINCE header if set
$ifModifiedSince=(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false);
//get the HTTP_IF_NONE_MATCH header if set (etag: unique file hash)
$etagHeader=(isset($_SERVER['HTTP_IF_NONE_MATCH']) ? trim($_SERVER['HTTP_IF_NONE_MATCH']) : false);

//set last-modified header
header("Last-Modified: ".gmdate("D, d M Y H:i:s", $lastModified)." GMT");
//set etag-header
header("Etag: $etagFile");
//make sure caching is turned on
header('Cache-Control: public');

//check if page has changed. If not, send 304 and exit
if (@strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE'])==$lastModified || $etagHeader == $etagFile)
{
       header("HTTP/1.1 304 Not Modified");
       exit;
}

// Declare CSS Font Stacks for reuse

$helvetica = '"HelveticaNeue", "Helvetica Neue", Helvetica, Arial, sans-serif';
$arial		 = 'Arial, Helvetica, sans-serif';
$georgia	 = 'Constantia, "Lucida Bright", Lucidabright, "Lucida Serif", Lucida, "DejaVu Serif", "Bitstream Vera Serif", "Liberation Serif", Georgia, serif';
$cambria	 = 'Cambria, "Hoefler Text", Utopia, "Liberation Serif", "Nimbus Roman No9 L Regular", Times, "Times New Roman", serif';
$tahoma		 = 'Tahoma, Verdana, Segoe, sans-serif';
$palatino	 = '"Palatino Linotype", Palatino, Palladio, "URW Palladio L", "Book Antiqua", Baskerville, "Bookman Old Style", "Bitstream Charter", "Nimbus Roman No9 L", Garamond, "Apple Garamond", "ITC Garamond Narrow", "New Century Schoolbook", "Century Schoolbook", "Century Schoolbook L", Georgia, serif';


// Begin theme options
$background = of_get_option('example_background');
$typography = of_get_option('example_typography');

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
		if ($background) {
				if ($background['image']) {
				echo 'background:'.$background[color].' url('.$background[image].') '.$background[repeat].' '.$background[position].' '.$background[scroll].'';
				} elseif ($background['color']) {
				echo 'background-color:'.$background[color].';';
				}
			}
// End Body Styles
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
<?php
if(extension_loaded('zlib')){ob_end_flush();}
?>