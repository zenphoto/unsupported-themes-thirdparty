<?php
        // force UTF-8
        if (!defined('WEBPATH')) die();
?>
<!DOCTYPE html>
<html>
<head>
	<?php zp_apply_filter('theme_head'); ?>
        <?php printHeadTitle(); ?>
        <meta http-equiv="content-type" content="text/html; charset=<?php echo LOCAL_CHARSET; ?>" />
	<?php if (class_exists('RSS')) printRSSHeaderLink('Gallery',gettext('Gallery RSS')); ?>
        <link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/styles/style.css" type="text/css" media="screen" />   
	<!--[if IE]>
	<link href="<?php echo $_zp_themeroot; ?>/styles/ieonly.css" rel="stylesheet" type="text/css" />
	<![endif]-->	
	<link rel="shortcut icon" href="<?php echo $_zp_themeroot; ?>/logo.png">
	<?php if (zp_has_filter('theme_head', 'colorbox::css')) { ?>
		<script type="text/javascript">
			// <!-- <![CDATA[
			$(document).ready(function() {
				$(".colorbox").colorbox({
					inline: true,
					href: "#imagemetadata",
					close: '<?php echo gettext("close"); ?>'
				});
				$("a.thickbox").colorbox({
					maxWidth: "98%",
					maxHeight: "98%",
					photo: true,
					close: '<?php echo gettext("close"); ?>'
				});
			});
			// ]]> -->
		</script>
	<?php } ?>	
</head>

<body>
	<?php zp_apply_filter('theme_body_open'); ?>
	<div id="wrapper">
		<?php 
		$logoPath = "background-image: url('/themes/zpBSH/logobg/".getOption('Theme_logo').".png');";
		?>
		<div id="navigation_bg" style="<?php echo $logoPath;?>">
			<div id="navigation">	
				<h1>
					<a href="<?php echo html_encode(getGalleryIndexURL()); ?>" title="<?php echo gettext('Home'); ?>"><?php printGalleryTitle(); ?></a>
				</h1>
				<h2><?php printGalleryDesc(); ?></h2>
			</div>
		</div>