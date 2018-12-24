<?php

namespace App\Controllers;


use App\Models\Category;
use Framework\Controller;

class CategoryController extends Controller
{
    public function showCategory(array $params){
        $category=new Category();
        $threads=$category->getThreadsFromCategory($params);

        $name=$category->getCategoryName($params);

        $data=array();

        $data['threads']=$threads;
        $data['category_name']=$name['name'];

        $this->view("/category.html.twig",$data);
    }
}