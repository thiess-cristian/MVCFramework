<?php

namespace Framework;

class Controller
{
    private $twig;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../app/Views');
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => __DIR__ . '/../storage/cache/views',
        ));
    }

    public function view(string $viewFile, array $params = []):void
    {
        echo $this->twig->render($viewFile, $params);
    }
}
