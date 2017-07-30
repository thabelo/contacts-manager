<?php 

require_once (__DIR__.'/../application/Config/database.php');

class Schema {

	public function recreateDatabase() {
		$database = new Database();
		$database->recreateDatabase();
	}
	
	public function recreateAll() {
		$database = new Database();
		$database->recreateDatabase();
	}
	
	public function recreateAllTables() {
		$this->createUsersTable();
		$this->createContactsTypesTable();
		$this->createContactsTable();
	}
	
	private function createUsersTable() {
		try {
			$database = new Database();
			$connect = $database->connectToDatabase();
			$query = "CREATE TABLE IF NOT EXISTS `users` (
					`id` int(11) unsigned NOT NULL auto_increment,
					`firstname` varchar(255) NOT NULL default '',
					`lastname` varchar(255) NOT NULL default '',
					PRIMARY KEY  (`id`)
			)";
			$result = mysqli_query($connect, $query);
			if(!$result) {
				throw new Exception("Error : ".mysqli_errno($connect) . ": " . mysqli_error($connect) );
			}
			mysql_close($connect);
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

	private function createContactsTypesTable() {
		try {
			$database = new Database();
			$connect = $database->connectToDatabase();
			$query = "CREATE TABLE IF NOT EXISTS `contacts_types` (
					`id` int(11) unsigned NOT NULL auto_increment,
					`name` varchar(255) NOT NULL default '',
					PRIMARY KEY  (`id`)
			)";
			$result = mysqli_query($connect, $query);
			if(!$result) {
				throw new Exception("Error : ".mysqli_errno($connect) . ": " . mysqli_error($connect) );
			}
			mysql_close($connect);
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

	private function createContactsTable() {
		try {
			$database = new Database();
			$connect = $database->connectToDatabase();
			$query = "CREATE TABLE IF NOT EXISTS `contacts` (
					`id` int(11) unsigned NOT NULL auto_increment,
					`value` varchar(255) NOT NULL default '',
					`contacts_types_id` int(11) unsigned NOT NULL,
					`users_id` int(11) unsigned NOT NULL,
					PRIMARY KEY  (`id`),
					CONSTRAINT contacts_types_id FOREIGN KEY (`contacts_types_id`) REFERENCES `contacts_types`(`id`),
					CONSTRAINT users_id FOREIGN KEY (`users_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
			)";
			$result = mysqli_query($connect, $query);
			if(!$result) {
				throw new Exception("Error : ".mysqli_errno($connect) . ": " . mysqli_error($connect) );
			}
			mysql_close($connect);
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
	
	public function addDefaultContactsTypes() {
		try {
			$database = new Database();
			$connect = $database->connectToDatabase();

			// add email
			$query = "INSERT INTO contacts_types (name) VALUES ('Email')";
			$result = mysqli_query($connect,$query);
			if(!$result) {
				throw new Exception("Error : ".mysqli_errno($connect) . ": " . mysqli_error($connect) );
			}
			
			// add cellno
			$query = "INSERT INTO contacts_types (name) VALUES ('Cellno')";
			$result = mysqli_query($connect, $query);
			if(!$result) {
				throw new Exception("Error inserting cellno");
			}
			
			// add workno
			$query = "INSERT INTO contacts_types (name) VALUES ('Workno')";
			$result = mysqli_query($connect, $query);
			if(!$result) {
				throw new Exception("Error inserting workno");
			}
			mysql_close($connect);
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
}

$schema = new Schema();
$schema->recreateDatabase();
$schema->recreateAllTables();
$schema->addDefaultContactsTypes();

