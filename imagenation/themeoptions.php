<?php

class ThemeOptions {

	function ThemeOptions() {
		setThemeOptionDefault('Allow_search', true);
	}
	
	function getOptionsSupported() {
		return array(gettext('Allow search') => array('key' => 'Allow_search', 'type' => OPTION_TYPE_CHECKBOX,'desc' => gettext('Check to enable search form.')),);
	}

	function handleOption($option, $currentValue) {
	}

}

?>
