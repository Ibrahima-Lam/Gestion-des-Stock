<?php

namespace App\Controllers;

class StockController extends Controller
{

    public function index(): void
    {
        $stocks = $this->loadModel("proposer")->findAll();
        $articles = $this->loadModel("article")->findAll();
        $fournisseurs = $this->loadModel("fournisseur")->findAll();
        $this->render("stock", compact("stocks", "articles", "fournisseurs"));
    }
}
