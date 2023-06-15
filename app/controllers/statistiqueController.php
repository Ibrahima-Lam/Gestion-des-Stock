<?php

namespace App\Controllers;

class StatistiqueController extends Controller
{

    public function index(): void
    {
        $statistiques = $this->loadModel("contenir")->findCountAll();
        $articles = $this->loadModel("contenir")->findArticleCountAll();
        $this->render("statistique", compact("statistiques", "articles"));
    }
}
