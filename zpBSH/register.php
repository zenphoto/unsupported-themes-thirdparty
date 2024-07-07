<?php
// force UTF-8
if (!defined('WEBPATH')) die();

if (function_exists('printContactForm')) {
	?>
		<?php include("inc/header.php"); ?>
	
	    		<div id="content">
				<div id="maincontent">
					<h1><?php echo gettext('User Registration') ?></h1>
					<?php printRegistrationForm(); ?>
				</div>
				<div id="sidecontent">
					<?php include("inc/sidebar.php"); ?>
				</div>
				<br class="clearall" />			
		    	</div><!-- end content -->
		    	
		<?php include("inc/footer.php"); ?>
	</body>
	</html>
	<?php
} else {
	include(dirname(__FILE__) . '/404.php');
}
?>