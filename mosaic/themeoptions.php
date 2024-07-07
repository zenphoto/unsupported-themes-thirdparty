<?php
class ThemeOptions {
  var $iSupport = array('Allow_comments' => array('type' => 1, 'desc' => 'Set to enable comment section.'),
  						'Allow_search' => array('type' => 1, 'desc' => 'Set to enable search form.'),
                        'Use_Captcha' => array('type' => 1, 'desc' => 'Require <em>Captcha</em> input in comment posts.')
						);

  function ThemeOptions() {
    /* put any setup code needed here */
    setOptionDefault('Allow_comments', true);
	setOptionDefault('Allow_search', true);
	setOptionDefault('Use_Captcha', true);
  }
  
  function getOptionsSupported() {return $this->iSupport;}
  function handleOption($option, $currentValue) {}
}
?>
