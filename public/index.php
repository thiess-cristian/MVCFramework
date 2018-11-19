<?php
require_once "../app/config.php";
ini_set("error_log",__DIR__."/../logs/error.log");
error_reporting(E_ALL);
ini_set("display_errors",0);

if($config["env"]=="dev"){
    ini_set("display_errors",1);
}

$_SERVER["REQUEST_URI"];

var_dump($_SERVER["REQUEST_URI"]);

$_SERVER["QUERY_STRING"];

var_dump($_SERVER["QUERY_STRING"]);