<?php
$root = pathinfo(__FILE__, PATHINFO_DIRNAME);
set_include_path(get_include_path() . PATH_SEPARATOR . $root );

class driver_settings {
	var $target_browser = 'firefox';
	var $webdriver_host = 'localhost';
	//var $webdriver_host = '155.98.92.180';
	var $webdriver_port = '4444';
	var $application_url_base = 'http://coraldev.eng.utah.edu/lab/staff/';
	var $post_url = '/wd/hub';
}

class firefox_driver_settings extends driver_settings {
	var $target_browser = 'firefox';
	var $webdriver_port = '4444';
	var $post_url = '/wd/hub';
}

class chrome_driver_settings extends driver_settings {
	var $target_browser = 'chrome';
	var $webdriver_port = '9515';
	var $post_url = '/';
}

class internet_explorer_driver_settings extends driver_settings {
	var $target_browser = 'internet explorer';
	var $webdriver_port = '5555';
	var $webdriver_host = 'localhost';
	var $post_url = '/';
}

//depends on php include path being set to include the correct browser_settings.php file in browser_settings dir
//require('browser_settings.php');

//$settings = new chrome_driver_settings();
//$settings = new firefox_driver_settings();
//$settings = new internet_explorer_driver_settings();
?>
