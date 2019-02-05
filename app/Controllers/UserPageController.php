<?php
/**
 * Created by PhpStorm.
 * User: Cristi
 * Date: 12/28/2018
 * Time: 9:47 AM
 */

namespace App\Controllers;


use App\Models\Post;
use App\Models\Thread;
use App\Models\User;
use Framework\Controller;

class UserPageController extends Controller
{
    public function showUserPage(array $params)
    {
        $user = new User();
        $userInfo=$user->get($params['id']);
        $params['username_page']=$userInfo['name'];

        $thread = new Thread();
        $threads = $thread->getThreads($params['id']);
        $params['threads'] = $threads;

        $post_model=new Post();
        $posts=$post_model->getReportedPosts();
        $params['posts']=$posts;

        $this->view("UserPage.html.twig", $params);
    }
}