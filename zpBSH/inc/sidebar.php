<?php if (getOption('Allow_search')) {
	printSearchForm(null,"search",null,gettext('Search'),"$_zp_themeroot/images/list_12x11.png",null,null,null );
} 

if(function_exists("printAlbumMenu")) { ?>
	<div class="menu">
		<h3><?php echo gettext("Gallery"); ?></h3>		
		<?php printAlbumMenu("list",NULL,"","menu-active","submenu","menu-active","",false,false); ?>
	</div>
	<hr />
<?php } ?>


<?php if (getOption('Pagelink')) { ?>
	<div class="menu">
		<?php if (extensionEnabled('zenpage')) { ?>			
			<h3><?php echo gettext("Pages"); ?></h3>
			<?php printPageMenu("list","style1","menu-active","submenu","menu-active"); ?>
							
		<?php }	?>		
	</div>
<?php } ?>
<?php if (getOption('Newslink')) { ?>
	<div class="menu">
		<?php printAllNewsCategories(gettext("All news"),TRUE,"style1","menu-active",true,"submenu","menu-active"); ?>
	</div>
	<hr />
<?php } ?>

<?php if (getOption('Archive')) { ?>
	<div class="menu">
		<ul>
			<li>
			<?php printCustomPageURL(gettext("Archive"),"archive"); ?>
			</li>
		</ul>
	</div>
	<hr />
<?php } ?>

<?php if (extensionEnabled('contact_form') && getOption('Contact')) { ?>
	<div class="menu">
		<ul>
			<li>
			<?php printCustomPageURL(gettext('Contact us'), 'contact', '', ''); ?>
			</li>
		</ul>
	</div>
	<hr />
<?php } ?>

<?php
if (getOption('Register')) {
	if(function_exists("printUserLogin_out") || !zp_loggedin() && function_exists('printRegistrationForm')) {
	?>
	<div class="menu">
		<ul>
		<?php if (!zp_loggedin() && function_exists('printRegistrationForm')) { ?>
			<li>
			<?php printCustomPageURL(gettext('Register for this site'), 'register', '', ''); ?>
			</li>
		<?php } 
		if (function_exists("printUserLogin_out")) { ?>
			<li>
			<?php printUserLogin_out("","", 2, "Wyloguj"); ?>
			</li>
			<?php
		} ?>
		</ul>
	</div>
	<hr />
<?php } 
}?>

<?php @call_user_func('printLanguageSelector',"langselector"); ?>