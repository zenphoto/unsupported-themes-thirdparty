<?php if (!defined('WEBPATH')) die(); $themeResult = getTheme($zenCSS, $themeColor, 'light'); $firstPageImages = normalizeColumns('2', '6');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php zenJavascript(); ?>
	<title><?php echo getBareGalleryTitle(); ?> | <?php echo getBareAlbumTitle();?></title>
	<script type="text/javascript" src="<?php echo $_zp_themeroot ?>/js/jquery.ui.layout.js"></script> 
<!--	<script type="text/javascript" src="<?php echo $_zp_themeroot ?>/js/jquery.ui.core.js"></script> 
	<script type="text/javascript" src="<?php echo $_zp_themeroot ?>/js/jquery.ui.draggable.js"></script> -->
	<script type="text/javascript" src="<?php echo $_zp_themeroot ?>/jquery/js/jquery-ui-1.6.custom.min.js"></script>
	<script type="text/javascript">
	$(function() {
		$("#slider").slider({
			startValue: 80,
			min: 40,
			max: 160,
			steps: 6,
			slide: function(event, ui) {
				$("div.thumb > a > img").attr("width", ui.value);
				$("div.imagethumb > a > img").attr("width", ui.value);
			}
		});
	});
	</script>
	<script type="text/javascript"> 
	$(document).ready(function () {
		$('body').layout(layoutSettings);
		$("div.thumb > a > img").attr("width", 80);
		$("div.imagethumb > a > img").attr("width", 80);
		$("div.imagethumb > a > img").removeAttr("height");
	});

	var layoutSettings = {
		applyDefaultStyles:		true,
		defaults: {
			resizerTip:					"Resize This Pane",
			contentPane:				".content"
		},
		north: {
			spacing_open:				0,
			resizable:					false,
			closable:						false
		},
		south: {
			spacing_open:				0,
			resizable:					false,
			closable:						false
		},
		east: {
			spacing_open:				3,
			resizable:					true
		},
		center: {
			minWidth:						200,
			minHeight:					200
		}
	};
	</script> 
	<link rel="stylesheet" href="<?php echo  $zenCSS ?>" type="text/css" />
  <link type="text/css" href="<?php echo $_zp_themeroot ?>/jquery/css/flick/ui.all.css" rel="stylesheet" />
	<?php printRSSHeaderLink('Album',getAlbumTitle()); ?>
</head>

<body>

	<div class="ui-layout-north">
		<div id="gallerytitle">
			<?php if (getOption('Allow_search')) {  printSearchForm(''); } ?>
			<?php printAdminToolbox(); ?>
			<h2><span><?php printHomeLink('', ' | '); ?><a href="<?php echo htmlspecialchars(getGalleryIndexURL());?>" title="<?php echo gettext('Albums Index'); ?>"><?php echo getGalleryTitle();?></a> | <?php printParentBreadcrumb(); ?></span> <?php printAlbumTitle(true);?></h2>
		</div>
	</div>

	<div class="ui-layout-center">
		<div class="sliderbox">
			<div id="slider"></div>
		</div>
		<div id="albums">
			<?php while (next_album()): ?>
				<div class="album">
				<div class="thumb">
					<a href="<?php echo htmlspecialchars(getAlbumLinkURL());?>" title="<?php echo gettext('View album:'); ?> <?php echo getAnnotatedAlbumTitle();?>">
						<?php printAlbumThumbImage(getAnnotatedAlbumTitle()); ?>
					</a>
 				</div>
				<div class="albumdesc">
					<h3><a href="<?php echo htmlspecialchars(getAlbumLinkURL());?>" title="<?php echo gettext('View album:'); ?> <?php echo getAnnotatedAlbumTitle();?>"><?php printAlbumTitle(); ?></a></h3>
 							<small><?php printAlbumDate(""); ?></small>
					<p><?php printAlbumDesc(); ?></p>
				</div>
				<p style="clear: both; "></p>
			</div>
			<?php endwhile; ?>
		</div>
		<div id="images">
			<?php while (next_image(false, $firstPageImages)): ?>
			<div class="image">
				<div class="imagethumb">
					<a href="<?php echo htmlspecialchars(getImageLinkURL());?>" title="<?php echo getBareImageTitle();?>"><?php printImageThumb(getAnnotatedImageTitle()); ?></a>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
		<?php printPageListWithNav("&laquo; ".gettext("prev"), gettext("next")." &raquo;"); ?>
	</div>
		
	<div class="ui-layout-east">
		<?php if (function_exists('printLanguageSelector')) { printLanguageSelector(); } ?>
		<?php printAlbumDesc(true); ?>
		<?php printTags('links', gettext('<strong>Tags:</strong>').' ', 'taglist', ''); ?>
		<?php if (function_exists('printSlideShowLink')) printSlideShowLink(gettext('View Slideshow')); ?>
		<?php if (function_exists('printRating')) { printRating(); }?>
		<?php if (function_exists('printCommentForm')) { ?>
			<div id="comments">
				<?php printCommentForm(); ?>
			</div>
		<?php } ?>
	</div>

	<div class="ui-layout-south">
		<div id="credit">
			<?php printRSSLink('Album', '', gettext('Album RSS'), ''); ?> | <?php printCustomPageURL(gettext("Archive View"),"archive"); ?> | 
			<?php printZenphotoLink(); ?>
			<?php
				if (function_exists('printUserLogout')) {
					printUserLogout(" | ");
			} ?>
		</div>
	</div>

</body>
</html>
