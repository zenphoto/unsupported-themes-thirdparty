<?php
// force UTF-8
/* Plug-in for theme option handling
 * The Admin Options page tests for the presence of this file in a theme folder
 * If it is present it is linked to with a require_once call.
 * If it is not present, no theme options are displayed.
 *
 */
class ThemeOptions {

	function __construct() {
		// force core theme options for this theme
		setThemeOption('albums_per_row',3,null,'zpskeleton');
		setThemeOption('images_per_row',8,null,'zpskeleton');
		setThemeOption('thumb_size',220,null,'zpskeleton');
		setThemeOption('image_size',630,null,'zpskeleton');
		setThemeOption('image_use_side','longest',null,'zpskeleton');
		setThemeOption('custom_index_page',null,null,'zpskeleton');

		// set core theme option defaults
		setThemeOptionDefault('albums_per_page',6);
		setThemeOptionDefault('images_per_page',9);
		setThemeOptionDefault('thumb_transition',2);
		setThemeOptionDefault('thumb_crop',0);

		// set theme option defaults
		setThemeOptionDefault('zpskel_usenews', true);
		setThemeOptionDefault('zpskel_debuguser', false);
		setThemeOptionDefault('zpskel_disablewarning', false);
		setThemeOptionDefault('zpskel_pptarget', 'sized');
		setThemeOptionDefault('zpskel_strip', 'latest');
		setThemeOptionDefault('zpskel_thumbsize', 'large');
		setThemeOptionDefault('zpskel_download', true);
		setThemeOptionDefault('zpskel_archive', true);
		setThemeOptionDefault('zenpage_homepage', 'none');
		if (class_exists('cacheManager')) {
			cacheManager::deleteCacheSizes('zpskeleton');
			cacheManager::addCacheSize('zpskeleton',null,420,200,420,200,null,null,null,true,getOption('Image_watermark'),false,false); // album thumbs
			cacheManager::addCacheSize('zpskeleton',220,null,null,null,null,null,null,true,getOption('Image_watermark'),false,false); // image thumbs: uncropped large
			cacheManager::addCacheSize('zpskeleton',190,null,null,null,null,null,null,true,getOption('Image_watermark'),false,false); // image thumbs: uncropped small
			cacheManager::addCacheSize('zpskeleton',null,190,190,190,190,null,null,true,getOption('Image_watermark'),false,false); // bottom image strip
			cacheManager::addCacheSize('zpskeleton',420,null,null,null,null,null,null,false,getOption('fullimage_watermark'),null,null); // mobile full
			cacheManager::addCacheSize('zpskeleton',630,null,null,null,null,null,null,false,getOption('fullimage_watermark'),null,null); // desktop full
		}
	}

	function getOptionsSupported() {
		return array(
			gettext('Use News Feature') => array('key' => 'zpskel_usenews', 'type' => OPTION_TYPE_CHECKBOX,
				'order' => 5,
				'desc' => gettext("IF you have the Zenpage plugin enabled, you can uncheck this to NOT use the news feature of the Zenpage plugin (use only pages)")),
			gettext('Thumb Size') => array('key' => 'zpskel_thumbsize', 'type' => OPTION_TYPE_RADIO,
				'order' => 4,
				'buttons' => array(gettext('Large')=>'large', gettext('Small')=>'small'),
				'desc' => gettext('Choose the relative thumb size for the album and search pages.')),
			gettext('Debug User Agent') => array('key' => 'zpskel_debuguser', 'type' => OPTION_TYPE_CHECKBOX,
				'order' => 1,
				'desc' => gettext("Check to display user information in the footer for debugging mobile displays.")),
			gettext('Disable Plugin Warning') => array('key' => 'zpskel_disablewarning', 'type' => OPTION_TYPE_CHECKBOX,
				'order' => 0,
				'desc' => gettext("Check to disable the warning message about disabling plugins on the index page.  If you see no warning, you should also check this as well to eliminate the plugin verifications.")),
			gettext('Popup (PrettyPhoto) Target') => array('key' => 'zpskel_pptarget', 'type' => OPTION_TYPE_RADIO,
				'order' => 2,
				'buttons' => array(gettext('Sized (630px)')=>'sized', gettext('Original Image')=>'original'),
				'desc' => gettext("Select whether the popup script (PrettyPhoto) targets a processed/sized image for the slideshow or the original (unsized/uprocessed) uploaded image.  Although not used on mobile decives, this will decrease your load time if you select sized.  You need to also select sized if you are using watermarks.")),
			gettext('Download Button') => array('key' => 'zpskel_download', 'type' => OPTION_TYPE_CHECKBOX,
				'order' => 6,
				'desc' => gettext("Check to display a download button on the image page, behavour controlled by options->image->Full Image Protection.")),
			gettext('Show Archive') => array('key' => 'zpskel_archive', 'type' => OPTION_TYPE_CHECKBOX,
				'order' => 7,
				'desc' => gettext("Check to display the gallery and news archive menu item.")),
			gettext('Homepage') => array('key' => 'zenpage_homepage', 'type' => OPTION_TYPE_CUSTOM,
				'order' => 8,
				'desc' => gettext("Choose here any <em>un-published Zenpage page</em> (listed by <em>titlelink</em>) to act as your site's homepage instead the normal gallery index.")),

			gettext('Image Strip') => array('key' => 'zpskel_strip', 'type' => OPTION_TYPE_RADIO,
				'order' => 3,
				'buttons' => array(gettext('Latest Images')=>'latest', gettext('Random Images')=>'random'),
				'desc' => gettext("Select whether the image strip on the bottom shows random images or latest images.")),
			gettext('Custom CSS') => array('order'=>9, 'key' => 'zpskel_customcss', 'type' => OPTION_TYPE_TEXTAREA, 'desc' => gettext('Enter any custom CSS, safely carries over upon theme upgrade.'))


		);
	}

	function getOptionsDisabled() {
		return array('thumb_size','image_size','image_use_side1','image_use_side2','image_use_side3','image_use_side4','custom_index_page');
	}

	function handleOption($option, $currentValue) {
		global $_zp_db;
		if($option == "zenpage_homepage") {
			$unpublishedpages = $_zp_db->queryFullArray("SELECT titlelink FROM ".$_zp_db->prefix('pages')." WHERE `show` != 1 ORDER by `sort_order`");
			if(empty($unpublishedpages)) {
				echo gettext("No unpublished pages available");
				// clear option if no unpublished pages are available or have been published meanwhile
				// so that the normal gallery index appears and no page is accidentally set if set to unpublished again.
				setOption("zenpage_homepage", "none", false);
			} else {
				echo '<input type="hidden" name="'.CUSTOM_OPTION_PREFIX.'selector-zenpage_homepage" value="0" />' . "\n";
				echo '<select id="'.$option.'" name="zenpage_homepage">'."\n";
				if($currentValue === "none") {
					$selected = " selected = 'selected'";
				} else {
					$selected = "";
				}
				echo "<option$selected>".gettext("none")."</option>";
				foreach($unpublishedpages as $page) {
					if($currentValue === $page["titlelink"]) {
						$selected = " selected = 'selected'";
					} else {
						$selected = "";
					}
					echo "<option$selected>".$page["titlelink"]."</option>";
				}
				echo "</select>\n";
			}
		}
	}
}
?>
