<?php

class HomeController extends BaseController
{
	/**
	 * Method handle all GET request
  	 * @param $id int optional
	 * @return array
	 */
	public function get($id=null)
	{
		return "Default method. Hello from HomeController@get() " . $id;
	}

	/**
	 * Method handle all POST request
  	 * @param $id int optional
	 * @return bool
	 */
	public function post($id=null)
	{
		return true;
	}

	/**
	 * Method handle all DELETE request
  	 * @param $id int require
	 * @return array
	 */
	public function delete($id)
	{
		return true;
	}
}