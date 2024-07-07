<?php if (!defined('WEBPATH')) die(); $firstPageImages = normalizeColumns('5', '5'); ?>
<?php include ('theme-functions.php'); ?>
<?php header('Last-Modified: ' . gmdate('d M Y H:i:s').' GMT'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php zenJavascript(); ?>
	<title><?php echo getBareAlbumTitle();?> -- <?php echo getBareGalleryTitle();?></title>
	<meta http-equiv="content-type" content="text/html; charset=<?php echo getOption('charset'); ?>" />
	<link rel="shortcut icon" href="<?= $_zp_themeroot ?>/images/icon.png" />
	<link rel="stylesheet" href="<?= $_zp_themeroot ?>/style.css" type="text/css" />
	<?php printRSSHeaderLink('Album',getAlbumTitle()); ?>
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
	<div class="left"><h1><a href="<?=getGalleryIndexURL();?>"><?php printGalleryTitle(); ?></a></h1> &raquo; <?php printParentBreadcrumb('', '', ' &raquo; '); ?><h2><strong><?php printAlbumTitle(true);?></strong></h2></div>
	<div class="right">use keyboard's arrow <img src="<?= $_zp_themeroot ?>/images/arrow-l.png" title="left arrow for previous page" align="absmiddle"><img src="<?= $_zp_themeroot ?>/images/arrow-r.png" title="right arrow for next page" align="absmiddle"> keys to navigate</div>
	</div><!-- #path -->

	<div id="desc-album">
	<?php printAlbumDesc(); ?>
	<?php if (function_exists('printSlideShowLink')) printSlideShowLink(gettext(' View Slideshow?')); ?>
	<?php printTags('links', gettext('<br>// tags: '), 'taglist', '; '); ?>
	</div>

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

	<div id="images">
		<?php while (next_image(false, $firstPageImages)): ?>
		<div class="image">
			<a href="<?=getImageLinkURL();?>" title="<?php echo getBareImageTitle();?>"><?php printImageThumb(getAnnotatedImageTitle()); ?></a>
		</div>
		<?php endwhile; ?>
	</div><!-- #images -->

	<div id="nav"><?php printPageListWithNav("&laquo; ".gettext("prev"), gettext("next")." &raquo;"); ?></div>

	</div><!-- #main -->

	<div id="menu">
	<div id="pages"><a href="<?=getGalleryIndexURL();?>" title="Homepage">Home</a> <a href="<?=getGalleryIndexURL();?>page/about/" title="About Me">About</a> <a href="<?=getGalleryIndexURL();?>page/archive/" title="View Archives">Archive</a></div>
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
    <td bgcolor="#1E2021" class="license"><strong>License</strong>: Except where otherwise noted, the photos on this site are licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/" title="Attribution-Noncommercial-Share Alike 3.0 license">Creative Commons License</a>.</td>
  </tr>
  <tr>
    <td bgcolor="#1E2021" class="stuff"><strong>Stuff</strong>: <a title="RSS Feed" href="<?=getGalleryIndexURL();?>rss.php">RSS <img src="<?= $_zp_themeroot ?>/images/rss.png" alt="RSS Feed" /></a> / <a title="RSS Feed" href="<?=getGalleryIndexURL();?>rss.php?albumtitle=<?php echo getAlbumTitle();?>">Album's RSS <img src="<?= $_zp_themeroot ?>/images/rss.png" alt="RSS Feed of this Album" /></a> <?php if (getOption('Allow_search')) { printSearchForm(); } ?></td>
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