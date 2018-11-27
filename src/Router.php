<?php

namespace Framework;

class Router
{
    protected $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function callAction(string $uri, string $query)
    {

        if(!isset($this->routes[$uri])){

        }

        /*
        preg_match('/\d+/', $uri, $id);

        var_dump($id);


        if(!empty($id)){

            $subUri=substr($uri,0,strlen($uri)-strlen($id[0]));

            //var_dump($this->routes);

            foreach ($this->routes as $key){
                var_dump($key);

                //preg_match($subUri.'{.}',$key,$foundRoute);
                //echo $foundRoute;

            }
        }
        */
        $controller = $this->routes[$uri]['controller'];

        require_once ("../app/Controllers/".$controller.".php");

        $controllerObj = new $controller;

        $action = $this->routes[$uri]['action'];
        $controllerObj->{$action}();
    }

}