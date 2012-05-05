<?php
/**********************************************

	String generation and manipulation
	
	Not to be confused with string cleaning
	
	Or spring cleaning
	
**********************************************/
class str {

	// some examples --

	// generate a random string of letters and numbers
	public static function gen($length = '10', $upperCase = true) {
		$key = '';
		($upperCase) ?
		$keyset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789":
		$keyset = "abcdefghijklmnopqrstuvwxyz0123456789";
		for ($i=0; $i<$length; $i++) $key .= substr($keyset, rand(0,strlen($keyset)-1), 1);
		return $key;
	}
	
	// clean a string to be just letters
	public static function just_letters($str){
		return preg_replace("/[^a-zA-Z]/", "", $str);
	}
}
?>