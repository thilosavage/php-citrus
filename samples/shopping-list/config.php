<?php

// default configuration
$CR_DB['url'] = 'localhost';
$CR_DB['user'] = 'root';
$CR_DB['pass'] = '';
$CR_DB['name'] = 'citrus';

$CR_CONFIG['admin'] = 'admin';

$CR_CONFIG['pass'] = '123';

$CR_CONFIG['homepage'] = 'home';

error_reporting(E_STRICT);

if ($_SERVER['HTTP_HOST'] == 'localhost') {
	$CR_CONFIG['mode'] = 'dev';
	error_reporting(E_ALL);
}
else {
	$CR_DB['server'] = 'localhost';
	$CR_DB['name'] = 'root';
	$CR_DB['pass'] = 'pass';
	$CR_CONFIG['pass'] = 'awegw!!e$g';
	$CR_CONFIG['mode'] = 'live';
	ini_set('display_errors', 0);
}
	
// create the site constants
// site::url  			URL of the site
// site::root 			site root
// site::img			image root
$d = "\$_CONFIG = preg_replace(\"/\/public\/([a-zA-Z\/.]*)/\",\"\",\$_SERVER['SCRIPT_FILENAME']);";;
eval($d);
$_ROOT = str_replace('index.php','',$_CONFIG).'/';
$_ROOT = str_replace('//','/',$_ROOT);
$_SCR= str_replace($_SERVER['DOCUMENT_ROOT'],'',$_ROOT);
$_HOST = "http://".str_replace('//','/',$_SERVER['HTTP_HOST'].$_SCR);

$def = "class site { const root = '".$_ROOT."';\n";
$def .= "const url = '".$_HOST."';";
$def .= "const img = '".$_HOST."images/';";
$def .= "const homepage = '".$CR_CONFIG['homepage']."';";
$def .= "const admin = '".$CR_CONFIG['admin']."';";
$def .= "const pass = '".$CR_CONFIG['pass']."';";
$def .= "const mode = '".$CR_CONFIG['mode']."';";
$def .= "const db_url = '".$CR_DB['url']."';";
$def .= "const db_user = '".$CR_DB['user']."';";
$def .= "const db_pass = '".$CR_DB['pass']."';";
$def .= "const db_name = '".$CR_DB['name']."';";

$def .= "}";
eval($def);

/**********************************************
	
	Folders to be auto-loaded
	Never require classes anymore
	
	
**********************************************/

$_AUTOLOAD[] = "helpers/";
$_AUTOLOAD[] = "citrus/";
$_AUTOLOAD[] = "models/";
$_AUTOLOAD[] = "modules/";
require_once(site::root.'citrus/__autoload.php');

?>