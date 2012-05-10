<?php
/**
 *	Mysql DAL 
 *
 */
class mysql {
    private static $instance;

	/**
	 *	Blah
	 */
    private function __construct() {	

		self::$instance = @mysql_connect(MYSQL_URL,MYSQL_USER,MYSQL_PASS);                                                         
		@mysql_select_db(MYSQL_NAME,self::$instance);
		if (mysql_error()) {
			echo mysql_error();
		}
	}
    public static function db(){
        if (!self::$instance){
            self::$instance = new mysql();
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

	public static function insert_id() {
		return mysql_insert_id();
	}
	
	public static function escape($str) {
		return mysql_real_escape_string($str);
	}
	
	public static function truncate() {
		$this->db->query('TRUNCATE TABLE `'.$this->table.'`');
	}
	
	public static function get_fields() {

		$res = mysql_query('SHOW COLUMNS FROM '.$this->table);
		$fields = array ();
		while ($row = @ mysql_fetch_object($res)) {
			$fields[$row->Field] = $row->Type;
		}
		@mysql_free_result($res);
		return $fields;
		
	}
	
	public static function models() {
	
		$models = '';
		$directory = opendir(CR_ROOT.'models');
		
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