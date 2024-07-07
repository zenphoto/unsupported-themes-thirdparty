<?php 
$host = sanitize("http://" . $_SERVER['HTTP_HOST']);
$url = $host . getRequestURI();

$fb_url = 'http://www.facebook.com/sharer.php?u='.$url;
$tw_url = 'http://twitter.com/home?status='.$url;
$g_url = 'https://plus.google.com/share?url='.$url;
?>
	<div id="content-footer">
		<?php
		if (getOption('RSS_album_image') || getOption('RSS_articles')) { ?>
			<a target="_blank" class="share_fb" href="<?php echo $fb_url; ?>" title="<?php echo gettext('Share on Facebook'); ?>">Facebook</a>
			<a target="_blank" class="share_tw" href="<?php echo $tw_url; ?>" title="<?php echo gettext('Share on Twitter'); ?>">Twitter</a>
			<a target="_blank" class="share_g" href="<?php echo $g_url; ?>" title="<?php echo gettext('Share on Google+'); ?>">Google+</a>	
			<?php if(!is_null($_zp_current_album)) { 
				if (class_exists('RSS')) printRSSLink('Album','',gettext('Album RSS'),'',false,"share_rss");
			} else {
				if (class_exists('RSS')) printRSSLink('Gallery','',gettext('Gallery'),'',false,"share_rss");
			} ?>	
		<?php } ?>
        </div> 	
</div><!-- end wrapper -->
	
<div id="footer">
        <span class="left">
		Copyright &#169; <a href="http://www.bpabak.pl/" target="_blank">2014 ABAK - IT Bussines Partner.</a> Wszelkie prawa zastrzeżone.
       	</span>
	<span class="right">
		<?php printZenphotoLink(); ?>
     	</span>
</div>
	<?php zp_apply_filter('theme_body_close'); ?>