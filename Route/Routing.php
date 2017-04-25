<?php

class Routing
{

	public $_uri = null;
	public $_routes = array();
	private $_endpoints = array();
	private $_defaultClass = "HomeController";


	public function map($httpMethod, $route, $method)
	{
		$args = explode("@", $method);
		$ctrl = $args[0]."Controller";
		$ctrlAction = isset($args[1]) ? $args[1]."Action" : "indexAction";
		$httpMethod = strtolower($httpMethod);

		$this->_routes[$ctrl][$args[1]] = ["http" => $httpMethod, "route" => $route, "class" => $ctrl, "args" => $args];
		$this->_endpoints[$method] = "$httpMethod | $route | $ctrl | $ctrlAction";
	}

	public function match()
	{
		$uri = $this->getUri();
		$uriItems = explode("/", $uri);
		$endpoint = $uriItems[0];
		$httpMethod = strtolower($_SERVER['REQUEST_METHOD']);
		$className = "";

		try {
			
			if ($this->isRegisteredEndpoint($httpMethod, $endpoint) === false && !empty($endpoint)){
				throw new Exception("Endpoint [ /{$endpoint} ] with [ {$httpMethod} ] is not registered in our Routes", 400);

			} else if(!(empty($uriItems[0]) && isset($uriItems[1]))) {

				$className = $this->isRegisteredEndpoint($httpMethod, $endpoint);
				//if url is empty without args load default class
				if (empty($endpoint) && $className === false) {
					$className = $this->_defaultClass;
				}
			}

			if (!class_exists($className)) {
				throw new \Exception("Application class [ ".$className." ] not found", 404);
			}

			if (!is_callable([$className, $httpMethod])) {
				throw new \Exception("Method [ ".$httpMethod." ] not allowed", 405);
			}

			array_shift($uriItems);
			$class = new $className();

			return call_user_func_array([$class, $httpMethod], $uriItems);
		} catch (Exception $e) {
			http_response_code($e->getCode());
			echo $e->getMessage();
			exit;
		}
	}

	public function getUri()
	{
		if (is_null($this->_uri)) {
			$basepath = pathinfo($_SERVER["SCRIPT_NAME"])["dirname"] . "/";
			$this->_uri = str_replace($basepath, '', $_SERVER['REQUEST_URI']);
		}
		return $this->_uri;
	}

	/**
	 * Method that chek if we have registered endpoint in our Routes
	 * @param $httpMethod http request eg(GET/PUT/POST/DELETE)
	 * @param $endpoint string
	 * @return Class name|bool false if not exist @return class name
	 */
	public function isRegisteredEndpoint($httpMethod, $endpoint)
	{
		$reg = '/[a-zA-Z]\w+/';
		foreach ($this->_routes as $key => $value) {
			foreach ($value as $kk => $vv) {
				$str = $vv["route"];
				preg_match_all($reg, $str, $matches, PREG_PATTERN_ORDER, 0);
				if (isset($matches[0][0])) {
					if ($matches[0][0] == $endpoint && $httpMethod === $vv["http"]) {
						return $vv["class"];
					}
				}
			}
		}
		return false;
	}

	/**
	 * get registered endpoints
	 * @return array with endpoints
	 */
	public function getEndPoints()
	{
		return $this->_endpoints;
	}

	public function getDefaultClass()
	{
		return $this->_defaultClass;
	}

}

