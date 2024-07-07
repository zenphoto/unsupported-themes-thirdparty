<?php 
if (!defined('WEBPATH')) die(); 
$startTime = array_sum(explode(" ",microtime())); 
$themeResult = getTheme($zenCSS, $themeColor, 'light');	// what is this ?
$firstPageImages = normalizeColumns(1, 7);				// what is this ?
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php printGalleryTitle(); ?></title>
	<meta name="generator" content="TextMate http://macromates.com/">
	<meta name="author" content="Maxime Plante">
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
	<?php printRSSHeaderLink('Album',getAlbumTitle()); ?>
	<?php zenJavascript(); ?>
</head>
<body id="albumPage">



	<div id="albumNav">
		<?php printHomeLink('', ' | '); ?><a href="<?php echo getGalleryIndexURL();?>" title="Albums Index"><?php echo getGalleryTitle();?></a> | <?php printParentBreadcrumb(); ?> <span id="albumTitle"><?php printAlbumTitle(true);?></span>
	</div>


	<div id="album" align='center'>
	
		<!-- Sub-Albums -->
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
		
		
		
		<div id="photos">
			<!-- map control -->
			<div id="albumMapPanel">
				<?php printAlbumMap(NULL, NULL, NULL, 600); ?>
			</div>
			
			<?php while (next_image(false, $firstPageImages)): ?>
	    	<div id="photo">
            	<a href="<?php echo getImageLinkURL();?>" title="<?php echo getImageTitle();?>"> 		<?php printImageThumb(getImageTitle()); ?></a>
	    	</div>

			<?php endwhile; ?>
		</div>
		
	</div>

</body>
</html>
