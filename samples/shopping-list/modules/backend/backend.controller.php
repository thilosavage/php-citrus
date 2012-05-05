<?php
/**********************************************

	Backend Controller
	
	This is for writing your backend where you
	or the client or whoever logs in and
	changes content.
	
	Change the username/password in the config
	
**********************************************/
class backendController extends Controller {

	var $layout = 'backend';
	
	// keep out the riff raff
	function _prepare() {
	
		if ($this->action !== 'index' && !isset($_SESSION['admin'])) {
			$this->session('return_to', $this->route);
			$this->redirect('admin/index');
		}
	}
	
	
	function logout() {
		unset($_SESSION['admin']);
		$this->redirect('admin/index');
	}
	
	function index(){
	
		if ((@$_POST['user'] == site::admin && @$_POST['pass'] == site::pass) || isset($_SESSION['admin']))  {
			$_SESSION['admin'] = 1;
			$this->redirect('backend/manage');
		}
		else {
			echo "Incorrect password";
		}
	
		echo "<form method='post'>";
		echo "User: <input type='text' name='user'><br>";
		echo "Pass: <input type='text' name='pass'><br>";
		echo "<input type='submit'>";
		echo "</form>";
	}	
	
	function manage() {
	
		$this->vars('test_message','Edit site content etc');
	
	}
	
}
?>