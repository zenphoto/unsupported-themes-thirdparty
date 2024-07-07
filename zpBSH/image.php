<?php include("inc/header.php"); ?>

    		<div id="content">
			<div id="images">
				<div class="breadcrump">
					<?php printHomeLink('', ' | '); ?>
					<a href="<?php echo html_encode(getGalleryIndexURL());?>" title="<?php gettext('Albums Index'); ?>">
					<?php echo getGalleryTitle();?></a> | <?php printParentBreadcrumb("", " | ", " | "); printAlbumBreadcrumb("", " | "); ?>
					<?php printImageTitle(true); ?>
					<a href="<?php echo html_encode($fullimage);?>" title="<?php echo getBareImageTitle();?>"></a>
				</div>
						
				<?php
				if (getOption("Use_thickbox") && !isImageVideo()) {
					$boxclass = " class=\"thickbox\"";
				} else {
					$boxclass = "";
				}
				if (isImagePhoto()) {
					$tburl = getFullImageURL();
				} else {
					$tburl = NULL;
				}
				if (!empty($tburl)) {
					?>
					<a href="<?php echo html_encode(pathurlencode($tburl)); ?>"<?php echo $boxclass; ?> title="<?php printBareImageTitle(); ?>">
						<?php
					}
					printDefaultSizedImage(getImageTitle());
					?>
					<?php
					if (!empty($tburl)) {
						?>
					</a>
					<?php
				}
				?>
													
				<div class="imgnav">
					<?php if (hasPrevImage()) { ?>
						<div class="imgprevious">
							<a href="<?php echo html_encode(getPrevImageURL()); ?>" title="<?php echo gettext("Previous Image"); ?>">
								« <?php echo gettext("prev"); ?></a>
						</div>
					<?php }			 
					if (hasNextImage()) { ?>
						<div class="imgnext">
							<a href="<?php echo html_encode(getNextImageURL()); ?>" title="<?php echo gettext("Next Image"); ?>">
								<?php echo gettext("next"); ?> »</a>
						</div>
					<?php } ?>
					<?php @call_user_func('printPagedThumbsNav', 5, FALSE, ' ', ' ');?>	
				</div>
			       
				<?php printImageDesc(); ?>
				
		
				<?php printTags('links', gettext('<strong>Tags:</strong>') . ' ', 'taglist', ''); ?>				
				<br />
				<div class="left">
					<?php @call_user_func('printRating'); ?>
				</div>
				<div class="right">
					<?php
					if (getImageMetaData()) {
						printImageMetadata(NULL, 'colorbox');
					}
					?>
				
					<?php @call_user_func('printSlideShowLink'); ?>				
				</div>

				<?php @call_user_func('printCommentForm'); ?>
				<?php @call_user_func('printGoogleMap'); ?>					
			</div>
			<div id="sidecontent">
				<?php include("inc/sidebar.php"); ?>
			</div>
			<br class="clearall" />			
	    	</div><!-- end content -->
	
	<?php include("inc/footer.php"); ?>
</body>
</html>