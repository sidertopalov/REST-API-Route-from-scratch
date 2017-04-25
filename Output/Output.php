<?php

/**
* Helper class to output data as json
*/
class Output
{
	private static $_contentType = "Content-Type: application/json";

	public static function render($data)
	{
		header(self::$_contentType);
		echo json_encode($data);
	}
}