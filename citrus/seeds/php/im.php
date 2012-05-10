<?php 
/**********************************************

	Render image HTML
	
	echo im::age('loader.gif','Loading...','loader');

	Will produce
	
	<img src='".site::image.'"loader.gif alt='Loading..' class='loader'>
	
**********************************************/
class im extends seed {

	/**
	 *	Render image tag
	 *
	 *	@arg		string	Image filename
	 *	@arg		string	Alt text (optional)
	 *	@arg		string	Class (optional)
	 *	@arg		string	ID (optional)
	 *	@return	string	Image tag markup
	 */
	public static function age($file, $alt='', $class='', $id='')
	{
		$tag = "<img src='".site::img.$file." ";
		
		if ($alt) 
			$tag .= "alt='".$alt." '";
		
		if ($class) 
			$tag .= "class='".$class." '";
		
		if ($id) 
			$tag .= "id='".$id." '";
	
		$tag .= "'>";
		return $tag;
	}
}


// End of file
// seeds/php/im.php