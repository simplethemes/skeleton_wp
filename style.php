<?php
header("Content-type: text/css; charset: UTF-8");

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


// Begin theme options
?>
body {color: <?php echo of_get_option('example_colorpicker', '#000' ); ?>;}
a,a:link,a:visited,a:active,#content .gist .gist-file .gist-meta a:visited {color: <?php echo of_get_option('link_color', '#000' ); ?>;}

<?php
	$sidebar_position = of_get_option('page_layout');
	$content_position = ($sidebar_position == "right" ? "left" : "right");
	$sidebar_margin = ($sidebar_position == "right" ? "left" : "right");
?>
#wrap #content {float:<?php echo $content_position; ?>;}
#wrap #sidebar {float:<?php echo $sidebar_position; ?>;}
#wrap #sidebar .widget-container {margin-<?php echo $sidebar_margin; ?>: 20px;margin-<?php echo $sidebar_position; ?>: 0px;}
