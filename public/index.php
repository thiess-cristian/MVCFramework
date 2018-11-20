<?php
require_once "../app/config.php";
require_once "../src/Router.php";
require_once "../app/routes.php";

ini_set("error_log", __DIR__ . "/../logs/error.log");
error_reporting(E_ALL);
ini_set("display_errors", 0);

if ($config["env"] == "dev") {
    ini_set("display_errors", 1);
}

$uri = $_SERVER["REQUEST_URI"];
$query = $_SERVER["QUERY_STRING"];

$router = new Router($routes);

$router->callAction($uri,$query);
