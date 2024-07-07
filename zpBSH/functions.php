<?php

$curdir = getcwd();
chdir(SERVERPATH . "/themes/" . basename(dirname(__FILE__)) . "/logobg");
$filelist = safe_glob('*.png');
$themelogos = array();
foreach ($filelist as $file) {
	$themelogos[] = stripSuffix(filesystemToInternal($file));
}
chdir($curdir);

$_zp_page_check = 'checkPageValidity'; //	opt-in, standard behavior
?>