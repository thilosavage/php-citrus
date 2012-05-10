<?php  if (!isset($_SESSION)) exit();

/**
 * Controller
 *
 */
 
class Controller {

	private
		$route,
		$controller,
		$id,
		$page,
		$args = array(),
		
		$vars = array();

	/**
	 * Constructor
	 *
	 *	@param	 array	Route elements
	 *
	 */	
	public function __construct($route)
	{
	
		$this->route = $route;
		
		
		if ($this->route->arg == 'js')
		{	
			header("content-type: application/x-javascript");
			echo render::library('js');
			exit;
		}
		else if ($this->route->arg == 'css')
		{
			header("content-type: text/css");
			echo render::library('css');
			exit;
		}
	}      

	// default page
	public function index()
	{
		$this->route->action = CR_HOMEPAGE;
	}

	/**
	 * Run Action
	 *
	 */
	public function run()
	{
		$this->_prepare();		
		$this->{$this->route->action}($this->route->id);
		$this->render_page();
	}	
	
	/**
	 * Execute code before action is run
	 */
	function _prepare()
	{
	}
	
	protected function render_page()
	{
		if ($this->vars)
		{
			foreach ($this->vars as $_name => $_value)
				$$_name = $_value;
		}	
	
		$path = CR_ROOT.'pages/'.$this->route->id.'.php';
	
		if (file_exists($path))
			include $path;
	}

	/**
	 * Redirect
	 *
	 *	@param	string	URL to redirect
	 */	
	function redirect($route)
	{
		header('Location: '.site::url.$route);
		exit;
	}

	/**
	 * Send vars to View
	 *
	 *	@param	string	Var name
	 *	@param	string	Value
	 */		
	public function vars($name, $value)
	{
		$this->vars[$name] = $value;
	}
}

// End of file
// core/Controller.php