<?php


/**********************************************

	Automatically require classes
	
	You don't have to require_once to instantiate
	an object. Just instantiate/reference the class
	
	If you're ever typing require_once(a_class_file.php);
	You are adding unnecessary effort
	
	The autoload wil only scan folders in the $_AUTOLOAD array
	
	To add folders to this array
	go into Application/config.php
	
**********************************************/

function __autoload($class_name) {
	
	
	global $_AUTOLOAD;
	$found = false;
	foreach ($_AUTOLOAD as $directory){
	

	
		$tmp = $class_name;
		if (strpos($class_name,'Controller')) {
			
			$srt = strtolower(str_replace('Controller','',$class_name));
			
			$tmp = $srt."/".$srt."Controller";
			
		}
		
		
		
		if (file_exists(CR_ROOT.$directory.$tmp.'.php')){
			
			require_once CR_ROOT.$directory.$tmp .'.php';
			$found = true;
			break;
		}
	}

	if (!$found && $class_name == ucwords($class_name) && CR_DATABASE == 'mysql') {	
		
		$db = mysql::db();
		
		$tableName = strtolower($class_name);
		
		// inflect ys to y or ies to y
		$inflect = substr($tableName,-3,2);
		if ($inflect == 'ie' && strlen($tableName) > 4) {
			$idName = substr($tableName,0,-3)."y";
		}
		else {
			$idName = substr($tableName,0,-1);
		}
		
		if(! mysql_num_rows( mysql_query("SHOW TABLES LIKE '".$tableName."'"))) {
			$db->query("CREATE TABLE `citrus`.`".$tableName."` (
			`".$idName."_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY
			) ENGINE = MYISAM ; ");		
		}		
		
		$modelFileData = "";
		$modelFileData .= "<?php \n";
		$modelFileData .= "class ".ucwords($class_name)." extends Model {\n";
		$modelFileData .= "	protected \$table = '".$tableName."';\n";
		$modelFileData .= "	protected \$id_field = '".$idName."_id';\n";	
		$modelFileData .= "}";
		
		$model_file = CR_ROOT."models/".ucwords($tableName).".php";

		if (!file_exists($model_file)){
			$file = fopen($model_file, 'w') or die("can't open file");
			fwrite($file, $modelFileData);
			fclose($file);
		}
		
		require_once CR_ROOT.'models/'.$class_name .'.php';
		
	}
}
?>