<?php

$itemObj = new Items('all');

if ($itemObj->rows) {

	foreach ($itemObj->rows as $item) {
		echo render::module('item/item',$item);
	}

}
else {

	echo "none";

}


?>