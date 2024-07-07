<?php include("inc/header.php"); ?>

    		<div id="content">
			<div id="maincontent">
				<div class="breadcrump">
				<?php printHomeLink('', ' | '); ?><a href="<?php echo html_encode(getGalleryIndexURL());?>" title="<?php echo gettext('Albums Index'); ?>">
					<?php echo getGalleryTitle();?></a> | <?php printParentBreadcrumb(); ?><?php echo gettext("All news");?>
				</div>
				
				<?php
				// single news article
				if(is_NewsArticle()) {	?>
					<?php if(getPrevNewsURL()) { ?><div class="singlenews_prev"><?php printPrevNewsLink(); ?></div><?php } ?>
					<?php if(getNextNewsURL()) { ?><div class="singlenews_next"><?php printNextNewsLink(); ?></div><?php } ?>
					<?php if(getPrevNewsURL() OR getNextNewsURL()) { ?><br style="clear:both" /><?php } ?>
					<div class="title">
						<h2><?php printNewsTitle(); ?></h2>
					</div>	  			
					<div class="newsarticlecredit">
					<span class="newsarticlecredit-left">
					<?php printNewsDate();?> | <?php if (function_exists('getCommentCount')) 
						{ echo gettext("Comments:"); ?> <?php echo getCommentCount(); ?> |<?php } ?> 
					</span> <?php printNewsCategories(", ",gettext("Categories: "),"newscategories"); ?>
					</div>
					<?php printNewsContent(); ?>
					<?php printTags('links', gettext('<strong>Tags:</strong>').' ', 'taglist', ', '); ?>
					<br style="clear:both;" /><br />
					<?php @call_user_func('printRating'); ?>
					<?php @call_user_func('printCommentForm'); ?>
				<?php } else { ?>
					
					<?php 
					while (next_news()): ;?>
					<div class="newsarticle">
						
						<div class="post-date">
							<span class="month"><?php echo strftime('%b', strtotime($_zp_current_zenpage_news->getDateTime())); ?></span>
							<span class="day"><?php echo strftime('%d', strtotime($_zp_current_zenpage_news->getDateTime())); ?></span>
							<span class="year"><?php echo strftime('%Y', strtotime($_zp_current_zenpage_news->getDateTime())); ?></span>
						</div>
						<h3><?php printNewsTitle(); ?></h3>
						<div class="albumdesc">
							<?php echo shortenContent(strip_tags(getNewsContent()), 185,'(...)',false); ?>
						</div>
						<br style="clear:both;" /><br />
						</div>
					<?php
					endwhile;
					printNewsPageListWithNav(gettext('next »'), gettext('« prev'),true,'pagelist',true);
					?>

				<?php } ?>
			</div>
			<div id="sidecontent">
				<?php include("inc/sidebar.php"); ?>
			</div>
			<br class="clearall" />			
	    	</div><!-- end content -->
	
	<?php include("inc/footer.php"); ?>
</body>
</html>