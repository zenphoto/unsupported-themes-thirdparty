<?php if (!defined('WEBPATH')) die(); $themeResult = getTheme($zenCSS, $themeColor, 'light'); $firstPageImages = normalizeColumns('2', '6');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php zenJavascript(); ?>
	<title><?php echo getBareGalleryTitle(); ?></title>
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/reset-fonts-grids/reset-fonts-grids.css">
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/assets/skins/sam/resize.css">
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/assets/skins/sam/layout.css">
	<script type="text/javascript" src="http://yui.yahooapis.com/2.8.0r4/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
	<script type="text/javascript" src="http://yui.yahooapis.com/2.8.0r4/build/element/element-min.js"></script> 
	<script type="text/javascript" src="http://yui.yahooapis.com/2.8.0r4/build/selector/selector-min.js"></script>
	<script type="text/javascript" src="http://yui.yahooapis.com/2.8.0r4/build/resize/resize-min.js"></script> 
	<script type="text/javascript" src="http://yui.yahooapis.com/2.8.0r4/build/layout/layout-min.js"></script> 
	<link rel="stylesheet" href="<?php echo  $zenCSS ?>" type="text/css" />
	<?php printRSSHeaderLink('Gallery',gettext('Gallery RSS')); ?>
</head>

<body class="yui-skin-sam">

<div id="doc3" class="yui-t5"> 
	<div id="hd">
		<div id="gallerytitle">
			<?php if (getOption('Allow_search')) {  printSearchForm(''); } ?>
			<h2><?php printHomeLink('', ' | '); echo getGalleryTitle(); ?></h2>
		</div>
		<?php printAdminToolbox(); ?>
	</div>

	<div id="bd">
		<div id="yui-main">
			<div class="yui-b"><div class="yui-g">
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
			</div></div>
		</div>

		<div id="metapanel" class="yui-b">
			<h1>Sidebar</h1>
			<?php if (function_exists('printLanguageSelector')) { printLanguageSelector(); } ?>
		</div>
	</div>

	<div id="ft">
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

<script> 
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;
 
    Event.onDOMReady(function() {
        var layout = new YAHOO.widget.Layout('doc3', {
            height: Dom.getClientHeight(), //Height of the viewport
            width: Dom.get('doc3').offsetWidth, //Width of the outer element
            minHeight: 300, //So it doesn't get too small
            units: [
                { position: 'top', height: Dom.get('hd').offsetHeight, body: 'hd' },
								{ position: 'right', width: Dom.get('metapanel').offsetWidth, body: 'metapanel', resize: true, collapse: true, grids: true },
                { position: 'bottom', height: Dom.get('ft').offsetHeight, body: 'ft' },
                { position: 'center', body: 'bd', grids: true }
            ]
        });
        layout.on('beforeResize', function() {
            Dom.setStyle('doc3', 'height', Dom.getClientHeight() + 'px');
        });
 
        layout.render();
 
        //Handle the resizing of the window
        Event.on(window, 'resize', layout.resize, layout, true);
    });
})();
</script>

</body>
</html>
