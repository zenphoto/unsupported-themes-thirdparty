<?php

// the themes location is similar to the plugins location (2 deep)
// * needed to make getImageLink report the correct URL
// * needed to make the rating plugin load
define(OFFSET_PATH, 3);

require_once(dirname(__FILE__).'/../../zp-core/functions-basic.php');
require_once(dirname(__FILE__).'/../../zp-core/functions.php');
//require_once(dirname(__FILE__).'/../../zp-core/template-functions.php');
require_once(dirname(__FILE__).'/../../zp-core/class-load.php');


$decoded = json_decode($_POST['data'], true);
$albumname = $decoded['album'];
$imageindex = $decoded['image'];

$gallery = new Gallery();
$album = new Album($gallery, $albumname);
$image = $album->getImage($imageindex);

$imagedata = array();

$imagedata['link'] = $image->getImageLink();
$imagedata['title'] = $image->getTitle();
$imagedata['desc'] = $image->getDesc();
$imagedata['exifdata'] = $image->getExifData();
$imagedata['tags'] = $image->getTags();
$imagedata['fullimage'] = $image->getFullImage();
$imagedata['comments'] = $image->getComments();
//$imagedata['plugins'] = getEnabledPlugins();
if (function_exists('getRating'))
	$imagedata['rating'] = getRating($image);

header("Content-type: text/plain");
die(json_encode($imagedata));
?>
