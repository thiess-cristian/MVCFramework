<?php

namespace App\Controllers;


use App\Models\Category;
use App\Models\Thread;
use Framework\Controller;

class CategoryController extends Controller
{
    public function showCategory(array $params): void
    {
        $category = new Category();
        $threads = $category->getThreadsFromCategory($params);

        $name = $category->getCategoryName($params);

        $params['threads'] = $threads;
        $params['category_name'] = $name['name'];
        $params['category_id'] = $params['id'];

        $this->view("/Category.html.twig", $params);
    }

    public function showThreadCreator(array $params): void
    {
        $params['category_id'] = $params['query'];
        $this->view("/CreateThread.html.twig", $params);
    }

    public function createThread(array $params): void
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