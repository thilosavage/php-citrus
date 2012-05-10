<?php  if (!isset($_SESSION)) exit();
/**
 *	Configuration
 * 
 *	Note: Citrus and all examples should run without any configuring
 */

 //	the path of your server root to the application folder
$cr_root = str_replace('\\','/',realpath(__DIR__)).'/';

//	the path FROM your server root to the application folder
$cr_path = str_replace($_SERVER['DOCUMENT_ROOT'],'',$cr_root);

// the base URL of the app
$cr_url = 'http://'.str_replace('//','/',$_SERVER['HTTP_HOST'].$cr_path);

 
 /**
  *	Configurations
  *
 * You can create custom config arrays for each environment of your application. 
  * For example, your localhost and production environments may have different user/pass
  * If a configuration value is the same on all instances, put it in the DEFAULT array
  */
$CR_CONFIGS = array(
	
	// configuration default values
	'DEFAULT' => array(
		
		// all constants defined in this array will be prefixed with CR_
		'CR' =>array(
			
			// CR_HOMEPAGE wil be defined as 'home'
			'HOMEPAGE' => 'home',
			
			'ROOT' => $cr_root,
			'PATH' => $cr_path,
			'URL' => $cr_url,
			
			// in case you use something other than MySQL
			'DATABASE' => 'mysql',
			
			// error reporting is all by default
			'ERROR_REPORTING' => 'E_ALL'
		),
		'MYSQL' => array(
		
			// MYSQL_URL will be defined as 'localhost'
			'URL' => 'localhost'
		)
	),
	
	// config for your localhost
	'LOCAL' => array(
		'CR' => array(
			// Defaults can be overwritten
			//'ROOT' => '/home/user/sites/myapps/app'
		),
		'MYSQL' => array(
			'USER' => 'root',
			'PASS' => '',
			'NAME' => 'citrus',
		),
		'ADMIN' => array(
			'USER' => 'admin',
			'PASS' => 'asdf1234'
		),
	),
	
	// config for your production instance
	'PRODUCTION' => array(
		'CR' => array(
			
			// turn off error reporting for production
			'ERROR_REPORTING' => 'E_NONE'
		),
		'MYSQL' => array(
			'USER' => 'root',
			'PASS' => '',
			'NAME' => 'citrus',
			'URL' => 'localhost'
		),
		'ADMIN' => array(
			'USER' => 'admin',
			'PASS' => 'asdf1234'
		),
	),
	
	// you may add configurations for additional instances of the app,
	// but be sure to tell when to use this instance below
	/*
	'DEVELOPMENT' = array(
		'MYSQL' => array(
			'USER' => 'root',
			'PASS' => '',
			'NAME' => 'citrus',
			'URL' => 'localhost'
		),		
	)
	*/
);



/**
 *	Use instance
 *
 * By default Citrus uses production configuration unless the URL is localhost
 * because often times someone may not have a local server
 */
if ($_SERVER['HTTP_HOST'] == 'localhost')
{
	$USE_CONFIG = 'LOCAL';
	//error_reporting(E_STRICT);
	
}
// come up with your own way to point Citrus to the proper config
// for example, if my dev server will always have "dev" as the sub domain -
/*
else if (preg_match("/dev\./i",$_SERVER['SERVER_NAME'])) {
	$USE_CONFIG = 'DEVELOPMENT;
}
*/
else
{
	$USE_CONFIG = 'PRODUCTION';
}


// folders to be searched by autoload
$_AUTOLOAD = array(
	"core/",
	"seeds/php/",
	"models/",
	"modules/"
);

// End of file
// config.php