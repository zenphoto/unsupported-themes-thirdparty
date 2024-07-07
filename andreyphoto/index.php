<?php

// force UTF-8 Ø

if (!defined('WEBPATH')) die();

?>
<!DOCTYPE html>

<html>
<head>
	<?php zp_apply_filter('theme_head'); ?>
	<title><?php printGalleryTitle(); ?></title>
	<meta http-equiv="content-type" content="text/html; charset=<?php echo LOCAL_CHARSET; ?>" />
	<link rel="stylesheet" href="<?php echo  $_zp_themeroot ?>/zen.css" type="text/css" />

</head>
<?php 
// RANDOM IMAGE    source: http://www.zenphoto.org/support/topic.php?id=7&replies=47
$randomImage = getRandomImages();
?>
<body style="background-image: url('<?php echo  $_zp_themeroot ?>/images/photography_background.gif');">
<?php zp_apply_filter('theme_body_open'); ?>
<?php //printAdminToolbox(); ?>

<table id="main" align='center' style="width:839px; background-image: url('<?php echo  $_zp_themeroot ?>/images/main_table_background.jpg');background-repeat: no-repeat;">
<tr>
<td style='width:20px'>&nbsp;</td>
<td>
	<table class='header' width='100%' style='margin-top:176px'>
	<tr>
		<td align='right'>&nbsp;</td>
	</tr>
	</table>

	<div id="gallerytitle">
		<h2><?php echo getGalleryTitle(); ?></h2>
	</div>
	
	<div> 
	<table cellpadding='0' cellspacing='0'>
	<tr valign='top'>
		<?php $zi = 0; ?>
		<?php $zi2 = 0; ?>
		<?php while (next_album() && $zi = $zi+1): ?>
		<?php if ($zi < 4) { ?>
			<td class="album" style="background-image: url('<?php echo  $_zp_themeroot ?>/images/album_pattern.gif');">
				<div class='albumthumb'>
					<a href="<?php echo getAlbumLinkURL();?>" title="View album: <?php echo getAlbumTitle();?>">
					<?php //printAlbumThumbImage(getAlbumTitle()); ?>
					<?php printCustomAlbumThumbImage(getAlbumTitle(), null, 211, 300, 211, 300); ?></a></div>
				<div class="albumdesc">
	        		<small><?php //printAlbumDate("Date Taken: "); ?></small>
					<h3><a href="<?php echo getAlbumLinkURL();?>" title="View album: <?php echo getAlbumTitle();?>"><?php printAlbumTitle(); ?></a></h3>
					<p><?php printAlbumDesc(); ?></p>
				</div>
			</td>
			<?php if ($zi < 3) { ?>
				<td style='width:10px'>&nbsp;</td>
			<?php } ?>
		<?php } ?>
		<?php if ($zi == 4) { ?>
			</tr>
			</table> 
			<?php /* end the table for the first big album thumbnails */ ?>
			
			<?php /* page content */ ?>
			<table cellpadding='0' cellspacing='0' border='0'>
			<tr valign='top' style="background-image: url('<?php echo  $_zp_themeroot ?>/images/guitar_background.jpg'); background-repeat: no-repeat;">
				<td style='font-size: 14px; line-height: 120%; padding: 20px;'>
					Welcome to my photo website. Enjoy the snapshots of my life. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br/>
					:-)
				</td>
				<td style="padding: 20px 9px; font: Verdana; font-variant: small-caps;" width='350'>
				<div class="imagethumb" align='right' style='line-height:110%'><a href='<?php echo html_encode(getURL($randomImage)); ?>'><img src='<?php echo $randomImage->getCustomImage(null, 350, 250, 350, 250, null, null); ?>' alt='<?php echo $randomImage->getTitle(); ?>' title='<?php echo html_encode($randomImage->getTitle()); ?>' /></a></div>
				<div>random photo: <?php echo strtolower(preg_replace('/_/', ' ', $randomImage->getTitle())); ?></div>
				</td>
			</tr>
			<tr>
			</table>
			<?php /* end page content */ ?>
			
			<?php /* start table for the rest of the thumbnails */ ?>
			<table cellpadding='0' cellspacing='0'>
			<tr>
		<?php } ?>
		<?php if ($zi > 3 && $zi < 8 ) { ?>
			<td class="album" style="background-image: url('<?php echo  $_zp_themeroot ?>/images/album_pattern.gif');">
				<div class='albumthumb'>
					<a href="<?php echo getAlbumLinkURL();?>" title="View album: <?php echo getAlbumTitle();?>">
					<?php //printAlbumThumbImage(getAlbumTitle()); ?>
					<?php printCustomAlbumThumbImage(getAlbumTitle(), null, 142, 142, 142, 142); ?></a></div>
				<div class="albumdesc">
	        		<small><?php //printAlbumDate("Date Taken: "); ?></small>
					<h3><a href="<?php echo getAlbumLinkURL();?>" title="View album: <?php echo getAlbumTitle();?>"><?php printAlbumTitle(); ?></a></h3>
					<p><?php printAlbumDesc(); ?></p>
				</div>
			</td>
			<?php // print a spacer
			/*
			$zi2++;
			if ($zi2 > 4) {
				$zi2 = 0;
			?>	</tr><tr> <?php 
			} else {*/
			?>
				<td style='width:10px'>&nbsp;</td>
			<?php 
			//} // end print a spacer
			?>
			
		<?php } elseif ($zi >= 8) { ?>
			<?php 	$zi2++;
				if ($zi2 > 2) { $zi2 = 1; }
				if ($zi2 == 1) {
			?>
					</tr>
					<tr>
			<?php  } elseif ($zi2 == 2) { ?>
				<td style='width:10px'>&nbsp;</td>
			<?php  } ?>
				<td class="album" colspan='3' style="background-image: url('<?php echo  $_zp_themeroot ?>/images/album_pattern.gif'); padding:5px;">
					<table cellpadding='0' cellspacing='0' border='0' width='100%'>
					<tr valign='top'>
					<td>
					<div class="albumdesc" style='text-align:left; margin: 0 5px'>
		        		<small><?php //printAlbumDate("Date Taken: "); ?></small>
						<h3><a href="<?php echo getAlbumLinkURL();?>" title="View album: <?php echo getAlbumTitle();?>"><?php printAlbumTitle(); ?></a></h3>
						<p style='line-height: 110%'><?php printAlbumDesc(); ?></p>
					</div>
					</td>
					<td style='width:10px'>&nbsp;</td>
					<td>
					<div class='albumthumb' style='float:right;'>
						<a href="<?php echo getAlbumLinkURL();?>" title="View album: <?php echo getAlbumTitle();?>">
						<?php //printAlbumThumbImage(getAlbumTitle()); ?>
						<?php printCustomAlbumThumbImage(getAlbumTitle(), null, 211, 100, 211, 100); ?></a></div>
					</td>
					

					</tr>
					</table>
				</td>
		<?php } ?>
		<?php endwhile; ?>
	</tr>
	</table>
	</div>
	
	<div align='center'><?php //printPageListWithNav("&laquo; prev", "next &raquo;"); ?></div>
	

</td>
<td style='width:20px;'>&nbsp;</td>
</tr>
</table>

<table cellpadding='0' cellspacing='0' border='0' width='880' align='center'>
<tr>
<td>
	<div id="credit">
	Desgin by <a href='http://www.andreyphoto.com'>Andrey Samode: andreyphoto.com</a> |
	Powered by <a href="http://www.zenphoto.org" title="A simpler web photo album">zenphoto</a>
	</div>
</td>
</tr>
</table>
<?php zp_apply_filter('theme_body_close'); ?>
</body>
</html>
