<?php

class sayController extends Controller {

	function hi() {
		$data['msg'] = render::view('say/hi');
		echo json_encode($data);
	}
}
?>