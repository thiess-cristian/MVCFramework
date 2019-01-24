<?php
/**
 * Created by PhpStorm.
 * User: Cristi
 * Date: 1/8/2019
 * Time: 10:44 AM
 */

namespace App\Guards;


use Framework\Guard;

class FormGuard implements Guard
{
    public function handle(array $params = null):void
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->reject();
        }
    }

    public function reject()
    {
         header("Location: /");
         die();
    }
}