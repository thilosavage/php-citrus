<?php
class render {
	function view($view, $data = array()) {
	
		ob_start();
		
		$g = explode('/',$view, 2);
		if ($g[0] == 'common') {
			include(CR_ROOT.'helper_html/'.$g[1].'.php');
		}
		else {
			include(CR_ROOT.'modules/'.$view.'.php');
		}
		
		$bah = ob_get_contents();
		ob_end_clean();
		return $bah;
	
	}
	
	function js() {
	
		$handler = opendir(CR_ROOT.'seeds/js');
		while ($file = readdir($handler)) {
			if ($file != '.' && $file != '..' && strpos($file,'.'))
				$files[] = $file;
		}
		closedir($handler);
		foreach ($files as $fileName){
			$path = CR_ROOT.'seeds/js/'.$fileName;
			ob_start();
			include($path);
			$output = ob_get_clean();
			echo $output;
		}

		$handler = opendir(CR_ROOT.'modules');
		
		while ($fileName = readdir($handler)){
			if ($fileName != '.' && $fileName != '..' && !strpos($fileName,'.')) {
				$path = CR_ROOT.'modules/'.$fileName."/".$fileName.".js";
				ob_start();
				include($path);
				$output = ob_get_clean();
				echo $output;
			}
		}

	}
	
	
	function css() {

		$handler = opendir(CR_ROOT.'seeds/css');
		while ($file = readdir($handler)) {
			if ($file != '.' && $file != '..' && strpos($file,'.'))
				$files[] = $file;
		}
		closedir($handler);
		foreach ($files as $fileName){
			$path = CR_ROOT.'seeds/css/'.$fileName;
			ob_start();
			include($path);
			$output = ob_get_clean(); 	
			echo $output;
		}

		$handler = opendir(CR_ROOT.'modules');
		
		while ($fileName = readdir($handler)){
			if ($fileName != '.' && $fileName != '..' && !strpos($fileName,'.')) {
				$path = CR_ROOT.'modules/'.$fileName."/".$fileName.".css";
				ob_start();
				include($path);
				$output = ob_get_clean(); 	
				echo $output;
			}
		}
	}
	
}
?>