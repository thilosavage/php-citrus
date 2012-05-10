<?php 
/**********************************************

	Render image HTML
	
	example
		echo im::age('loader.gif','Loading...','loader');

	To me, this feels better than typing
	
	<img src='".site::image.'"loader.gif alt='Loading..' class='loader'>

	Whatever, entirely unnecessary.
	
**********************************************/
class im extends seed {
	public static function age($file, $alt='', $class='', $id=''){
		$ret = "<img src='".site::img.$file." ";
		if ($alt) {
			$ret .= "alt='".$alt." '";
		}
		if ($class) {
			$ret .= "class='".$class." '";
		}
		if ($id) {
			$ret .= "id='".$id." '";
		}
		$ret .= "'>";
		return $ret;
	}
}
?>