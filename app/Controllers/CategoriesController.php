<?php

namespace App\Controllers;


use App\Models\Categories;
use Framework\Controller;

class CategoriesController extends Controller
{

    public function showCategories(array $params){
        $categories=new Categories();

        $data=$categories->getCategories();

        $this->view("Index.html.twig",$data);
    }

}