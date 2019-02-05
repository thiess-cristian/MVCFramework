<?php

namespace App\Controllers;

use Framework\Controller;

class IndexController extends Controller
{
    public function indexAction(array $params): void
    {
        $this->view("Index.html.twig", $params);
    }

    public function notFound(array $params): void
    {
        $this->view("NotFound.html.twig",$params);
    }

    public function showRegister(array $params): void
    {
        $this->view("Register.html.twig", $params);
    }

    public function showLogin(array $params): void
    {
        $this->view("Login.html.twig", $params);
    }

}