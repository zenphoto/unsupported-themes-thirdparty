<?php if (!defined('WEBPATH')) die(); $themeResult = getTheme($zenCSS, $themeColor, 'dark');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/2002/REC-xhtml1-20020801/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo getMainSiteName()?> | <?php printGalleryTitle(); ?> | <?php echo getAlbumTitle();?></title>
	<link rel="stylesheet" href="<?php echo $zenCSS ?>" type="text/css" />
	<?php printRSSHeaderLink('Album',getAlbumTitle()); ?>
	<?php zenJavascript(); ?>
<?php if( getNumImages()>1 ){ ?>
	<script type="text/javascript"src="<?php echo FULLWEBPATH . "/" . ZENFOLDER ?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo $_zp_themeroot ?>/jquery.silhouette.js"></script>
	<script type="text/javascript">
//<![CDATA[
		$(document).ready(function(){
			$("#container").silhouette( {img_padding_right: 10 });
		});
//]]>
	</script>
<?php } ?><?php printGoogleAnalytics($themeResult); ?>
</head>
<body>
<div id="titlebar">
	<div id="site">
		<h1><a href="<?php echo getMainSiteURL()?>" title="<?php echo getMainSiteName()?>"><?php echo getMainSiteName()?></a></h1>
	</div>
	<div id="navmenu">
<?php printTitleMenu($themeResult); ?>	</div>
	<div id="navbreadcrumb">
		<h3>&nbsp;&gt; <a href="<?php echo getGalleryIndexURL();?>" title="Albums Index"><?php echo getGalleryTitle();?></a><?php printParentBreadcrumb(" &gt; "," &gt; "," &gt; "); ?> <?php printAlbumTitle(true);?></h3>
	</div>
</div>
<div id="main" class="clearboth">
<?php if( getNumImages()==0 ){ ?>
	<div id="albums">
		<?php while (next_album()): ?>
		<div class="album">
			<div class="thumb">
				<a href="<?php echo getAlbumLinkURL();?>" title="View album: <?php echo getAlbumTitle();?>"><?php printAlbumThumbImage(getAlbumTitle()); ?></a>
			</div>
			<div class="albumdesc">
				<h3><a href="<?php echo getAlbumLinkURL();?>" title="View album: <?php echo getAlbumTitle();?>"><?php printAlbumTitle(); ?></a></h3>
				<p><?php printAlbumDesc(); ?><br/>(<?php echo getNumImages();?> images)</p>
			</div>
		</div>
		<?php endwhile; ?>
	</div>
<?php }else{ ?>
	<div id="container">
		<ul>
			<?php while (next_image(false, $firstPageImages)): ?>
			<?php
				$title = "file/title: " . getImageTitle();
				if( count(getTags()) > 0 ){
					$title .= ", tags: ".implode(", ",getTags());
				}
			?>
			<li><a href="<?php echo getValidProtectedImageURL();?>" title="<?php echo $title;?>"><?php printImageThumb($title); ?></a></li>
			<?php endwhile; ?>
		</ul>
	</div>
<?php } ?>
	<br class="clearboth"/>
</div>
<div id="credit"><?php printRSSLink('Album', '', 'Album RSS', ''); ?> | Powered by <a href="http://www.zenphoto.org" title="A simpler web photo album">zenphoto</a></div>
<?php printAdminToolbox(); ?>
</body>
</html>