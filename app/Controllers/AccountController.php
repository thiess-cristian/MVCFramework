<?php

namespace App\Controllers;

use Framework\Controller;
use App\Models\User;


class AccountController extends Controller
{
    public function loginUser(array $params): void
    {
        $user = new User();

        $username = $_POST['username'];
        $pass = $_POST['pass'];

        if ($user->login($username, $pass)) {
            $pageController = new IndexController();
            $pageController->indexAction($params);
        } else {
            $this->view("User/Login.html.twig", $params);
        }
    }

    public function registerUser(array $params): void
    {

        $user = new User();

        $email = $_POST['email'];
        $username = $_POST['username'];
        $pass = $_POST['pass'];

        $user->registerUser($email, $pass, $username);
    }

    public function logoutUser(array $params): void
    {
        session_start();
        if (isset($_COOKIE[session_name()]))
            setcookie(session_name(), "", time() - 3600, "/");
        $_SESSION = array();
        session_destroy();
        header("Location: /");

    }
}