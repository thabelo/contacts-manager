<?php

class Database {
	protected static $_init = false;
	protected static $config;
	
	public function __construct() {
		$this->_init();
	}

	protected static function _init() {
		include_once 'database.conf.php';
		if (class_exists('DATABASE_CONFIG')) {
			self::$config = new DATABASE_CONFIG();
		}
		self::$_init = true;
	}

	public function connectToDatabase() {

		try {
			$config = new DATABASE_CONFIG();
			$connect_db = new mysqli(self::$config->default['host'], self::$config->default['user'], self::$config->default['password'], self::$config->default['database']);
			if ( mysqli_connect_errno() ) {
				echo "Connection failed: " . mysqli_connect_error();
				header("Location: ../../../application/Views/Admin/reset_schema.php?error=Please edit application/Config/database.conf.php");
			}
			return $connect_db;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

	public function recreateDatabase() {

		try {
			
			if(!self::$_init) {
				throw new Exception('Failed to intialize connection config.');
				return false;
			}
			$db_name = self::$config->default['database'];
			// Create connection
			$conn = new mysqli(self::$config->default['host'], self::$config->default['user'], self::$config->default['password']);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			// Drop database
			$sql = "DROP DATABASE ".$db_name;
			if ($conn->query($sql) === TRUE) {
				echo "Database ".$db_name." dropped successfully<br>";
			} else {
				//CONTINUE DON''T THROW ERRROR
			}
			// Create new database
			$sql = "CREATE DATABASE ".$db_name;
			if ($conn->query($sql) === TRUE) {
				echo "Database ".$db_name." created successfully<br>";
			} else {
				throw new Exception("Error creating database ".$db_name." :" . $conn->error);
			}
			$conn->close();
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
}
