<?php
/**
 * Autoload
 *
 *	The directories for autoloading are set in /config.php
 *
 *	If a class is not found, it gives the option to create a
 *	model and db table for the class
 */
 
function __autoload($class_name)
{	
	global $_AUTOLOAD;
	$found = false;
	foreach ($_AUTOLOAD as $directory){

			
		/**
		 * Search in the modules folders for a Controller
		 *
		 */
		$tmp = $class_name;
		if (strpos($class_name,'Controller')) {
			$srt = strtolower(str_replace('Controller','',$class_name));
			$tmp = $srt."/".$srt."Controller";
		}

		/**
		 * Standard autoloading
		 *
		 */
		if (file_exists(CR_ROOT.$directory.$tmp.'.php')){
			require_once CR_ROOT.$directory.$tmp .'.php';
			$found = true;
			break;
		}
	}

	 // If a class is not found, offer to create it
	if (!$found)
	{
		// button to create class has been clicked
		if (isset($_POST['generateClass']))
		{	
			database::generate_table($class_name);
			require_once CR_ROOT.'models/'.$class_name .'.php';		
		}
		else
		{
			// Offer to create model
			$button = "Click here to create /models/".$class_name.".php and a table called ".strtolower($class_name);
			$createModel = "<b>Citrus Error</b> - The class <em>".$class_name."</em> was not found.<p>";
			$createModel .= "<form method='post'><input type='submit' name='generateClass' value='".$button."'></form></em>";
				
			throw new Exception($createModel);
			exit;
		}
	}
}
?>