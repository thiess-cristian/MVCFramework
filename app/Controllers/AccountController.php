<?php

namespace App\Controllers;
use Framework\Controller;
use App\Models\User;


class AccountController extends Controller
{
    public function loginUser(array $params):void{
        $user=new User();

        $username=$_POST['username'];
        $pass=$_POST['pass'];

        $user->login($username,$pass);
    }

    public function registerUser(array $params):void{

        $user=new User();

        $email=$_POST['email'];
        $username=$_POST['username'];
        $pass=$_POST['pass'];

        $user->registerUser($email,$pass,$username);
    }
}