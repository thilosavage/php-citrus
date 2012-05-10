<?php 
/**
 *	Citrus
 *
 *	A bare bones skeleton for building fast and easy AJAX apps
 *	@author Thilo Savage <thilosavage@gmail.com>
 *	@copyright Thilo Savage 2012
 */

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
				define($k."_".$k, $CR_CONFIGS[$USE_CONFIG][$k]);
				//echo $k."_".$k.": ".$CR_CONFIGS[$USE_CONFIG][$k]." CHANGED<br>";
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

// set include path to Citrus app's root
set_include_path(CR_ROOT);


 // array of folders to be searched by autoload
$_AUTOLOAD = array(
	"core/",
	"seeds/php/",
	"models/",
	"modules/"
);
require_once('core/__autoload.php');


$route = new route();

$controller = factory::build($route);

$controller->run($route);

exit;
// eof