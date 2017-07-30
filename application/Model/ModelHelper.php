<?php

class ModelHelper {
	
	function modelObjToSqlFieldValuesAdd($modelObject) {
		$fields = "";
		$values = "";
		$countfields = 0;
		foreach($modelObject as $key => $value) {
			if ($countfields == 0) {
				$fields .= $key;
				$values .= "'".$value."'";
			} else {
				$fields .= ", ".$key;
				$values .= ", "."'".$value."'";
			}
			$countfields++;
		}
		$modelData['fields'] = $fields;
		$modelData['values'] = $values;
		return $modelData;
	}

	function modelObjToSqlFieldValuesUpdate($modelObject) {
		$fieldValues = "";
		$primaryKey = -1;
		$countfields = 0;
		foreach($modelObject as $key => $value) {
			if ($countfields === 0 && $key !== "id") {
				$fieldValues .= $key."='".$value."'";
				$countfields++;
			} else if ($key !== "id" && $countfields > 0) {
				$fieldValues .= ", $key = '$value'";
			} else if ($key == "id") {
				$primaryKey = $value;
			}
		}
		$modelData['conditions'] = "WHERE id=".$primaryKey;
		$modelData['fieldValues'] = $fieldValues;
		return $modelData;
	}

	function modelObjToSqlFieldValuesDelete($modelObject) {
		$fieldValues = "";
		$primaryKey = -1;
		$countfields = 0;
		foreach($modelObject as $key => $value) {
			if ($countfields === 0 && $key !== "id") {
				$fieldValues .= $key."='".$value."'";
			} else if ($key !== "id") {
				$fieldValues .= ", $key = '$value'";
			} else if ($key == "id") {
				$primaryKey = $value;
			}
			$countfields++;
		}
		$modelData['conditions'] = "WHERE id=".$primaryKey;
		$modelData['fieldValues'] = $fieldValues;
		return $modelData;
	}
	function modelObjToSqlFields($modelObject){
		$sqlData = [];
		$sqlData['sqlConditions'] = "";
		$sqlData['sqlFields'] = "*";
		if ($modelObject['fields'])
			$sqlData['sqlFields'] = $this->buildFields($modelObject['fields']);
		if ($modelObject['conditions'])
			$sqlData['sqlConditions'] = " WHERE ".$this->buildWhereCondition($modelObject['conditions']);

		return $sqlData;
	}

	public function buildFields($fields) {
		$fieldsData = "";
		$countfields = 0;
		foreach ($fields as $key => $value) {
			if($countfields == 0) {
				$fieldsData .= $value;
			} else{
				$fieldsData .= ", ".$value;
			}
			$countfields++;
		}
		return $fieldsData;
	}

	public function buildWhereCondition($conditions){
		$conditionData = "";
		$countConditions = 0;
		foreach ($conditions as $key => $value) {
			if($countConditions == 0) {
				$conditionData .= $key."="."'".$value."'";
			} else{
				$conditionData .= " AND ".$key."="."'".$value."'";
			}
			$countConditions++;
		}
		return $conditionData;
	}
	
	function generateCsv($data, $delimiter = ',', $enclosure = '"') {
		$handle = fopen('php://temp', 'r+');
		foreach ($data as $line) {
			fputcsv($handle, $line, $delimiter, $enclosure);
		}
		rewind($handle);
		while (!feof($handle)) {
			$contents .= fread($handle, 8192);
		}
		fclose($handle);
		return $contents;
	}
}
