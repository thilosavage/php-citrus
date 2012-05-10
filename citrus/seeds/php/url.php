<?php

class url {

	/**
	 *	Get current URL
	 *
	 *	@return	string	URL
	 */
	public static function get()
	{

		$pageURL = 'http';
		if (@$_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80")
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		else
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		
		return $pageURL;
	}
}

// End of file
// seeds/php/url.php