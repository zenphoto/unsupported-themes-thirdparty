<?php include("inc/header.php"); ?>

    		<div id="content">
			<div id="albums">
				<?php
				if (($total = getNumImages() + getNumAlbums()) > 0) {
					if (isset($_REQUEST['date'])) {
						$searchwords = getSearchDate();
					} else {
						$searchwords = getSearchWords();
					}
					echo '<p class="result">' . sprintf(gettext('Total matches for <em>%1$s</em>: %2$u'), html_encode($searchwords), $total) . '</p>';
				}
				$c = 0;
				?>
				<div id="album">
					<?php
					while (next_album()) {
						$c++;
						?>
						<div class="album">
							<div class="thumb">
								<a href="<?php echo html_encode(getAlbumURL()); ?>" title="<?php echo gettext('View album:'); ?> 
								<?php printAnnotatedAlbumTitle(); ?>"><?php printAlbumThumbImage(getAnnotatedAlbumTitle()); ?></a>
							</div>
							<div class="albumdesc">
								<h3><a href="<?php echo html_encode(getAlbumURL()); ?>" title="<?php echo gettext('View album:'); ?> 
								<?php printAnnotatedAlbumTitle(); ?>"><?php printAlbumTitle(); ?></a></h3>
								<p><?php printAlbumDesc(); ?></p>
								<small><?php printAlbumDate(gettext("Date:") . ' '); ?> </small>
							</div>
							<p style="clear: both; "></p>
						</div>
						<?php
					}
					?>
				</div>

				<div id="image">
					<?php
					while (next_image()) {
						$c++;
						?>

							<div class="imagethumb">
							<a href="<?php echo html_encode(getImageURL()); ?>" title="<?php printBareImageTitle(); ?>">
							<?php printImageThumb(getAnnotatedImageTitle()); ?></a>
							</div>

						<?php
					}
					?>
				</div>
				<br class="clearall" />
				<div class="right">
					<?php @call_user_func('printSlideShowLink'); ?>				
				</div>				
				<?php
				if ($c == 0) {
					echo "<p>" . gettext("Sorry, no image matches found. Try refining your search.") . "</p>";
				}
				printPageListWithNav("« " . gettext("prev"), gettext("next") . " »");
				?>
			</div>				
			<div id="sidecontent">
				<?php include("inc/sidebar.php"); ?>
			</div>
			<br class="clearall" />			
	    	</div><!-- end content -->
	
	<?php include("inc/footer.php"); ?>
</body>
</html>