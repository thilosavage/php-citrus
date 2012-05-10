<?php
/**
 * Controller for individual items
 *
 */
class itemController extends Controller {

	/**
	 *	Create a form for an item 
	 *
	 *	arg	int	item id
	 */
	function form($item_id) {
	
		$itemsObj = new Items($item_id);
		
		echo render::module('item/form', $itemsObj->row);

	}
	
	function submit() {
		$data = array(
			'error' => null,
			'success' => "Item Added",
			'item' => null,
			'update' => null
			);
			
		$itemsObj = new Items(@$_POST['item']['item_id']);
		
		if ($itemsObj->row) {
			$item = $itemsObj->row;
			$data['success'] = "Item Updated";
			$data['update'] = $itemsObj->row['item_id'];
		}
		
		$itemsObj->set = $_POST['item'];
		$itemsObj->set['item_id'] = $itemsObj->save();
		
		$data['error'] = mysql_error();
		
		$data['item'] = render::module('item/item',$itemsObj->set);
		
		echo json_encode($data);
		
		
	}

	function delete($item_id) {
	
		$data = array(
			'error' => null,
			'success' => "Item deleted"
			);
	
		$itemsObj = new Items;
		$itemsObj->delete($item_id);
	
		echo json_encode($data);
	
	}
	
}

//   5 minutes/day = 328 years

?>