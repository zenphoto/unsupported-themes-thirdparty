<?php
if (!defined('WEBPATH')) die(); $themeResult = getTheme($zenCSS, $themeColor, 'dark');
$schema = $_SERVER['SERVER_PORT']=='443'?'https':'http';
$host = strlen($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:$_SERVER['SERVER_NAME'];
header("Location: " . $schema . "://" . $host . getAlbumLinkURL() . "#" . (imageNumber()-1));
?>