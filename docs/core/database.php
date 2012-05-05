<?php
class database {
    private static $instance;

    private function __construct() {
		self::$instance = @mysql_connect(site::db_url,site::db_user,site::db_pass);                                                         
		@mysql_select_db(site::db_name,self::$instance);
		if (mysql_error()) {
			echo mysql_error();
		}
	}
    public static function db(){
        if (!self::$instance){
            self::$instance = new database();
        }
        return self::$instance;
    }
	
	public static function query($query){
	
		$q = mysql_query($query);
	
		$err = mysql_error();
		
		if ($err) {
			
			if (strpos($err, 'nknown column' )) {
				
				$ex = explode('\'', $err);
			
				$colname = $ex[1];
		
				if ($colname == 'time') {
					$type = "ALTER TABLE `items` ADD `time` INT NOT NULL";
				}
				else {
					$type = "ALTER TABLE `items` ADD `".$colname."` VARCHAR( 255 ) NOT NULL";
				}
				mysql_query($type);
				$q = mysql_query($query);
			}
		}
		return $q;
	}
	
	public static function models() {
	
		$models = '';
		$directory = opendir(site::root.'models');
		
		while($file = readdir($directory)) {
			$dirs[] = $file;
			if (strlen($file) > 2) {
				$bits = explode(".",$file);
				$key = $bits[0];
				$val = $file;
				$models[$key] = $file;
			}
		}
		closedir($directory);
		return $models;
	}
}  
?>