<?php

require_once "autoload.php";

$routing = new Routing();

$routing->map("GET", "/home", "Home@index");

$routing->map("GET", "/news", "News@index");
$routing->map("POST", "/news", "News@create");
$routing->map("POST", "/news/[:id]", "News@update");
$routing->map("DELETE", "/news/[:id]", "News@delete");

$result = $routing->match();
Output::render($result);

