<?php

namespace Framework;

class Router
{
    protected $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function callAction(string $uri, string $query):void
    {
        $params=array();
        if(!isset($this->routes[$uri])){

            preg_match('/\d+/', $_SERVER['REQUEST_URI'], $id);
            $uri = preg_replace('/\d+/', '{id}', $_SERVER['REQUEST_URI']);
            $params[0]=$id[0];
        }

        $controller = $this->routes[$uri]['controller'];

        //require_once ("../app/Controllers/".$controller.".php");

        $className='App\\Controllers\\'.$controller;
        $controllerObj = new $className();
        $action = $this->routes[$uri]['action'];
        $controllerObj->{$action}($params);
    }

}