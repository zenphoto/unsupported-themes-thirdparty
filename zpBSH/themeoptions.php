<?php

// force UTF-8 Ø

/* Plug-in for theme option handling
 * The Admin Options page tests for the presence of this file in a theme folder
 * If it is present it is linked to with a require_once call.
 * If it is not present, no theme options are displayed.
 *
 */
 
require_once(dirname(__FILE__).'/functions.php');

class ThemeOptions {

	function ThemeOptions() {
		$me = basename(dirname(__FILE__));	
		setThemeOptionDefault('albums_per_page', 6);
		setThemeOptionDefault('albums_per_row', 2);	
		setThemeOptionDefault('images_per_page', 6);
		setThemeOptionDefault('images_per_row', 3);		
		setThemeOptionDefault('image_size', 560);
		setThemeOptionDefault('image_use_side', 'longest');
		setThemeOptionDefault('thumb_size', 182);
		setThemeOptionDefault('thumb_crop_width', 182);
		setThemeOptionDefault('thumb_crop_height', 182);		
		setThemeOptionDefault('thumb_crop', 1);
		setThemeOptionDefault('thumb_transition', 1);	
		setThemeOptionDefault('custom_index_page', '');	
		
		setOptionDefault('colorbox_' . $me . '_album', 1);
		setOptionDefault('colorbox_' . $me . '_image', 1);
		setOptionDefault('colorbox_' . $me . '_search', 1);				
		
		setThemeOptionDefault('Allow_search', true);
		setThemeOptionDefault('Archive', true);
		setThemeOptionDefault('Contact', true);
		setThemeOptionDefault('Pagelink', true);
		setThemeOptionDefault('Newslink', true);
		setThemeOptionDefault('Register', true);
		setThemeOptionDefault('Use_thickbox', true);
		setThemeOptionDefault('Theme_logo', 'palmy01');
		
		if (class_exists('cacheManager')) {
			cacheManager::deleteThemeCacheSizes($me);
			cacheManager::addThemeCacheSize($me, getThemeOption('image_size'), NULL, NULL, NULL, NULL, NULL, NULL, false, getOption('fullimage_watermark'), 
				NULL, NULL);
			cacheManager::addThemeCacheSize($me, getThemeOption('thumb_size'), NULL, NULL, getThemeOption('thumb_crop_width'),
				getThemeOption('thumb_crop_height'), NULL, NULL, true, getOption('Image_watermark'), NULL, NULL);
		}			

	}
	function getOptionsSupported() {	
		return array(
			gettext('Allow search') => array(
				'key' => 'Allow_search', 
				'type' => OPTION_TYPE_CHECKBOX, 
				'order' => 0, 
				'desc' => gettext('Check to enable search form.')
			),
            gettext_th('Main menu links', 'zpBSH') => array(
                'key' => 'Sidebar_links',
                'type' => OPTION_TYPE_CHECKBOX_UL,
                'order' => 1,
                'checkboxes' => array( // The definition of the checkboxes
                    gettext('Archive')=>'Archive',
                    gettext('Contact')=>'Contact',
                    gettext('All news')=>'Newslink',
                    gettext('Pages')=>'Pagelink',
                    gettext('Register')=>'Register'
                    ),
                'desc' => gettext_th('Selection of items to the gallery main menu.', 'zpBSH')
            ),
			gettext('Use Colorbox') => array(
				'key' => 'Use_thickbox', 
				'type' => OPTION_TYPE_CHECKBOX, 
				'order' => 2,
				'desc' => gettext('Check to display of the full size image with Colorbox.')
			),
			gettext('Theme logo') => array(
				'key' => 'Theme_logo', 
				'type' => OPTION_TYPE_CUSTOM, 
				'order' => 3,
				'desc' => gettext_th("Select picture of the theme banner. Should have size 820x162 px, format '.png' and located in 'logobg' folder.", 'zpBSH'))                        			
		);
	}

  	function getOptionsDisabled() {
		return array('custom_index_page');
	}

	function handleOption($option, $currentValue) {		
		global $themelogos;
		if ($option == 'Theme_logo') {
			echo '<select id="EF_themeselect_colors" name="' . $option . '"' . ">\n";
			generateListFromArray(array($currentValue), $themelogos, false, false);
			echo "</select>\n";
		}	
	}
}
?>