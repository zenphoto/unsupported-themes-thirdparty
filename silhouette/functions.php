<?php
function getValidProtectedImageURL($image=NULL, $disposal=NULL) {
	$uri = str_replace( "&amp;", "!amp!", getProtectedImageURL($image, $disposal));
	$escaped_uri = str_replace( "&", "&amp;", $uri);
	return str_replace( "!amp!", "&amp;", $escaped_uri);
}

function printGoogleAnalytics($theme) {
	if( strlen(getThemeOption("GoogleAnalytics", NULL, $theme))>0 ){
		echo "<script src='http://www.google-analytics.com/ga.js' type='text/javascript'></script>\n";
		echo "<script type='text/javascript'>\n";
		echo "//<![CDATA[\n";
		echo "var pageTracker = _gat._getTracker('".getThemeOption("GoogleAnalytics", NULL, $theme)."');\n";
		echo "pageTracker._initData();\n";
		echo "pageTracker._trackPageview();\n";
		echo "//]]>\n";
		echo "</script>\n";
	}
}

function printTitleMenu($theme) {
	if( strlen(getThemeOption("TitleMenu", NULL, $theme))>0 ){
		echo "<h2>";
		$links = explode("|", getThemeOption("TitleMenu", NULL, $theme) );
        for($k = 0; $k < count($links); $k+=2){
			echo "<a href='".$links[$k]."'>".$links[$k+1]."</a>";
			if( $k+2 < count($links) ){
				echo " | ";
			}
		}
		echo "</h2>\n";
	}
}
?>