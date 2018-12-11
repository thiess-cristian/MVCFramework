<?php

namespace App\Controllers;

class PageController
{
    public function __construct()
    {

    }

    public function indexAction(array $params): void
    {
        echo "index";
    }

    public function aboutUsAction(array $params): void
    {
        echo "about page";
    }

    public function userAction(array $params): void
    {
        echo "user " . $params[0];
    }

    public function notFound(array $params): void
    {
        echo "404";
    }
}