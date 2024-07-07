<?php if (!defined('WEBPATH')) die(); ?>
<?php header('Last-Modified: ' . gmdate('d M Y H:i:s').' GMT'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php zenJavascript(); ?>
	<title><?php echo getBareImageTitle();?> -- <?php echo getBareGalleryTitle();?></title>
	<meta http-equiv="content-type" content="text/html; charset=<?php echo getOption('charset'); ?>" />
	<meta http-equiv="imagetoolbar" content="false" />
	<link rel="shortcut icon" href="<?= $_zp_themeroot ?>/images/icon.png" />
	<link rel="stylesheet" href="<?= $_zp_themeroot ?>/style.css" type="text/css" />
	<?php printRSSHeaderLink('Gallery',gettext('Gallery RSS')); ?>
	<script type="text/javascript">
	<!-- Navigation between images using both arrow keys and mouse(over).
	var ua = navigator.userAgent;
	var opera = /opera [56789]|opera\/[56789]/i.test(ua);
	var ie = !opera && /msie [56789]/i.test(ua);
	var moz = !opera && /mozilla\/[56789]/i.test(ua);
	function toggle(obj) {document.getElementById(obj).style.display=(document.getElementById(obj).style.display!="block")? "block" : "none";} 
	  <?php if (hasNextImage()) { ?>var nextURL="<?=getNextImageURL();?>";<?php } ?>
	  <?php if (hasPrevImage()) { ?>var prevURL="<?=getPrevImageURL();?>";<?php } ?>
	 function keyDown(e){
		if (!ie) {var keyCode=e.which;}
		if (ie) {var keyCode=event.keyCode;}
		if(keyCode==39){<?php if (hasNextImage()) { ?>window.location=nextURL<?php } ?>};
		if(keyCode==37){<?php if (hasPrevImage()) { ?>window.location=prevURL<?php } ?>};}
		document.onkeydown = keyDown;
		if (!ie)document.captureEvents(Event.KEYDOWN);
		document.oncontextmenu=new Function("return false");
		//document.onselectstart=new Function ("return false");
		document.ondragstart=new Function ("return false") ;
	function opacity(id, opacStart, opacEnd, millisec) {
		var speed = Math.round(millisec / 100);
		var timer = 0;
		if(opacStart > opacEnd) {
			for(i = opacStart; i >= opacEnd; i--) {
				setTimeout("changeOpac(" + i + ",'" + id + "')",(timer * speed));
			timer++;
			}
		} else if(opacStart < opacEnd) {
			for(i = opacStart; i <= opacEnd; i++){
				setTimeout("changeOpac(" + i + ",'" + id + "')",(timer * speed));
				timer++;
				}
			}
		}
	function changeOpac(opacity, id) {
		var object = document.getElementById(id).style;
			object.opacity = (opacity / 100);
			object.MozOpacity = (opacity / 100);
			object.KhtmlOpacity = (opacity / 100);
			object.filter = "alpha(opacity=" + opacity + ")";
		}
	-->
	</script>
	<!-- Displays EXIF data of the current image. -->
	<?php require_once(SERVERPATH.'/'.ZENFOLDER.'/js/colorbox/colorbox_ie.css.php');?>
	<script src="<?php echo FULLWEBPATH . "/" . ZENFOLDER ?>/js/colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
	<script type="text/javascript">
		// <!-- <![CDATA[
		$(document).ready(function(){
			$(".colorbox").colorbox({inline:true, href:"#imagemetadata"});
		});
		// ]]> -->
	</script>
</head>

<body>
<div id="framework">

	<div id="main">

	<div id="path">
	<div class="left"><h1><a href="<?=getGalleryIndexURL();?>"><?php printGalleryTitle(); ?></a></h1> &raquo; <?php printParentBreadcrumb('', '', " &raquo; "); printAlbumBreadcrumb('', ' &raquo; '); ?> <h2><strong><?php printImageTitle(true); ?></strong></h2></div>
	<div class="right">use keyboard's arrow <img src="<?= $_zp_themeroot ?>/images/arrow-l.png" title="left arrow for previous image" align="absmiddle"><img src="<?= $_zp_themeroot ?>/images/arrow-r.png" title="right arrow for next image" align="absmiddle"> keys to navigate</div>
	</div><!-- #path --><br>

	<?php if (getImageDesc() !='') { ?>
	<div id="desc-image"><?printImageDesc(true); ?></div>
	<?}?>

<table width="100%" border="0" cellpadding="15" bgcolor="#3B3A38">
<tr>
<td align="center" valign="middle">
<table border="0" cellpadding="0" cellspacing="0" style="border:1px #30302E solid" >
  <tr>
    <td width="<?php echo getDefaultWidth(); ?>" height="<?php echo getDefaultHeight(); ?>" align="center" valign="middle" style="background: url(<?php echo getDefaultSizedImage(); ?>) no-repeat;">
	<?php if (hasPrevImage()) { ?>
<a href="<?=getPrevImageURL();?>" title="Previous photo"><div id="nav-prev" style="height:<?php echo getDefaultHeight(); ?>px"></div></a>
	<?php } ?>
	<?php if (hasNextImage()) { ?>
<a href="<?=getNextImageURL();?>" title="Next photo"><div id="nav-next" style="height:<?php echo getDefaultHeight(); ?>px"></div></a>
	<?php } ?>
    </td>
  </tr>
</table>
</td>
</tr>
</table>

	<div id="info">
    <div class="info-left">
    <?php if (getImageData('location') || getImageData('city') || getImageData('country')) { echo 'Where: '; }; ?><?php if (getImageData('location')) { echo getImageData('location').', '; }; ?><?php if (getImageData('city')) { echo getImageData('city').', '; }; ?><?php if (getImageData('country')) { echo getImageData('country'); }; ?>
	<?php if (getImageDate()) { echo printImageDate($before='<br>When: '); }; ?>
	<?php if (getImageData('copyright')) { echo '<br>License: <strong>'.getImageData('copyright').'</strong>'; }; ?>
	<?php printTags('links', gettext('<br>Tags: '), 'taglist', '; '); ?>
    </div>
    <div class="info-right">
    <?php if (getImageMetaData()) {echo "<div id=\"exif_link\">How: <a href=\"#\" title=\"".gettext("EXIF Data")."\" class=\"colorbox\">".gettext("EXIF")."</a></div>"; echo "<div style='display:none'>"; printImageMetadata('', false); echo "</div>"; } ?>
	<a href="<?=getFullImageURL();?>" title="<?=getImageTitle();?>">Full size</a> (<?php echo getFullWidth() . "x" . getFullHeight(); ?>px)
	<?php if (function_exists('printSlideShowLink')) printSlideShowLink(gettext('View Slideshow?')); ?>
    </div>
    </div><!-- #info -->

    <?php if (function_exists('printCommentForm')) { ?>
    <div id="comments">
		<div id="toggle"><?php $num = getCommentCount(); echo ($num == 0) ? "<em>No Comments</em>" : ("<em>Comments ($num)</em>"); ?>, <a href="#toggle" onclick="toggle('imgcommentform')">Add Comment?</a></div>
		<br />
		<? if (isset($error)) { ?>
			<div id="imgcommentform" style="display:block;">
			<div class="error"><p>There was an error submitting your comment. Name, a valid e-mail address, and a comment are required.</p></div> 
		<? } else { ?>
			<div id="imgcommentform" style="display:none;">
		<? } ?>
			<!-- If comments are on for this image AND album... -->				
			<form id="commentform" action="#" method="post">
				<div><input type="hidden" name="comment" value="1" />
          		<input type="hidden" name="remember" value="1" />
						<p><label for="name">Name:</label><input type="text" id="name" name="name" size="20" value="<?=$stored[0];?>" /></p>
						<p><label for="email">E-Mail:</label><input type="text" id="email" name="email" size="30" value="<?=$stored[1];?>" /></p>
						<p><label for="website">Site:</label><input type="text" id="website" name="website" size="40" value="<?=$stored[2];?>" /></p>
						<p><?php if (getOption('Use_Captcha')) { $captchaCode=generateCaptcha($img); ?><label for="code"><?php echo gettext("Enter the code:"); ?><img src=<?php echo "\"$img\"";?> alt="Code" align="bottom"/></label> <input type="text" id="code" name="code" size="20" class="inputbox" /><input type="hidden" name="code_h" value="<?php echo $captchaCode;?>"/><?php } ?></p>
						<p><textarea name="comment" rows="4"></textarea></p>
						<input type="submit" value="Shoot!" class="pushbutton" />
				</div>
			</form>
			</div><!-- #imgcommentform -->

		<div id="commentslist">
			<?php while (next_comment()):  ?>
			<div class="comment">
				<div class="commentmeta">
					<span class="commentauthor"><?php printCommentAuthorLink(); ?></span>
					<span class="commentdate"><?=getCommentDateTime( $format = '%d.%h.%Y %H:%M' );?></span>
				</div>
				<div class="commentbody">
					<?=getCommentBody();?>				
				</div>
			</div><!-- #comment -->
			<?php endwhile; ?>
		</div><!-- #commentslist -->

	</div><!-- #comments -->
	<?php } ?>

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