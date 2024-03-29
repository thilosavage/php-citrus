<?php
// create route object from: website.com/[controller]/[view]/[id]
// feel free to mess with this if you desire to destroy your website's functionality
class route {
	var $route;
	var $controller = '';
	var $action = '';
	var $id = '';
	var $arg = '';
	var $full = '';
	public function __construct() {
	
		$this->route = self::get();
		$this->action = CR_HOMEPAGE;
		
		$this->full = $this->route;
		$urlArgs = explode('/', $this->route);

		
		if (!empty($urlArgs[0])){
			$hasController = explode("?",$urlArgs[0]);
			$this->controller =$hasController[0];
		}

		if (!empty($urlArgs[1])){
			$hasAction = explode("?",$urlArgs[1]);
			$this->action = $hasAction[0];
		}
		else {
			$this->action = 'index';
		}
		
		if (!empty($urlArgs[2])){
			$hasID = explode("?",$urlArgs[2]);
			$this->id = ($hasID[0])?$hasID[0]:'';
		}
		
		// use a page instead of controller
		if ((!$this->controller || !class_exists($this->controller.'Controller'))) {
			
			$this->id = $this->controller?$this->controller:CR_HOMEPAGE;
			$this->arg = $this->action;
			$this->action = 'index';
			$this->controller = '';
		}
	
	}
	
	// get your route
	public static function get() {
		$pageURL = 'http';
		//JD made the assumption we would never use https. 
		//the code for it is directly below, commented out, incase we ever use it.
		//if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		}
		else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}

		$pageURL = str_replace(CR_URL,"",$pageURL, $filtered);

		if (!$filtered){
			$pageURL = str_replace(str_replace('www.','',CR_URL),'',$pageURL, $filtered);
		}
		
		if (!$filtered){
			//error::url_error();
		}

		return $pageURL;
	}	
}
?>