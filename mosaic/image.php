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
<body id="imagePage">
	
	<div id="albumNav">
		<?php printHomeLink('', ' | '); ?><a href="<?php echo getGalleryIndexURL();?>" title="Albums Index"><?php echo getGalleryTitle();?></a> | <?php printParentBreadcrumb(); printAlbumBreadcrumb("", " | "); ?>
	</div>
	
	<div id="image">
		<div id="leftPane">
			<?php if (hasPrevImage()) { ?>
				<div id="prevButton">
					 <a href="<?php echo getPrevImageURL();?>" title="Previous">&laquo; Previous</a>
				</div>
			<?php } ?>
			<div id="imageSideTitle">
				<?php printImageTitle(true); ?>
			</div>
		</div>
	
		<div id="photo">
        	<a href="<?php echo getProtectedImageURL();?>" title="<?php echo getImageTitle();?>">
	      		<?php printDefaultSizedImage(getImageTitle()); ?>
			</a>
			
			<div id="imageMap">
				<? printImageMap(18, NULL, 700, 300); ?>
			</div>
			
			<?php if (getOption('Allow_comments')) { ?>
				<div id="commentForm">
				<?php if (OpenedForComments()) { ?>
	          		<!-- If comments are on for this image AND album... -->
	            	<h3>Post a comment:</h3>
	            	<form id="commentform" action="#comments" method="post">
	              		<input type="hidden" name="comment" value="1" />
	              		<input type="hidden" name="remember" value="1" />
	                    <?php printCommentErrors(); ?>
	              		<table border="0">
	                		<tr><td><label for="name">Name:</label></td>    <td><input type="text" name="name" size="20" value="<?php echo $stored[0];?>" />  </td></tr>
	                		<tr><td><label for="email">Email (will not be visible):</label></td> <td><input type="text" name="email" size="20" value="<?php echo $stored[1];?>" /> </td></tr>
	                		<tr><td><label for="website">Website (optionnel):</label></td> <td><input type="text" name="website" size="30" value="<?php echo $stored[2];?>" /></td></tr>
	                        <?php if (getOption('Use_Captcha')) { 
	                          printCaptcha('<tr><td>Enter ', ':</td><td>', '</td></tr>'); 
	                        } ?>
	              		</table>
	              		<textarea name="comment" rows="6" cols="40"></textarea><br />
	              		<input type="submit" value="Poster le commentaire" />
	            	</form>
	          	</div>
	        	<?php } else { echo 'Comments are closed.'; } ?>
	      	<?php } ?>
		</div>

		<div id="rightPane">
			<?php if (hasNextImage()) { ?>
				<div id="nextButton">
					 <a href="<?php echo getNextImageURL();?>" title="Next">Next &raquo;</a>
				</div>
				<div id="description">
					<?php printImageDesc(true); ?>
				</div>
				<div id="comments">
					<?php while (next_comment()):  ?>
		            	<div id="comment">
			            	<div id="commentMeta">
			                	<span class="commentAuthor"><?php printCommentAuthorLink(); ?></span><br />
			                	<span class="commentDate"><?php echo getCommentDate();?>, <?php echo getCommentTime();?> PST</span>
			             	</div>
			              	<div class="commentBody"><?php echo getCommentBody();?></div>            
			            </div>
		          	<?php endwhile; ?>
				</div>
			<?php } ?>
		</div>
	</div>

</body>
</html>
