<?php 
/**
 * Citrus
 *
 * Bare bones skeleton for your small AJAX app
 *
 * @package		Citrus
 * @author		Thilo Savage
 * @copyright	Copyright (c) 2012, Kiosk
 * @license		http://www.citruslab.com/license
 * @link			http://www.citruslab.com
 */

 
 
 
 
 
 
 
/**
 * Set client character set
 *
 * @access	public
 * @param	string
 * @param	string
 * @return	resource
 */
function blah($a, $b) {
	return $a;
}




 
 
session_start();

/**
 *	Citrus is plug-and-play
 * However, if you run into problems, or your app uses a database,
 * you'll have to set the values in the config.php file
 */
include('config.php');



// convert the configuration array into constants
foreach ($CR_CONFIGS['DEFAULT'] as $key => $val) {
	if (is_array($val)) {
		foreach ($val as $k => $v) {
			if (isset($CR_CONFIGS[$USE_CONFIG][$k])) {
				define($key."_".$k, $CR_CONFIGS[$USE_CONFIG][$k]);
				//echo $key."_".$k.": ".$CR_CONFIGS[$USE_CONFIG][$k]." CHANGED<br>";
			}
			else {
				define($key."_".$k, $v);
				//echo $key."_".$k.": ".$v."<br>";
			}
		}
	}
	else {
		if (isset($CR_CONFIGS[$USE_CONFIG][$key])) {
			define($key, $CR_CONFIGS[$USE_CONFIG][$key]);
			//echo $key.": ".$CR_CONFIGS[$USE_CONFIG][$key]." CHANGED<br>";
		}
		else {
			define($key, $val);
			//echo $key.": ".$val."<br>";
		}
	}
}

foreach ($CR_CONFIGS[$USE_CONFIG] as $key => $val) {
	if (is_array($val)) {
		foreach ($val as $k => $v) {
			if (!defined($key."_".$k)) {
				define($key."_".$k, $v);
				//echo $key."_".$k.": ".$v."<br>";
			}
		}
	}
	else {
		if (!defined($key)) {
			define($key, $CR_CONFIGS[$USE_CONFIG][$key]);
			//echo $key.": ".$CR_CONFIGS[$USE_CONFIG][$key]." CHANGED<br>";
		}
	}
}

// set include path to Citrus app's root
set_include_path(CR_ROOT);

// set error reporting based on config
error_reporting(constant(CR_ERROR_REPORTING));

require_once('core/__autoload.php');


$controller = factory::build(new route);

$controller->run();

exit;
// eof