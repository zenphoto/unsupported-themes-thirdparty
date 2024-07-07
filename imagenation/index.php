<?php if (!defined('WEBPATH')) die(); ?>
<?php include ('theme-functions.php'); ?>
<?php header('Last-Modified: ' . gmdate('d M Y H:i:s').' GMT'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php zenJavascript(); ?>
	<title><?php echo getBareGalleryTitle(); ?></title>
	<meta http-equiv="content-type" content="text/html; charset=<?php echo getOption('charset'); ?>" />
	<link rel="shortcut icon" href="<?= $_zp_themeroot ?>/images/icon.png" />
	<link rel="stylesheet" href="<?= $_zp_themeroot ?>/style.css" type="text/css" />
	<?php printRSSHeaderLink('Gallery',gettext('Gallery RSS')); ?>
	<script type="text/javascript">
	<!-- Navigation between images using arrow keys.
	var ua = navigator.userAgent;
	var opera = /opera [56789]|opera\/[56789]/i.test(ua);
	var ie = !opera && /msie [56789]/i.test(ua);
	var moz = !opera && /mozilla\/[56789]/i.test(ua);
	  <?php if (hasNextPage()) { ?>var nextURL="<?=getNextPageURL();?>";<?php } ?>
	  <?php if (hasPrevPage()) { ?>var prevURL="<?=getPrevPageURL();?>";<?php } ?>
	  function keyDown(e){
		if (!ie) {var keyCode=e.which;}
		if (ie) {var keyCode=event.keyCode;}
		if(keyCode==39){<?php if (hasNextPage()) { ?>window.location=nextURL<?php } ?>};
		if(keyCode==37){<?php if (hasPrevPage()) { ?>window.location=prevURL<?php } ?>};}
		document.onkeydown = keyDown;
		if (!ie)document.captureEvents(Event.KEYDOWN);
	-->
	</script>
</head>

<body>
<div id="framework">

	<div id="main">

	<div id="path">
	<div class="left"><h1><a href="<?=getGalleryIndexURL();?>"><?php printGalleryTitle(); ?></a></h1> &ndash; <?=getGalleryDesc();?></div>
	<div class="right">pick an album and start the journey...</div>
	</div><!-- #path -->

	<div id="latestphotos">
	<div class="text">LATEST<br>photos &raquo;</div>
	<div class="photos"><?php printLatestImages(6,'', $false, false, false, 40,'',90,60,true);?></div>
	</div><!-- #latestphotos -->

	<div id="albums">
		<?php while (next_album()): ?>
			<a href="<?=getAlbumLinkURL();?>" title="&laquo;<?=getAnnotatedAlbumTitle();?>&raquo; gallery">
				<?php printAlbumThumbImage(getAnnotatedAlbumTitle()); ?>
				<span class="num"><?=getNumImages();?> photos, <?=getNumAlbums();?> albums</span>
				<h3><?php echo getAnnotatedAlbumTitle();?></h3>
				<span class="description"><?php printAlbumDescAlt(); ?></span>
			</a>
		<?php endwhile; ?>
	</div><!-- #albums -->

	<div id="nav"><?php printPageListWithNav("&laquo; ".gettext("prev"), gettext("next")." &raquo;"); ?></div>

	</div><!-- #main -->

	<div id="menu">
	<div id="pages"><span class="current">Home</span> <a href="<?=getGalleryIndexURL();?>page/about/" title="About Me">About</a> <a href="<?=getGalleryIndexURL();?>page/archive/" title="View Archives">Archive</a></div>
	</div><!-- #menu -->

	<div id="additional"><div id="information">
<table width="100%" border="0" cellpadding="0" cellspacing="4">
  <tr>
    <td align="center" class="logo"><a href="<?=getGalleryIndexURL();?>"><img src="<?= $_zp_themeroot ?>/images/logo.png"></a></td>
  </tr>
  <tr>
    <td bgcolor="#111214" class="author"><strong>Behind the Lens</strong>: <a href="<?=getGalleryIndexURL();?>page/about/"><strong>YourName</strong></a>.<span class="space"><br>&nbsp;<br></span><span class="info">Welcome, and hope you enjoy my gallery! You can find more info about me, or just get in touch at the <a href="<?=getGalleryIndexURL();?>page/about#about">about</a> page.</span></td>
  </tr>
  <tr>
    <td bgcolor="#1E2021" class="contents"><strong>Contents</strong>: <?php $photosArray = query_single_row("SELECT count(*) FROM ".prefix('images')); $photosNumber = array_shift($photosArray); echo $photosNumber ?> photos in <?php $albumNumber = getNumAlbums(); echo $albumNumber ?> main albums; <?php $commentsArray = query_single_row("SELECT count(*) FROM ".prefix('comments')." WHERE inmoderation = 0"); $commentsNumber = array_shift($commentsArray); echo $commentsNumber ?> comments so far.</td>
  </tr>
  <tr>
    <td bgcolor="#1E2021" class="license"><strong>License</strong>: Except where otherwise noted, the photos on this site are licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/" title="Attribution-Noncommercial-Share Alike 3.0 license">Creative Commons License</a>.</td>
  </tr>
  <tr>
    <td bgcolor="#1E2021" class="stuff"><strong>Stuff</strong>: <a title="RSS Feed" href="<?=getGalleryIndexURL();?>rss.php">RSS <img src="<?= $_zp_themeroot ?>/images/rss.png" alt="RSS Feed" /></a> <?php if (getOption('Allow_search')) { printSearchForm(); } ?></td>
  </tr>
  <tr>
    <td bgcolor="#191B1C" align="center" class="powered"><a href="http://photo-imagenation.com" title="Zenphoto theme">Imagenation</a> is a theme for <a href="http://www.zenphoto.org/" title="A simpler web photo album">Zenphoto</a><br>
Powe<font color="#F82415">red</font> by <a href="http://chereshka.net/" title="Design & SEO">Chereshka</a> & <a href="http://easynetdesign.com/" title="Design is Easy.">Easy Design</a></td>
  </tr>
</table>
	</div></div><!-- #additional #information -->

</div><!-- #framework -->

<?php printAdminToolbox(); ?>

</body>
</html>