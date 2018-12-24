<?php

namespace App\Models;

use Framework\Model;
use \PDO;

class Thread extends Model
{
    public function getPosts(array $params){
        $pdo = $this->newDbCon();

        $sql="select p.id,p.content,p.created,u.name
              from post p join user_account u on p.user_account_id=u.id
              where p.thread_id=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$params[0]]);

        $data=$stmt->fetchAll();

        return $data;
    }

    public function getThreadSubject(array $params){
        $pdo=$this->newDbCon();

        $sql="select subject from thread where id=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$params[0]]);

        $data=$stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }
}