<?php
class factory {

	public static function build($route) {

	
		$controllerName = strtolower($route->controller).'Controller';

		if (class_exists($controllerName) ) {
			return new $controllerName($route);
		}
		
		else if (file_exists(site::root.'pages/'.$route->controller.'.php')) {
			
			$route->controller = '';
			$route->view = $route->controller;
			return new Controller($route);
			
		}
		else {
			$route->id = $route->controller?$route->controller:site::homepage;
			$route->controller = 'index';
			$route->view = 'index';
			return new Controller($route);

		}
		
	}
	
}
?>