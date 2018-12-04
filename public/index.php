<?php

require __DIR__.'/../vendor/autoload.php';

use Framework\Router;
use App\Config;

require_once "../app/Config.php";
require_once "../src/Router.php";
require_once "../app/routes.php";

ini_set("error_log", __DIR__ . "/../logs/error.log");
error_reporting(E_ALL);
ini_set("display_errors", 0);
Tracy\Debugger::enable(Tracy\Debugger::PRODUCTION);

if (Config::ENV == "dev") {
    ini_set("display_errors", 1);
    Tracy\Debugger::enable(Tracy\Debugger::DEVELOPMENT);
}

$uri = $_SERVER["REQUEST_URI"];
$query = $_SERVER["QUERY_STRING"];

$router = new Router($routes);

$router->callAction($uri,$query);