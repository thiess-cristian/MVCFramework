<?php

namespace App\Guards;

use Framework\Guard;

class Authenticated implements Guard
{
    public function handle(array $params = null):void
    {
        session_start();
        if (!isset($_SESSION['username'])) {
            $this->reject();
        }
    }

    public function reject():void
    {
        header("Location: /login");
    }
}
