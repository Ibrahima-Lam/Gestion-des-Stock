<?php

namespace App\Controllers;

class ArticleController extends Controller
{

    public function index(): void
    {
        $result = $this->loadModel("article")->findAll();
        $categories = $this->loadModel("categorie")->findAll();
        $this->render("article", compact("result", "categories"));
    }
}
