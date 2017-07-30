<?php 

require_once 'Model.php';

class Contacts extends Model {

	public function __construct() {
		self::$Model = "Contacts";
		self::$Table = "contacts";
	}
}

