<?php

namespace App\Models;

use \PDO;
use Framework\Model;

class Post extends Model
{

    protected $table="post";

    public function createPost(String $text,String $threadId,String $userId){

        $pdo=$this->newDbCon();

        $sql="insert into post(content,thread_id,user_account_id) values(?,?,?)";

        $stmt=$pdo->prepare($sql);

        $stmt->execute([$text,$threadId,$userId]);
    }

    public function getPost(String $id){
        $pdo=$this->newDbCon();

        $sql="select p.content, u.name from post p join user_account u on p.user_account_id=u.id where p.id=?";

        $stmt=$pdo->prepare($sql);

        $stmt->execute([$id]);

        $data=$stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getReportedPosts(){
        return $this->find(['reported' => 1]);
    }

    public function reportPost($id){
        $this->update(['id'=>$id], ['reported' => 1]);
    }

    public function votePost($id,$score){
        $pdo=$this->newDbCon();
        $sql="update post set score=score+".$score." where id=?";

        $stmt=$pdo->prepare($sql);

        $stmt->execute([$id]);
    }
}