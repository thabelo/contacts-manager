<?php 
require_once (__DIR__.'/../Model/User.php');
require_once (__DIR__.'/controller.php');

class UsersController extends Controller{

	static $User;
	
	public function __construct() {
		self::$User = new User();
		$this->User = self::$User;
		parent::__construct();
	}
	
	public function findAllUsers(){
		$results = $this->User->find("all");
		if (!$results ) {
			$this->Flash->error("No Users found, pleae add users");
		}
		return $results;
	}

	public function findById($id = null){
		$user = [];
		$user['User'] = array("conditions"=>array("id" => $id));
		$data = $this->User->find($user);
		if ($data) {
			return $data[0];
		}
		return null;
	}
	
	public function add($data) {
		if ($data['data']['User'] && $data['data']['User']['firstname'] && $data['data']['User']['lastname']) {
			$results = $this->User->add($data['data']);
			if ($results) {
				$this->Flash->message("Saved");
				$this->redirect("../Views/Users/");
			}
		} else {
			$this->Flash->error("Error : Please enter all fields to add new user");
			$this->redirect('../Views/Users/add.php');
		}
	}

	public function edit($data) {
		$data = $this->User->edit($data['data']);
		if ($data) {
			$this->Flash->message("Saved");
			$this->redirect("../Views/Users/");
		} else {
			$this->Flash->error("Edit Failed, please supply valid data");
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function delete ($data) {
		$data = $this->User->delete($data['data']);
		if ($data) {
			$this->Flash->error("Deleted");
			$this->redirect("../Views/Users/");
		} else {
			$this->Flash->error("Delete Failed, please supply valid data");
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
	}

}
// Route actions from views
if ($_POST) {
	$user = new UsersController('User','users');
	if ($_POST['action'] == "add") {
		$user->add($_POST);
	}
	if ($_POST['action'] == "edit") {
		$user->edit($_POST);
	}
	if ($_POST['action'] == "delete") {
		$user->delete($_POST);
	}
}

