<?php

namespace App\Controllers;
use Framework\Controller;

class UserController extends Controller{
    public function show(array $params) :void{
        $this->view("Login.twig",$params);
    }
}