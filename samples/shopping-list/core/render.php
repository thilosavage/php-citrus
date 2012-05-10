<?php

/**
 * Render page page elements and seeds
 *
 */
class render {


	/**
	 * Render a module
	 *
	 *	Modules are found in /public/modules/
	 *
	 *	arg 	string	Module name
	 *	arg	array		Data passed to module
	 */
	public static function module($moduleName, $data = array()) {
	
		ob_start();
		include(CR_ROOT.'modules/'.$moduleName.'.php');
		$module = ob_get_contents();
		ob_end_clean();
		return $module;
	
	}
	
	public static function shells() {
	
	
		
		$shells = func_get_args();
		foreach ($shells as $shell) {
			include(CR_ROOT.'modules/'.$shell.'/'.$shell.'.shells.php');
		}
		
		ob_start();
		$shells = ob_get_contents();
		ob_end_clean();

		return $shells;
	
	}	

	/**
	 * @brief Render server-side libraries
	 *
	 *	@arg	string	All seeds and modules of this extension will be rendered
	 */
	public static function library($type) {
		
		$code = '';
		$handler = opendir(CR_ROOT.'seeds/'.$type);
		while ($file = readdir($handler)) {
			if ($file != '.' && $file != '..' && strpos($file,'.'))
				$files[] = $file;
		}
		closedir($handler);
		foreach ($files as $fileName){
			$path = CR_ROOT.'seeds/'.$type.'/'.$fileName;
			ob_start();
			include($path);
			$output = ob_get_clean(); 	
			$code .= $output;
		}

		$handler = opendir(CR_ROOT.'modules');
		
		while ($fileName = readdir($handler)){
			if ($fileName != '.' && $fileName != '..' && !strpos($fileName,'.')) {
				$path = CR_ROOT.'modules/'.$fileName."/".$fileName.".".$type;
				if (file_exists($path)) {
					ob_start();
					include($path);
					$output = ob_get_clean(); 	
					$code .= $output;
				}
			}
		}
		return $code;
	}

	
}
?>