<?php
class render {
	function view($view, $data = array()) {
	
		ob_start();
		
		$g = explode('/',$view, 2);
		if ($g[0] == 'common') {
			include(site::root.'helper_html/'.$g[1].'.php');
		}
		else {
			include(site::root.'modules/'.$view.'.php');
		}
		
		$bah = ob_get_contents();
		ob_end_clean();
		return $bah;
	
	}
	
	function js() {
	
		$handler = opendir(site::root.'helper_js');
		while ($file = readdir($handler)) {
			if ($file != '.' && $file != '..' && strpos($file,'.'))
				$files[] = $file;
		}
		closedir($handler);
		foreach ($files as $fileName){
			$path = site::root.'helper_js/'.$fileName;
			ob_start();
			include($path);
			$output = ob_get_clean();
			echo $output;
		}

		$handler = opendir(site::root.'modules');
		
		while ($fileName = readdir($handler)){
			if ($fileName != '.' && $fileName != '..' && !strpos($fileName,'.')) {
				$path = site::root.'modules/'.$fileName."/".$fileName.".js";
				ob_start();
				include($path);
				$output = ob_get_clean();
				echo $output;
			}
		}

	}
	
	
	function css() {

		$handler = opendir(site::root.'helper_css');
		while ($file = readdir($handler)) {
			if ($file != '.' && $file != '..' && strpos($file,'.'))
				$files[] = $file;
		}
		closedir($handler);
		foreach ($files as $fileName){
			$path = site::root.'helper_css/'.$fileName;
			ob_start();
			include($path);
			$output = ob_get_clean(); 	
			echo $output;
		}

		$handler = opendir(site::root.'modules');
		
		while ($fileName = readdir($handler)){
			if ($fileName != '.' && $fileName != '..' && !strpos($fileName,'.')) {
				$path = site::root.'modules/'.$fileName."/".$fileName.".css";
				ob_start();
				include($path);
				$output = ob_get_clean(); 	
				echo $output;
			}
		}
	}
	
}
?>