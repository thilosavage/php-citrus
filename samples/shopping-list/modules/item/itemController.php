<?php

class itemController extends Controller {

	function form($items_id) {
	
		$itemsObj = new Items($items_id);
		
		echo render::view('item/form', $itemsObj->row);
		
		
		
	}
	
	function submit() {
		$data = array(
			'error' => null,
			'success' => "Item Added",
			'item' => null,
			'update' => null
			);
			
		$itemsObj = new Items(@$_POST['item']['items_id']);
		
		if ($itemsObj->row) {
			$item = $itemsObj->row;
			$data['success'] = "Item Updated";
			$data['update'] = $itemsObj->row['items_id'];
		}
		
		$itemsObj->set = $_POST['item'];
		$itemsObj->set['items_id'] = $itemsObj->save();
		
		$data['error'] = mysql_error();
		
		$data['item'] = render::view('item/item',$itemsObj->set);
		
		echo json_encode($data);
		
		
	}

	function delete($items_id) {
	
		$data = array(
			'error' => null,
			'success' => "Item deleted"
			);
	
		$itemsObj = new Items;
		$itemsObj->delete($items_id);
	
		echo json_encode($data);
	
	}
	
}

//   5 minutes/day = 328 years

?>