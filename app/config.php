<?php

namespace App;

class Config{
    const ENV="dev";
    const DB=[
        "host"=>"localhost",
        "port"=>3306,
        "driver"=>"mysql",
        "dbname"=>"forum",
        "charset"=>"utf8mb4",
        "user"=>"root",
        "pass"=>"",
    ];
}

