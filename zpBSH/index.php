<?php include("inc/header.php"); ?>

    		<div id="content">
			<div id="maincontent">
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
				<br class="clearall" />
				<?php printPageListWithNav("« ".gettext("prev"), gettext("next")." »"); ?>
			</div>
			<div id="sidecontent">
				<?php include("inc/sidebar.php"); ?>
			</div>
			<br class="clearall" />			
	    	</div><!-- end content -->
	
	<?php include("inc/footer.php"); ?>
</body>
</html>