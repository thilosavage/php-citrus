<?php
/**********************************************

	All your controllers should extend Controller
	
**********************************************/
class Controller {

	protected $controller;
	protected $action;

	var $route = '';
	var $id = '';
	var $arg = '';
	var $vars = array();	
	var $view = '';
	var $layout = 'page';
	
	public function __construct($route) {

		$this->route = $route->full;
		$this->controller = $route->controller;
		$this->action = $route->action;
		$this->id = $route->id;
		$this->arg = $route->arg;

		
		
		if ($route->arg == 'js') {
		
			//$memcache = new Memcache;
			//$memcache->connect('localhost', 11211) or die ("Could not connect");
			
			header("content-type: application/x-javascript");
			echo render::library('js');
			exit;
		}
		else if ($route->arg == 'css') {
			header("content-type: text/css");
			echo render::library('css');
			exit;
		}
		
	}      

	// default page
	public function index() {
		
		
	
		$this->action = CR_HOMEPAGE;
	}
	
	public function run() {
		if (substr($this->action,0,5) == "ajax_"){
		$request = $_SERVER[ 'HTTP_X_REQUESTED_WITH' ];
		if ($request == 'XMLHttpRequest' || site::debug) {
				$this->layout = 'ajax';
			}
			else {
				exit("<p>Access denied.</p>");
			}
		}
		$this->_prepare();
		
		$this->{$this->action}($this->id);
		$this->render_page();
	}	
	
	// This is mostly to be used in extensions,
	//  but you can put default _prepare stuff here
	//  Also you can use this _prepare as well as
	//  an extension by adding
	//         self::_prepare();
	//  within the extended method
	function _prepare() {
	}
	
	protected function render_page() {
	
		if ($this->vars) {
			foreach ($this->vars as $_name => $_value) {
				$$_name = $_value;
			}		
		}	
	
		$ajaxExt = $this->layout=='ajax'?'/ajax':'';
		$path = CR_ROOT.'pages/'.$this->id.'.php';
	
		if (file_exists($path)) {
			include $path;
		}		
	}
	
	function session($key, $value = '') {
		if ($value) $_SESSION[$key] = $value;
		return isset($_SESSION[$key])?$_SESSION[$key]:false;
	}
	
	function redirect($route) {
		header('Location: '.site::url.$route);
		exit;
	}
	
	public function vars($name, $value) {
		$this->vars[$name] = $value;
	}
}
?>