<?php

class BaseController implements iCrud
{
	/**
	 * Method handle all GET request
  	 * @param $id int optional
	 * @return array
	 */
	public function get($id=null)
	{
		return array();
	}

	/**
	 * Method handle all GET request
  	 * @param $id int optional
	 * @return bool
	 */
	public function post($id=null)
	{
		return true;
	}

	/**
	 * Method handle all GET request
  	 * @param $id int require
	 * @return bool
	 */
	public function delete($id)
	{
		return true;
	}

	/**
	 * Helper method
	 * @return array all variables from request(GET/POST/PUT/DELETE)
	 */
	public static function getParams()
	{
		$request = strtolower($_SERVER["REQUEST_METHOD"]);
		switch ($request) {
			case 'get':
					return $_GET;
				break;
			case 'post':
					return $_POST;
				break;
			case 'put':
					parse_str(file_get_contents("php://input"),$_PUT);
					return $_PUT;
				break;
			case 'delete':
					parse_str(file_get_contents("php://input"),$_DELETE);
					return $_DELETE;
				break;
			default:
					return null;
				break;
		}
	}

	public function getMethod()
	{
		return $_SERVER["REQUEST_METHOD"];
	}
}