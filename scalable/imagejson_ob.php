<?php

// needed to make the rating plugin load
//  OFFSET_PATH == 0 in <theme>/image.php however?!
define(OFFSET_PATH, 1);

require_once(dirname(__FILE__).'/../../zp-core/functions-basic.php');
require_once(dirname(__FILE__).'/../../zp-core/functions.php');
require_once(dirname(__FILE__).'/../../zp-core/template-functions.php');
require_once(dirname(__FILE__).'/../../zp-core/class-load.php');


$decoded = json_decode($_POST['data'], true);
$albumname = $decoded['album'];
$imageindex = $decoded['image'];

$gallery = new Gallery();
$album = new Album($gallery, $albumname);
$_zp_current_image = $album->getImage($imageindex);

$imagedata = array();

ob_start();
ob_implicit_flush(0);
printImageTitle(true);
# TODO: filter out <script> content
$imagedata['title'] = ob_get_contents();
ob_end_clean();

ob_start();
ob_implicit_flush(0);
printImageDesc(true);
$imagedata['desc'] = ob_get_contents();
ob_end_clean();

ob_start();
ob_implicit_flush(0);
printImageMetadata('', false);
$imagedata['exifdata'] = ob_get_contents();
ob_end_clean();

#ob_start();
#ob_implicit_flush(0);
#printTags('links', gettext('<strong>Tags:</strong>').' ', 'taglist', '');
#$imagedata['tags'] = ob_get_contents();
#ob_end_clean();


$imagedata['tags'] = $_zp_current_image->getTags();
$imagedata['fullimage'] = $_zp_current_image->getFullImage();
$imagedata['comments'] = $_zp_current_image->getComments();
$imagedata['plugins'] = getEnabledPlugins();
if (function_exists('getRating'))
	$imagedata['rating'] = getRating($_zp_current_image);

header("Content-type: text/plain");
die(json_encode($imagedata));
?>
