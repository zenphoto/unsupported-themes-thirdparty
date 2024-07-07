<?php include("inc/header.php"); ?>

    		<div id="content">
			<div id="maincontent">
				<div id="archive">
					<h3><?php echo gettext('Gallery archive'); ?></h3>
					<?php printAllDates(); ?>
					<hr />
					<?php if(function_exists("printNewsArchive")) { ?>
					<h3><?php echo gettext('News archive'); ?></h3>
					<?php printNewsArchive("archive"); ?>
					<hr />
					<?php } ?>
	
					<h3><?php echo gettext('Popular Tags'); ?></h3>
					<div id="tag_cloud">
						<?php printAllTagsAs('cloud', 'tags'); ?>
					</div>
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