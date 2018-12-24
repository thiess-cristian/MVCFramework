<?php

namespace App\Models;

use Framework\Model;
use \PDO;

class Categories extends Model
{
    protected $table = "category";

    public function getCategories():array {

        $pdo = $this->newDbCon();

        $sql="select * from category";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $data=$stmt->fetchAll();

        return $data;

    }
}