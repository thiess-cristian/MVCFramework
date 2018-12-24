<?php

namespace App\Controllers;


use App\Models\Thread;
use Framework\Controller;

class ThreadController extends Controller
{
    public function showThread(array $params){
        $thread=new Thread();

        $posts=$thread->getPosts($params);

        $subject=$thread->getThreadSubject($params);


        $data['posts']=$posts;
        $data['subject']=$subject['subject'];

        $this->view('/Thread.html.twig',$data);
    }
}