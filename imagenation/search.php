<?php if (!defined('WEBPATH')) die(); $firstPageImages = normalizeColumns('5', '5'); ?>
<?php include ('theme-functions.php'); ?>
<?php header('Last-Modified: ' . gmdate('d M Y H:i:s').' GMT'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php zenJavascript(); ?>
	<title>Search -- <?php echo getBareGalleryTitle(); ?></title>
	<meta http-equiv="content-type" content="text/html; charset=<?php echo getOption('charset'); ?>" />
	<link rel="shortcut icon" href="<?= $_zp_themeroot ?>/images/icon.png" />
	<link rel="stylesheet" href="<?= $_zp_themeroot ?>/style.css" type="text/css" />
	<?php printRSSHeaderLink('Gallery',gettext('Gallery RSS')); ?>
</head>

<body>
<div id="framework">

	<div id="main">

	<div id="menu">
	<div id="pages"><a href="<?=getGalleryIndexURL();?>" title="Homepage">Home</a> <a href="<?=getGalleryIndexURL();?>page/about/" title="About Me">About</a> <a href="<?=getGalleryIndexURL();?>page/archive/" title="View Archives">Archive</a></div>
	</div><!-- #menu -->

	<div id="path">
	<div class="left"><h1><a href="<?=getGalleryIndexURL();?>"><?php printGalleryTitle(); ?></a></h1> &raquo; <h2><strong>Search</strong></h2></div>
	<div class="right"><?php if (getOption('Allow_search')) { printSearchForm(); } ?></div>
	</div><!-- #path -->

	<div id="desc-album">Search the site.</div>

	<?php
	if (($total = getNumImages() + getNumAlbums()) > 0) {
		if (isset($_REQUEST['date'])){
			$searchwords = getSearchDate();
 	} else { $searchwords = getSearchWords(); }
		echo "<p class='results'>".sprintf(gettext('Total matches for &ldquo;<strong>%1$s</strong>&rdquo;: %2$u'), $searchwords, $total)."</p>";
	}
	$c = 0;
	?>

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
		<?php while (next_image(false, $firstPageImages)): $c++;?>
		<div class="image">
			<a href="<?=getImageLinkURL();?>" title="<?php echo getBareImageTitle();?>"><?php printImageThumb(getAnnotatedImageTitle()); ?></a>
		</div>
		<?php endwhile; ?>
	</div><!-- #images -->

	<?php if ($c == 0) { echo "<p class='results'>".gettext("Sorry, no image matches found. Try refining your search.")."</p>"; } ?>

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
    <td bgcolor="#1E2021" class="stuff"><strong>Stuff</strong>: <a title="RSS Feed" href="<?=getGalleryIndexURL();?>rss.php">RSS <img src="<?= $_zp_themeroot ?>/images/rss.png" alt="RSS Feed" /></a></td>
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