<?php

namespace App\Models;

use Framework\Model;
use \PDO;

class Thread extends Model
{

    protected $table="thread";

    public function getPosts(array $params){
        $pdo = $this->newDbCon();

        session_start();

        $uid=$_SESSION['uid'];

        $sql="select p.id,p.content,p.created,u.name,p.user_account_id,p.score 
              from post p join user_account u on p.user_account_id=u.id
              where p.thread_id=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$params['id']]);

        $data=$stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getThreadSubject(array $params){
        $pdo=$this->newDbCon();

        $sql="select subject from thread where id=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$params['id']]);

        $data=$stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    public function createThread(String $subject,String $text,String $categoryId){
        $pdo=$this->newDbCon();

        $sql="insert into thread(subject,user_account_id,category_id) values(?,?,?)";

        $stmt=$pdo->prepare($sql);

        session_start();
        $userId=$_SESSION['uid'];

        $stmt->execute([$subject,$userId,$categoryId]);

        $threadId=$pdo->lastInsertId();

        $post=new Post();
        $post->createPost($text, $threadId, $userId);

        return  $threadId;
    }

    public function getThreads(String $userID){
        $pdo=$this->newDbCon();

        $sql="select * from thread where user_account_id=?";

        $stmt=$pdo->prepare($sql);

        $stmt->execute([$userID]);

        $data=$stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

}