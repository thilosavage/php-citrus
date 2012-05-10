<?php  if (!isset($_SESSION)) exit();
/**
 * instantiate a controller based on the route
 * 
 */
 
class factory {

	private $route = array();

	/**
	 * Instantiate a Controller or load a static page
	 *
	 *	@param	array		Route
	 *	@return	object	Controller
	 */
	public static function build($route)
	{
				
		
		$controller = strtolower($args[0]).'Controller';		
				
		// If no Controller class exists
		if (class_exists($controller))
		{
			
			$this->route['action'] = $args[1] ? $args[1] : 'index';
			$this->route['id'] = $args[2] ? $args[2] : '';
			
			foreach ($args as $k => $arg) {
				if ($k > 2)
					$this->route['args'][] = $arg;
			}
		}
		
		// is it a page?
		if (file_exists(site::root.'pages/'.$args[0].'.php'))
		{
			
			$this->route['action']
			$controller = "Controller";
		
		}
		
		// 
		else
		{
			
			// if there is an argument for the URL, but it's neither a Controller or page
			$route->id = CR_HOMEPAGE;
			
			$route->controller = 'index';
			$route->view = 'index';
			$controller = "Controller";
			
	
		}
		
		return new $controller($this->route);
	}	
}

// End of file
// factory.php