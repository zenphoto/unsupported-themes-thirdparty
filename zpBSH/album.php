<?php include("inc/header.php"); ?>

    		<div id="content">
			<div id="maincontent">
				<div class="breadcrump">
				<?php printHomeLink('', ' | '); ?><a href="<?php echo html_encode(getGalleryIndexURL());?>" title="<?php echo gettext('Albums Index'); ?>">
					<?php echo getGalleryTitle();?></a> | <?php printParentBreadcrumb(); ?><?php printAlbumTitle();?>
				</div>
				
				<?php while (next_album()): ?>
					<div class="category">
						<h3>
							<a href="<?php echo html_encode(getAlbumURL()); ?>" title="<?php echo gettext('View album:'); ?> 
								<?php printBareAlbumTitle(); ?>"><?php printAlbumTitle(); ?></a>
						</h3>        	
						<a href="<?php echo html_encode(getAlbumURL()); ?>" title="<?php echo gettext('View album:'); ?> 
							<?php printBareAlbumTitle(); ?>">
							<?php printCustomAlbumThumbImage(getBareAlbumTitle(), NULL, 270, 140, 270, 140); ?>
						</a>
		
						<div class="meta-date"><?php printAlbumDate(""); ?></div>
						<div class="meta-image"><?php if (getNumImages() > 0) echo getNumImages().' '.gettext("images"); ?></div>
		
						<div class="meta-desc"><?php echo shortenContent(getAlbumDesc(), 30, '...'); ?></div>
					</div>
				<?php endwhile; ?>
				<div id="albums">
					<?php printAlbumDesc(); ?>
					<?php while (next_image()): ?>
						<a href="<?php echo html_encode(getImageURL());?>" title="<?php echo getBareImageTitle();?>">
							<?php printImageThumb(getAnnotatedImageTitle()); ?></a>
					<?php endwhile; ?>
				
					<?php printPageListWithNav("« ".gettext("prev"), gettext("next")." »"); ?>
					<?php printTags('links', gettext('<strong>Tags:</strong>') . ' ', 'taglist', ''); ?>				
					<br />
					<div class="left">
						<?php @call_user_func('printRating'); ?>
					</div>
					<div class="right">
						<?php @call_user_func('printSlideShowLink'); ?>				
					</div>
	
					<?php @call_user_func('printCommentForm'); ?>
					<?php @call_user_func('printGoogleMap'); ?>
				</div>	
			</div>
			<div id="sidecontent">
				<?php include("inc/sidebar.php"); ?>
			</div>
			<br class="clearall" />			
	    	</div><!-- end content -->
	
	<?php include("inc/footer.php"); ?>
</body>
</html>