<?php 

require_once(__DIR__.'../../Config/database.php');
require_once 'ModelHelper.php';

class Model{

	public static $Model;
	public static $Table;

	public function __construct($model,$table) {
		self::$Model = $model;
		self::$Table = $table;
	}

	public function find($data = "all"){
		try {
			$database = new Database();
			$connect = $database->connectToDatabase();

			if($data === "all") {
				$query = "SELECT * FROM ".self::$Table;
			} else if ($data == "first") {
				$query = "SELECT * FROM `".self::$Table."` ORDER BY id asc LIMIT 1";
			} else if ($data[self::$Model]) {
				$modelHelper = new ModelHelper();
				$modeldataToSQL = $modelHelper->modelObjToSqlFields($data[self::$Model]);
				$query = "SELECT ".$modeldataToSQL["sqlFields"]." FROM ".self::$Table.$modeldataToSQL['sqlConditions'];
			} else {
				throw new Exception("Error: Model ".self::$Model." not found on selection. Please supply correct data set.");
			}

			$result = mysqli_query($connect, $query);
			if(!$result) {
				throw new Exception("Error : ".mysqli_errno($connect) . ": " . mysqli_error($connect) );
			}
			mysqli_close($connect);
			$results = array();
			$rows = array();
			while($row = $result->fetch_assoc()) {
				$data = array();
				$data[self::$Model] = $row;
				$rows[] = $data;
			}
			if ($rows) {
				return $rows;
			} else {
				return null;
			}
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
	
	public function add($data = null) {
		try {
			$database = new Database();
			$connect = $database->connectToDatabase();
			if ($data[self::$Model]) {
				$modelHelper = new ModelHelper();
				$modeldataToSQL = $modelHelper->modelObjToSqlFieldValuesAdd($data[self::$Model]);
				$query = "INSERT INTO `".self::$Table."`(".$modeldataToSQL['fields'].") VALUES (".$modeldataToSQL["values"].")";
			} else {
				throw new Exception("Error : ".self::$Model." not defined or wrong model defined");
			}
			$result = mysqli_query($connect, $query);
			if(!$result) {
				throw new Exception("Error : ".mysqli_errno($connect) . ": " . mysqli_error($connect) );
			}
			mysqli_close($connect);
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

	public function edit($data = null) {
		try {
			$database = new Database();
			$connect = $database->connectToDatabase();
			if ($data[self::$Model]) {
				$modelHelper = new ModelHelper();
				$modeldataToSQL = $modelHelper->modelObjToSqlFieldValuesUpdate($data[self::$Model]);
				$query = "UPDATE `".self::$Table."` SET ".$modeldataToSQL['fieldValues']." ".$modeldataToSQL['conditions'];
			} else {
				throw new Exception("Error : ".self::$Model." not defined or wrong model defined");
			}
			$result = mysqli_query($connect, $query);
			if(!$result) {
				throw new Exception("Error : ".mysqli_errno($connect) . ": " . mysqli_error($connect) );
			}
			mysqli_close($connect);
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

	public function delete($data = null) {
		try {
			$database = new Database();
			$connect = $database->connectToDatabase();
			if ($data[self::$Model]) {
				$modelHelper = new ModelHelper();
				$modeldataToSQL = $modelHelper->modelObjToSqlFieldValuesDelete($data[self::$Model]);
				$query = "DELETE FROM `".self::$Table."` ".$modeldataToSQL['conditions'];
			} else {
				throw new Exception("Error : ".self::$Model." not defined or wrong model defined");
			}
			$result = mysqli_query($connect, $query);
			if(!$result) {
				if (mysqli_errno($connect) === 1451) {
					mysqli_close($connect);
					return 1451;
				}
				throw new Exception("Error : ".mysqli_errno($connect) . ": " . mysqli_error($connect) );
			}
			mysqli_close($connect);
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

	public function queryModel($query){
		try {
			$database = new Database();
			$connect = $database->connectToDatabase();

			if (!$query) {
				throw new Exception("Error: Splease specify query.");
			}
			$result = mysqli_query($connect, $query);
			if(!$result) {
				throw new Exception("Error : ".mysqli_errno($connect) . ": " . mysqli_error($connect) );
			}
			mysqli_close($connect);
			$results = array();
			$rows = array();
			while($row = $result->fetch_assoc()) {
				$data = array();
				$data[self::$Model] = $row;
				$rows[] = $data;
			}
			if ($rows) {
				return $rows;
			} else {
				return null;
			}
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
}

