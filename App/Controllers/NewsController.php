<?php

class NewsController extends BaseController
{
	/**
	 * Method handle all GET request
  	 * @param $id int optional
	 * @return array
	 */
	public function get($id = null)
	{
		$table = "news";
		
		//select
		$db = new DB();
		$result = $db->select($table,$id);

		if ($id !== null) {
			return $result;
		}
		return $result;
	}

	/**
	 * Method handle all POST request if you set $id will "update" otherwise will "create"
  	 * @param $id int optional
	 * @return array
	 */
	public function post($id=null)
	{

		if (isset($_POST["newsTitle"]) && isset($_POST["newsDate"]) && isset($_POST["newsText"])) {

			$db = new DB();
			$table = "news";

			// Validate user input
			$title = trim(htmlspecialchars($_POST["newsTitle"]));
			$date = $_POST["newsDate"];
			$content = trim(htmlspecialchars($_POST["newsText"]));

			$isEmptyVar = (empty($title) || empty($date) || empty($content));

			if (!$isEmptyVar) {
				if (is_null($id)) {
					// create
					$columns = "title, date, content";
					$values =  ["string" => $title, "datetime" => $date, "text" => $content];
					$result = $db->insert($table, $columns, $values);

				} else {
					// update
					$sql = 'UPDATE '.$table.' SET title="'.$title.'", date="'.$date.'", content="'.$content.'" WHERE id='.$id;
					$result = $db->customQuery($sql);
				}
			}
			else 
			{
				return ["msg" => "Update fail! Please compleate all require fields!"];
			}
			return ["msg" => $result];
		}
		return ["msg" => "Compleate all require fields!"];
	}

	/**
	 * Method handle all PUT request for update
 	 * @param $id int require
	 * @return bool
	 */
	public function put($id)
	{
		//implement
	}

	/**
	 * Method handle all DELETE request
	 * @param $id int require
	 * @return bool
	 */
	public function delete($id)
	{
		$db = new DB();
		$table = "news";
		$id = trim(htmlspecialchars($id));
		$msg = "";
		
		if (is_numeric($id)) {
			$isDataExist = $db->select($table,$id);
			if (!isset($isDataExist["msg"])) {
				$sql = "DELETE FROM {$table} WHERE id=".$id;
				$result = $db->customQuery($sql);
				$msg = $result;
			} else {
				$msg = "No data with ID {$id}";
			}
		} else {
			$msg = "Delete fail! Expected argument must be of type int.";
		}
		return ["msg" => $msg];
	}
}