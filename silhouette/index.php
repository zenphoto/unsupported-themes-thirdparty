<?php if (!defined('WEBPATH')) die(); $themeResult = getTheme($zenCSS, $themeColor, 'dark');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/2002/REC-xhtml1-20020801/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo getMainSiteName()?> | <?php printGalleryTitle(); ?></title>
	<link rel="stylesheet" href="<?php echo $zenCSS ?>" type="text/css" />
	<?php printRSSHeaderLink('Gallery','Gallery RSS'); ?>
	<?php zenJavascript(); ?>
<?php printGoogleAnalytics($themeResult); ?>
</head>
<body>
<div id="titlebar">
	<div id="site">
		<h1><a href="<?php echo getMainSiteURL()?>" title="<?php echo getMainSiteName()?>"><?php echo getMainSiteName()?></a></h1>
	</div>
	<div id="navmenu">
<?php printTitleMenu($themeResult); ?>
	</div>
	<div id="navbreadcrumb">
		<h3>&nbsp;&gt; <?php echo getGalleryTitle();?></h3>
	</div>
</div>
<div id="main" class="clearboth">
	<div id="albums">
		<?php while (next_album()): ?>
		<div class="album">
			<div class="thumb">
				<a href="<?php echo getAlbumLinkURL();?>" title="View album: <?php echo getAlbumTitle();?>"><?php printAlbumThumbImage(getAlbumTitle()); ?></a>
			</div>
			<div class="albumdesc">
				<h3><a href="<?php echo getAlbumLinkURL();?>" title="View album: <?php echo getAlbumTitle();?>"><?php printAlbumTitle(); ?></a></h3>
				<p><?php printAlbumDesc(); ?><br/>(<?php echo getNumAlbums();?> albums)</p>
			</div>
		</div>
		<?php endwhile; ?>
	</div>
<br class="clearboth"/>
</div>
<div id="credit"><?php printRSSLink('Gallery','','Gallery RSS', ''); ?> | Powered by <a href="http://www.zenphoto.org" title="A simpler web photo album">zenphoto</a></div>
<?php printAdminToolbox(); ?>
</body>
</html>