<?php  if (!isset($_SESSION)) exit();

/**
 *	Create route
 *
 *	@brief Break the URL into the page route - website.com/[controller]/[view]/[id]
 */

class route {

	protected $full,
		$args = array(),
		$paths;
	
	function __construct()
	{
	
		$url = $this->getUrl();
		
		// get rid of everything after a question mark
		$stripGetArgs = explode('?', $url);
		
		// separate the remaining URL string by slashes
		$urlArgs = explode('/', $stripGetArgs[0]);

		$this->args = $urlArgs;

	}
	
	// get your route
	public static function getUrl()
	{
		
		$pageURL = url::get();

		$pageURL = str_replace(CR_URL,"",$pageURL, $filtered);

		if (!$filtered)
			$pageURL = str_replace(str_replace('www.','',CR_URL),'',$pageURL, $filtered);
		
		if (!$filtered)
		{
			//error::url_error();
		}

		return $pageURL;
	}	
}
?>