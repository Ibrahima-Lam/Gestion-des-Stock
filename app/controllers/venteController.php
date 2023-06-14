<?php

namespace App\Controllers;

class VenteController extends Controller
{

    public function index(): void
    {
        $ventes = $this->loadModel("contenir")->findAll();
        $commandes = $this->loadModel("commande")->findAll();
        $articles = $this->loadModel("article")->findAll();
        $this->render("vente", compact("ventes", "commandes", "articles"));
    }
}
