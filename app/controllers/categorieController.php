<?php

namespace App\Controllers;

class CategorieController extends Controller
{

    public function index(): void
    {
        $categories = $this->loadModel("categorie")->findAll();
        $this->render("categorie", compact("categories"));
    }
}
