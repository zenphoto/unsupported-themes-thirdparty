<?php if (!defined('WEBPATH')) die(); normalizeColumns(1, 7);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title><?php printGalleryTitle(); ?></title>
	<style type="text/css">
		@font-face {
			font-family: GraublauWeb;
			src: url('<?php echo $_zp_themeroot ?>/fonts/GraublauWeb.otf') format(truetype);
		}
		@font-face {
			font-family: GraublauWeb;
			font-weight: bold;
			src: url('<?php echo $_zp_themeroot ?>/fonts/GraublauWebBold.otf') format(truetype);
		}
	</style>
  	<link rel="stylesheet" href="<?php echo $_zp_themeroot ?>/zen.css" type="text/css" />
  	<?php printRSSHeaderLink('Gallery','Gallery RSS'); ?>
  	<?php zenJavascript(); ?>

</head>
<body id="galleryPage">

<!--
<div id="topCandy">
	<div id="candy" style="background-color: #F11805;">&nbsp;</div>
	<div id="candy" style="background-color: #EEEB7A;">&nbsp;</div>
	<div id="candy" style="background-color: #BFD109;">&nbsp;</div>
	<div id="candy" style="background-color: #52B5DE;">&nbsp;</div>
	<div id="candy" style="background-color: #006FBB;">&nbsp;</div>
</div>
-->

<div>
  	<div id="galleryTitle"><?php echo getGalleryTitle(); ?></div>
  
  	<hr />
  	<?php // printPageListWithNav("&laquo; prev", "next &raquo;"); ?>
  
  	<div id="albums">
  		<?php while (next_album()): ?>
  
   		<div id="album">
      		<div class="albumthumb">
            	<a href="<?php echo getAlbumLinkURL();?>" title="<?php echo getAlbumTitle();?>">
        			<?php printAlbumThumbImage(getAlbumTitle()); ?>
				</a>
            </div>
			<div id="albumDate"><?php printAlbumDate(); ?></div>
      		<div id="albumTitle">
            	<a href="<?php echo getAlbumLinkURL();?>" title="<?php echo getAlbumTitle();?>">
        			<?php printAlbumTitle(); ?>
				</a>
            </div>
      		<div id="albumDesc" name="albumDescName"><?php printAlbumDesc(); ?></div>
    	</div>
    
  		<?php endwhile; ?>
  	</div>
	
	<br clear="both" />
	
  	<?php printPageNav("&laquo; prev", "|", "next &raquo;"); ?>
  
  	<div id="credit"><?php printRSSLink('Gallery','','RSS', ''); ?> | Powered by <a href="http://www.zenphoto.org" title="A simpler web photo album">zenphoto</a> | <a href="?p=archive">Archive View</a></div>

</div>

<?php printAdminToolbox(); ?>

</body>
</html>
