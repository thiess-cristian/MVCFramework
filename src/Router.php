<?php

class Router
{
    protected $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function callAction(string $uri, string $query)
    {
        $controller = $this->routes[$uri]['controller'];

        preg_match('/\d+/', $uri, $id);

        var_dump($id);

        require_once ("../app/Controllers/".$controller.".php");

        $controllerObj = new $controller;

        $action = $this->routes[$uri]['action'];
        $controllerObj->{$action}();
    }

}