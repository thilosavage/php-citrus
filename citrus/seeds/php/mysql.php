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

	// generate query
	public static function query($query)
	{
		$q = mysql_query($query);
		
		/**
		 * If you try to act on a field that doesn't exist,
		 *	the field is created as a VARCHAR(255) by default
		 *	or, if it's named 'time', it is set as an int
		 */
		$err = mysql_error();
		
		if ($err && CR_DATABASE == 'mysql')
		{
			if (strpos($err, 'nknown column' ))
			{	
				$ex = explode('\'', $err);
			
				$colname = $ex[1];
		
				if ($colname == 'time')
					$type = "ALTER TABLE `items` ADD `time` INT NOT NULL";
				else
					$type = "ALTER TABLE `items` ADD `".$colname."` VARCHAR( 255 ) NOT NULL";
				mysql_query($type);
				
				// redo query
				$q = mysql_query($query);
			}
		}
		return $q;
	}	
	public static function insert_id()
	{
		return mysql_insert_id();
	}
	
	public static function escape($str)
	{
		return mysql_real_escape_string($str);
	}
	
	public static function truncate()
	{
		$this->db->query('TRUNCATE TABLE `'.$this->table.'`');
	}
	
	public static function get_fields()
	{

		$res = mysql_query('SHOW COLUMNS FROM '.$this->table);
		$fields = array ();
		while ($row = @ mysql_fetch_object($res)) {
			$fields[$row->Field] = $row->Type;
		}
		@mysql_free_result($res);
		return $fields;
		
	}

	/**
	 * Generate a model and table
	 *
	 */
	public static function generate_table($tableName)
	{
		$db = mysql::db();
		
		$tableName = strtolower($tableName);
		
		// inflect ys to y or ies to y
		$inflect = substr($tableName,-3,2);
		
		if ($inflect == 'ie' && strlen($tableName) > 4) 
			$idName = substr($tableName,0,-3)."y";
		else 
			$idName = substr($tableName,0,-1);
		
		// create the table if it doesn't exist
		if (CR_DATABASE == 'mysql')
		{
			if(! mysql_num_rows( mysql_query("SHOW TABLES LIKE '".$tableName."'")))
			{
				$db->query("CREATE TABLE `citrus`.`".$tableName."` (
				`".$idName."_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY
				) ENGINE = MYISAM ; ");		
			}		
		}

		// create the model file if it doesn't exist
		if (!file_exists($tableName))
		{
			// add a class with the table and id
			$modelFileData = "";
			$modelFileData .= "<?php \n";
			$modelFileData .= "class ".ucwords($tableName)." extends Model {\n";
			$modelFileData .= "	protected \$table = '".$tableName."';\n";
			$modelFileData .= "	protected \$id_field = '".$idName."_id';\n";	
			$modelFileData .= "}";
			
			$modelFileName = CR_ROOT."models/".ucwords($tableName).".php";		
			
			$file = fopen($modelFileName, 'w');
			fwrite($file, $modelFileData);
			fclose($file);
		}	
	}
}

// End of File
// seeds/php/mysql.php	