<?php
/**********************************************

	Write to a log file in times of need
	
	Put:
		log::set($string for the log file); 
	
	and you can find the log file in the site's main directory
	
	You can write a custom log file with:
		log::write($data,$file,$path);
	
	To record an error, do
		log::error('There was an error.....);
	
	The difference between the error and the log is that
	the log file will write everything at the end of script execution
	if the script fails, nothing will be written to the log
	
	The error will write itself as long as the script gets to the error
	
**********************************************/


class log {
	static $data;
	public static function set($data){
		self::$data .= $data."\r\n";
	}
	
	public static function error($data){
		$num = rand(1000,2000);
		$errorNum = '';
		if (class_exists('site')){
			$errorNum = site::debug?"[error#".$num."]":"Turn debug mode on to enable logging. Be sure to turn it off when you're done.";
		}
		$data = $data."\r\n".$errorNum;
		self::write($data,"error.txt");
	}

	public static function write($data='', $file = "log.txt", $path = ''){
		$data = $data?$data:self::$data;
		$doc_root = class_exists('site')?site::root:'';
		$Handle = fopen($doc_root.$path.$file, 'w');
		$num = rand(1000,2000);
		$errorNum='';
		if ($file == "log.txt" && $path == ''){
			$errorNum = class_exists('site')?"[log#".$num."]":"Turn debug mode on to enable logging. Be sure to turn it off when you're done.";
		}
		fwrite($Handle, $data.$errorNum);
		fclose($Handle);
	}
}
?>