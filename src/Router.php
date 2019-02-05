<?php

namespace Framework;

class Router
{
    protected $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function callAction(string $uri, string $query): void
    {
        $params = array();
        if (!isset($this->routes[$uri])) {

            preg_match('/\d+/', $_SERVER['REQUEST_URI'], $id);
            $uri = preg_replace('/\d+/', '{id}', $_SERVER['REQUEST_URI']);
            $params['id'] = $id[0];
        }
        $params['query'] = $query;

        if (!isset($this->routes[$uri])) {
            $uri = '/404';
        }
        $controller = $this->routes[$uri]['controller'];

        $this->checkGuard($uri,$params);

        $className = 'App\\Controllers\\' . $controller;
        $controllerObj = new $className();
        $action = $this->routes[$uri]['action'];
        $controllerObj->{$action}($params);
    }

    private function checkGuard(string $route,$params): void
    {
        if (isset($this->routes[$route]['guard'])) {
            $guard = "\\App\\Guards\\" . $this->routes[$route]['guard'];
            //instantiate and execute the handle action
            (new $guard)->handle($params);
        }
    }


}