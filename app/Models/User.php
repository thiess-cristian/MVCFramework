<?php

namespace App\Models;

use Framework\Model;
use \PDO;

class User extends Model
{
    protected $table = "user_account";

    public function checkUsername(string $username): bool
    {
        return isset($username) && $username != "";
    }

    public function checkEmail(string $email): bool
    {
        return isset($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function checkPassword(string $password): bool
    {
        return isset($password) && strlen($password) >= 6;
    }

    public function registerUser(string $email, string $pass, string $username): void
    {
        if ($this->checkEmail($email) && $this->checkUsername($username) && $this->checkPassword($pass)) {

            $pdo = $this->newDbCon();
            $password = password_hash($pass, PASSWORD_DEFAULT);

            $sql = "insert into user_account (name,email,hashed_password) values (?,?,?)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username, $email, $password]);
            header("Location:/login");
        }
    }

    public function login(string $username, string $password)
    {
        $pdo = $this->newDbCon();
        $sql = "select hashed_password,name from user_account where name=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);

        $data = $stmt->fetch();

        if (password_verify($password, $data->hashed_password)) {
            session_start();
            $_SESSION['username'] = $username;
            header("Location:/");
        }

    }


}