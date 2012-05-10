<?php
/**********************************************

	String generation and manipulation
	
	Not to be confused with string cleaning
	
	Or spring cleaning
	
**********************************************/
class str extends seed {

	/**
	 *	Generate random string
	 *
	 *	@arg		string	String length (default: 10)
	 *	@arg		bool		Include upper case (default: true)
	 *	@return	string	Random string of characters
	 */
	public static function gen($length = '10', $upperCase = true)
	{
		$key = '';
		($upperCase) ?
		$keyset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789":
		$keyset = "abcdefghijklmnopqrstuvwxyz0123456789";
		for ($i=0; $i<$length; $i++) $key .= substr($keyset, rand(0,strlen($keyset)-1), 1);
		return $key;
	}
	
	/**
	 * 	Strip everything but letters
	 *
	 *	@arg		string	String to be sanitized 
	 *	@return	string	Just letters
	 */
	public static function just_letters($str)
	{
		return preg_replace("/[^a-zA-Z]/", "", $str);
	}
}

// End of file
// seeds/php/str.php