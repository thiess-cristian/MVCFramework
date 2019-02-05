<?php
/**
 * Created by PhpStorm.
 * User: Cristi
 * Date: 2/5/2019
 * Time: 10:26 AM
 */

namespace App\Guards;


use App\Models\Post;
use Framework\Guard;

class DeleteGuard implements Guard
{
    public function handle(array $params = null): void
    {
        session_start();
        if ($_SESSION['username'] != 'admin') {

            $split_query = null;
            if (isset($params['query'])) {
                parse_str($params['query'], $split_query);
            }
            $postModel = new Post();

            $postInfo = $postModel->get($split_query['id']);
            if ($_SESSION['uid'] != $postInfo['user_account_id']) {
                $this->reject();
            }
        }
    }

    public function reject(): void
    {
        header("Location: /");
    }


}