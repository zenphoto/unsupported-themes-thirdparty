<?php if (!defined('WEBPATH')) die(); $themeResult = getTheme($zenCSS, $themeColor, 'light'); $firstPageImages = normalizeColumns('2', '6');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php zenJavascript(); ?>
	<title><?php echo getBareGalleryTitle(); ?></title>
  <script type="text/javascript" src="<?php echo $_zp_themeroot ?>/js/jquery.ui.layout.js"></script> 
  <script type="text/javascript" src="<?php echo $_zp_themeroot ?>/js/jquery.ui.core.js"></script> 
  <script type="text/javascript" src="<?php echo $_zp_themeroot ?>/js/jquery.ui.draggable.js"></script> 
	<script type="text/javascript"> 
	var outerLayout;

	$(document).ready(function () {
		outerLayout = $('body').layout(outerLayoutSettings);
		$('div#main').layout(layoutSettings);
		//$(outerLayout.options.center.paneSelector).layout(layoutSettings);
	});

	var outerLayoutSettings = {
		applyDefaultStyles:		true,
		defaults: {
			paneClass:					"pane", 		// default = 'ui-layout-pane'
			resizerClass:				"resizer",	// default = 'ui-layout-resizer'
			togglerClass:				"toggler",	// default = 'ui-layout-toggler'
			buttonClass:				"button",		// default = 'ui-layout-button'
			contentSelector:		".content"
		},
		center: {
			paneSelector:				"#mainContent"
		}
	};

	var layoutSettings = {
		applyDefaultStyles:		true,
		defaults: {
			resizerTip:					"Resize This Pane",
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
	<?php printRSSHeaderLink('Gallery',gettext('Gallery RSS')); ?>
</head>

<body>

<div id="mainContent">

	<div class="header">
		<div id="gallerytitle">
			<?php if (getOption('Allow_search')) {  printSearchForm(''); } ?>
			<h2><?php printHomeLink('', ' | '); echo getGalleryTitle(); ?></h2>
		</div>
		<?php printAdminToolbox(); ?>
	</div>

	<div id="main" class="content">
		<div class="ui-layout-center">
			<div id="albums">
				<?php while (next_album()): ?>
					<div class="album">
					<div class="thumb">
						<a href="<?php echo htmlspecialchars(getAlbumLinkURL());?>" title="<?php echo gettext('View album:'); ?> <?php echo getAnnotatedAlbumTitle();?>"><?php printAlbumThumbImage(getAnnotatedAlbumTitle()); ?></a>
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
			<br clear="all" />
			<?php printPageListWithNav("&laquo; ".gettext("prev"), gettext("next")." &raquo;"); ?>
		</div>

		<div class="ui-layout-east">
			<h1>Sidebar</h1>
			<?php if (function_exists('printLanguageSelector')) { printLanguageSelector(); } ?>
		</div>
	</div>

	<div class="footer">
		<div id="credit">
			<?php
			if (function_exists('printUserLogout')) {
				printUserLogout('', ' | ');
			}
			?>
			<?php printRSSLink('Gallery','','RSS', ' | '); ?>
			<?php printCustomPageURL(gettext("Archive View"),"archive"); ?> |
			
			<?php	if (function_exists('printContactForm')) {
				printCustomPageURL(gettext('Contact us'), 'contact', '', '', ' | ');	
			}
			?>
			
			<?php
			if (!zp_loggedin() && function_exists('printRegistrationForm')) {
				printCustomPageURL(gettext('Register for this site'), 'register', '', '', ' | ');
			}
			?>
			<?php printZenphotoLink(); ?>
		</div>
	</div>

</div>

</body>
</html>
