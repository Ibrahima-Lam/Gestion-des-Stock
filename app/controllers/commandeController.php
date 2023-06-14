<?php

namespace App\Controllers;

class CommandeController extends Controller
{

    public function index(): void
    {
        $commandes = $this->loadModel("commande")->findAll();
        $clients = $this->loadModel("client")->findAll();
        $articles = $this->loadModel("article")->findAll();
        $this->render("commande", compact("commandes", "clients", "articles"));
    }
}
