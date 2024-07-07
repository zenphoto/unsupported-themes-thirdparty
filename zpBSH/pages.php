<?php include("inc/header.php"); ?>

    		<div id="content">
			<div id="maincontent">
				<div class="breadcrump">
				<?php printHomeLink('', ' | '); ?><a href="<?php echo html_encode(getGalleryIndexURL());?>" title="<?php echo gettext('Albums Index'); ?>">
					<?php echo getGalleryTitle();?></a> | <?php printParentBreadcrumb(); ?><?php printPageTitle(); ?>
				</div>
				
				<!-- begin content -->
				<div class="main section" id="main">
					<div class="title">
						<h3><?php printPageTitle(); ?></h3>
					</div>
					<div id="pagetext">
						<?php printCodeblock(1); ?>
						<?php printPageContent(); ?>
						<?php printCodeblock(2); ?>
					</div>
					<?php
					@call_user_func('printRating');
					@call_user_func('printCommentForm');
					?>
					<p style="clear: both;"></p>
				</div>
				<!-- end content -->
			</div>
			<div id="sidecontent">
				<?php include("inc/sidebar.php"); ?>
			</div>
			<br class="clearall" />			
	    	</div><!-- end content -->
	
	<?php include("inc/footer.php"); ?>
</body>
</html>