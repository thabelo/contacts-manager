<?php 
require_once (__DIR__.'/../Model/ContactsTypes.php');
require_once (__DIR__.'/controller.php');

class ContactsTypesController extends Controller {

	static $ContactsTypes;
	
	public function __construct() {
		self::$ContactsTypes = new ContactsTypes();
		$this->ContactsTypes = self::$ContactsTypes;
		parent::__construct();
	}
	
	public function findAllContactsTypes(){
		$data = $this->ContactsTypes->find("all");
		return $data;
	}

	public function findById($id = null){
		$contactsTypes = [];
		$contactsTypes['ContactsTypes'] = array("conditions"=>array("id" => $id));
		$data = $this->ContactsTypes->find($contactsTypes);
		if ($data) {
			return $data[0];
		}
		return null;
	}
	
	public function add($data) {
		$data = $this->ContactsTypes->add($data['data']);
		if ($data) {
			$this->Flash->message("Saved");
			$this->redirect("../Views/ContactsTypes/");
		} else {
			$this->Flash->error("Error : Please enter all fields to add new user");
			$this->redirect('../Views/Users/add.php');
		}
	}

	public function edit($data) {
		$data = $this->ContactsTypes->edit($data['data']);
		if ($data) {
			$this->Flash->message("Saved");
			$this->redirect("../Views/ContactsTypes");
		} else {
			$this->Flash->error("Edit Failed, please supply valid data");
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function delete ($data) {
		$data = $this->ContactsTypes->delete($data['data']);
		if ($data !== 1451) {
			$this->Flash->error("Deleted");
			$this->redirect("../Views/ContactsTypes/");
		} else if ($data === 1451){
			$this->Flash->error("Cannot delete entry. Type is being used by contacts in database");
			$this->redirect('../Views/ContactsTypes/');
		} else {
			$this->Flash->error("Delete Failed, please supply valid data");
			$this->redirect('../Views/ContactsTypes/');
		}
	}

}
// Route actions from views
if ($_POST) {
	$contactsTypes = new ContactsTypesController('ContactsTypes','contacts_types');
	if($_POST['action'] == "add") {
		$contactsTypes->add($_POST);
	}
	if($_POST['action'] == "edit") {
		$contactsTypes->edit($_POST);
	}
	if($_POST['action'] == "delete") {
		$contactsTypes->delete($_POST);
	}
}

