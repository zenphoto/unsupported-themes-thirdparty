<?php if (!defined('WEBPATH')) die(); $themeResult = getTheme($zenCSS, $themeColor, 'light'); $firstPageImages = normalizeColumns('2', '6');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php zenJavascript(); ?>
	<title><?php echo getBareGalleryTitle(); ?> | <?php echo getBareAlbumTitle();?> | <?php echo getBareImageTitle();?></title>
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
			}
		});
	});
	</script>
	<script type="text/javascript"> 
	$(document).ready(function () {
		$('body').layout(layoutSettings);
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
  <link rel="stylesheet" href="<?php echo $_zp_themeroot ?>/jquery/css/flick/ui.all.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo FULLWEBPATH . "/" . ZENFOLDER ?>/js/thickbox.css" type="text/css" />
	<script src="<?php echo FULLWEBPATH . "/" . ZENFOLDER ?>/js/thickbox.js" type="text/javascript"></script>
	<script type="text/javascript">
		function toggleComments() {
			var commentDiv = document.getElementById("comments");
			if (commentDiv.style.display == "block") {
				commentDiv.style.display = "none";
			} else {
				commentDiv.style.display = "block";
			}
		}
	</script>
		<?php printRSSHeaderLink('Gallery',gettext('Gallery RSS')); ?>

</head>

<body>

	<div class="ui-layout-north">
		<div id="gallerytitle">
			<?php if (getOption('Allow_search')) {  printSearchForm(''); } ?>
			<?php printAdminToolbox(); ?>
			<h2><span><?php printHomeLink('', ' | '); ?><a href="<?php echo htmlspecialchars(getGalleryIndexURL());?>" title="<?php gettext('Albums Index'); ?>"><?php echo getGalleryTitle();?>
				</a> | <?php printParentBreadcrumb("", " | ", " | "); printAlbumBreadcrumb("", " | "); ?>
				</span> <?php printImageTitle(true); ?>
			</h2>
		</div>
	</div>


	<div class="ui-layout-center">
		<div class="sliderbox">
			<div id="slider"></div>
		</div>
		<!-- The Image -->
		<?php if (!checkForPassword()) { ?>
		<div id="image">
			<strong>
			<?php
			if (isImagePhoto()) {
				?>
				<a href="<?php echo htmlspecialchars(getFullImageURL());?>" title="<?php echo getBareImageTitle();?>">
				<?php
			}
			if (function_exists('printUserSizeImage') && isImagePhoto()) {
				printUserSizeImage(getImageTitle());
			} else {
				printDefaultSizedImage(getImageTitle());
			}
			if (isImagePhoto()) {
				?>
				</a>
				<?php
			}
			?>
			</strong>
			<?php
		if (function_exists('printUserSizeImage') && isImagePhoto()) printUserSizeSelectior(); ?>
		</div>
		<?php } ?>
	</div>
		
	<div class="ui-layout-east">
		<?php if (function_exists('printLanguageSelector')) { printLanguageSelector(); } ?>
		<?php if (!checkForPassword()) { ?>
		<?php printImageDesc(true); ?>
		<?php if (function_exists('printSlideShowLink')) printSlideShowLink(gettext('View Slideshow')); ?>
		<hr /><br />
		<?php
			if (getImageEXIFData()) {echo "<div id=\"exif_link\"><a href=\"#TB_inline?height=345&amp;width=400&amp;inlineId=imagemetadata\" title=\"".gettext("Image Info")."\" class=\"thickbox\">".gettext("Image Info")."</a></div>";
				printImageMetadata('', false);
			}
		?>
		<?php printTags('links', gettext('<strong>Tags:</strong>').' ', 'taglist', ''); ?>
		<br clear=all />

		<?php if (function_exists('printImageMap')) printImageMap(); ?>

    <?php if (function_exists('printRating')) { printRating(); }?>

		<?php if (function_exists('printShutterfly')) printShutterfly(); ?>

		<?php if (function_exists('printCommentForm')) {
			printCommentForm();
		} ?>
		<?php } ?>
	</div>

	<div class="ui-layout-south">
		<div id="credit">
			<?php printRSSLink('Gallery','','RSS', ' | '); ?> <?php printCustomPageURL(gettext("Archive View"),"archive"); ?> | 
			<?php printZenphotoLink(); ?>
			<?php if (function_exists('printUserLogout')) {
				printUserLogout(" | ");
			} ?>
		</div>
	</div>

</body>
</html>
