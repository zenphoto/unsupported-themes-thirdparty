<?php if (!defined('WEBPATH')) die(); ?>
<?php header('Last-Modified: ' . gmdate('d M Y H:i:s').' GMT'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php zenJavascript(); ?>
	<title>About -- <?php echo getBareGalleryTitle(); ?></title>
	<meta http-equiv="content-type" content="text/html; charset=<?php echo getOption('charset'); ?>" />
	<link rel="shortcut icon" href="<?= $_zp_themeroot ?>/images/icon.png" />
	<link rel="stylesheet" href="<?= $_zp_themeroot ?>/style.css" type="text/css" />
	<?php printRSSHeaderLink('Gallery',gettext('Gallery RSS')); ?>
</head>

<body>
<div id="framework">

	<div id="main">

	<div id="path">
	<div class="left"><h1><a href="<?=getGalleryIndexURL();?>"><?php printGalleryTitle(); ?></a></h1> &raquo; <h2><strong>About</strong></h2></div>
	<div class="right">here you can learn more about me</div>
	</div><!-- #path -->

	More info about me coming soon. Stay tuned!

	</div><!-- #main -->

	<div id="menu">
	<div id="pages"><a href="<?=getGalleryIndexURL();?>" title="Homepage">Home</a> <span class="current">About</span> <a href="<?=getGalleryIndexURL();?>page/archive/" title="View Archives">Archive</a></div>
	</div><!-- #menu -->

	<div id="additional"><div id="information">
<table width="100%" border="0" cellpadding="0" cellspacing="4">
  <tr>
    <td align="center" class="logo"><a href="<?=getGalleryIndexURL();?>"><img src="<?= $_zp_themeroot ?>/images/logo.png"></a></td>
  </tr>
  <tr>
    <td bgcolor="#111214" class="author"><span class="info">Enough for me, now start with my <a href="<?=getGalleryIndexURL();?>">photos</a> ;)</span></td>
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