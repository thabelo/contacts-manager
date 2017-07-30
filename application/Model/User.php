<?php 

require_once 'Model.php';

class User extends Model {

	public function __construct() {
		self::$Model = "User";
		self::$Table = "users";
	}
}

