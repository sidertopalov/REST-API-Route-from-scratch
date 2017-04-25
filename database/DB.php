<?php

class DB
{
	private $con = null;
	private $host = "localhost";
	private $user = "root";
	private $pass = "";
	private $database = "api";

	public function __construct()
	{
		$con = mysqli_connect($this->host, $this->user, $this->pass, $this->database);
		
		if ($con->connect_error) {
		    die("Connection failed: " . $con->connect_error);
		}
		$this->con = $con;
	}

	/**
	 * @param $table string
	 * @param $id optional default value NULL
	 * @return array
	 */
	public function select($table,$id = null)
	{
		$data = [];
		$sql = "SELECT * FROM $table";

		if ($id !== null) {
			$sql .= " WHERE id=$id";
		}

		$result = $this->con->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				array_push($data, $row);
			}
		} else {
			if (!is_null($id) ) {
				$data["msg"] = "Data with ID {$id} missing!";
			}
		}
		return $data;
	}

	/**
	 * @param $table string name of table you want to insert
	 * @param $columns string Columns example: $col = "title, date, content"
	 * @param $values array "key => value" where "key" is type example: ["string" => "Some text"]
	 * @return string
	 */
	public function insert($table,string $columns, array $values)
	{
		$sql = 'INSERT INTO '.$table.' ('.$columns.')';
		$buildQuery = $this->buildQuery($values);
		$sql .= $buildQuery;
		
		if ($this->con->query($sql) === true) {
			return "success";
		}
		return "Error: " . $sql . "<br>" . $this->con->error;

	}

	/**
	 * @param $table string
	 * @param $id
	 */
	public function customQuery($sql)
	{
		if ($this->con->query($sql) === TRUE) {
		    return "success";
		} else {
		    return "Sql error " . $this->con->error;
		}
	}

	/**
	 * @param $id
	 */
	public function delete($id)
	{
		//
	}

	/**
	 * Helper method for $this->insert();
	 * @param $values array "key => value" where "key" is type example: ["string" => "Some text"]
	 * @return 
	 */
	private function buildQuery($values)
	{
		$sql= " VALUES(";
		$count = 0;

		foreach ($values as $key => $value) {
			$count++;
			$key = strtolower($key);
			switch ($key) {
				case 'int':
				case 'double':
				case 'float':
					$sql .= $value."";
					break;
				case 'string':
				case 'text':
				case 'date':
				case 'datetime':
					$sql .= '"'.$value.'"';
					break;
				default:
					break;
			}

			if (count($values) > $count) {
				$sql .= ", ";
			}
		}

		$sql .= ')';
		return $sql;
	}
}