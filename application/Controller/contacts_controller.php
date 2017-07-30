<?php 
require_once (__DIR__.'/../Model/Contacts.php');
require_once (__DIR__.'/controller.php');

class ContactsController extends Controller {

	static $Contacts;
	
	public function __construct() {
		self::$Contacts = new Contacts();
		$this->Contacts = self::$Contacts;
		parent::__construct();
	}
	
	public function findAllContacts() {
		$results = $this->Contacts->find("all");
		if (!$results ) {
			$this->Flash->error("No Contacts found, pleae add contacts");
		}
		return $results;
	}
	
	public function api_searchContacts(){
		$searchWords = $_POST['searchWord'];
		$data = explode(" ", $searchWords);
		$conditions = $this->buildSearchConditions($data);

		$baseSql = "SELECT U.id, U.firstname, U.lastname, C.value, CT.name FROM contacts AS C
		RIGHT JOIN users AS U ON U.id = C.users_id 
		LEFT JOIN contacts_types AS CT ON CT.id = C.contacts_types_id";
		
		$sql = $baseSql.$conditions;
		echo json_encode($this->Contacts->queryModel($sql));
		exit;
	}

	public function searchContacts($searchWords){
		$data = explode(" ", $searchWords);
		$conditions = $this->buildSearchConditions($data);

		$baseSql = "SELECT C.* FROM contacts AS C
		RIGHT JOIN users AS U ON U.id = C.users_id 
		LEFT JOIN contacts_types AS CT ON CT.id = C.contacts_types_id";
		
		$sql = $baseSql.$conditions;		
		$results = $this->Contacts->queryModel($sql);

		if (!$results) {
			$this->Flash->error("Search not found");
		} 
		return $results;
	}

	public function buildSearchConditions($words) {
		$sqlString = "";
		$dbFields = ['U.firstname', 'U.lastname', 'C.value', 'CT.name'];
		$countIndex = 0;
		foreach ($dbFields as $key => $value) {
			foreach($words as $word) {
				if ($countIndex == 0) {
					$sqlString .= " WHERE ".$value." LIKE '%".$word."%'";
				} else {
					$sqlString .= " OR ".$value." LIKE '%".$word."%'";
				}
				$countIndex++;
			}
		}
		return $sqlString;
	}
	public function findAllUserContacts($user_id) {
		$contacts['Contacts'] = array("conditions"=>array("users_id" => $user_id));
		$results = $this->Contacts->find($contacts);
		if (!$results ) {
			$this->Flash->error("No contacts found for this user, pleae add contacts");
		}
		return $results;
	}

	public function findById($id = null) {
		$contacts = [];
		$contacts['Contacts'] = array("conditions"=>array("id" => $id));
		$data = $this->Contacts->find($contacts);
		if ($data) {
			return $data[0];
		}
		return null;
	}
	
	public function add($data) {
		if ($data['data']['Contacts'] && $data['data']['Contacts']['value'] && $data['data']['Contacts']['contacts_types_id']) {
			$result = $this->Contacts->add($data['data']);
			if ($result) {
				$this->Flash->message("Saved");
				$this->redirect("../Views/Contacts/user_contacts.php?user=".$data['data']['Contacts']['users_id']);
			}
		} else {
			$this->Flash->error("Please add contact details and type");
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function edit($data) {
		$data = $this->Contacts->edit($data['data']);
		if ($data) {
			$this->Flash->message("Saved");
			$this->redirect("../Views/Contacts/");
		} else {
			$this->Flash->error("Edit Failed, please supply valid data");
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function delete ($data) {
		$data = $this->Contacts->delete($data['data']);
		if ($data) {
			$this->Flash->message("Deleted");
			$this->redirect("../Views/Contacts/");
		} else {
			$this->Flash->error("Delete Failed, please supply valid data");
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
	}

}
// Route actions from views
if ($_POST) {
	$contacts = new ContactsController('Contacts','contacts');
	if($_POST['action'] == "add") {
		$contacts->add($_POST);
	}
	if($_POST['action'] == "edit") {
		$contacts->edit($_POST);
	}
	if($_POST['action'] == "delete") {
		$contacts->delete($_POST);
	}
	if ($_POST['action'] == "api_search") {
		$contacts->api_searchContacts($_POST);
	}

}

