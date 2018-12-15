<?php

namespace App\Controllers;
use Framework\Controller;

class PageController extends Controller
{
    public function indexAction(array $params): void
    {
        $this->view("Index.twig",$params);
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

    public function showRegister(array $params): void
    {
        $this->view("Register.twig",$params);
    }

    public function showLogin(array $params): void
    {
        $this->view("Login.twig",$params);
    }

}