<?php 

require_once 'Model.php';

class ContactsTypes extends Model {

	public function __construct() {
		self::$Model = "ContactsTypes";
		self::$Table = "contacts_types";
	}
}

