<?php

namespace Framework;

class Controller
{
    private $twig;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../app/Views');

        $this->twig = new \Twig_Environment($loader, array(
        //    'cache' => __DIR__ . '/../storage/cache/views',
            "cache"=>false
        ));


       // $this->twig = new \Twig_Environment($loader);

    }

    public function view(string $viewFile, array $params): void
    {
        session_start();
        $params['username']=$_SESSION['username'];
        $params['uid']=$_SESSION['uid'];
        echo $this->twig->render($viewFile,array('params'=>$params));
    }
}
