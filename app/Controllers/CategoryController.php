<?php

namespace App\Controllers;


use App\Models\Category;
use App\Models\Thread;
use Framework\Controller;

class CategoryController extends Controller
{
    public function showCategory(array $params)
    {
        $category = new Category();
        $threads = $category->getThreadsFromCategory($params);

        $name = $category->getCategoryName($params);

        $data = array();

        $data['threads'] = $threads;
        $data['category_name'] = $name['name'];
        $data['category_id'] = $params['id'];


        $this->view("/Category.html.twig", $data);
    }

    public function showThreadCreator(array $params)
    {
        $params['category_id'] = $params['query'];
        $this->view("/CreateThread.html.twig", $params);
    }

    public function createThread(array $params)
    {
        $split_query = null;
        if (isset($params['query'])) {
            parse_str($params['query'], $split_query);
        }

        $categoryId = $split_query['cat'];
        $threadSubject = $_POST['subject'];
        $threadContent = $_POST['content'];

        $thread = new Thread();

        $threadId = $thread->createThread($threadSubject, $threadContent, $categoryId);

        header("Location:/thread/" . $threadId);
    }
}