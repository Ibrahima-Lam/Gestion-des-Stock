<?php

namespace App\Controllers;

class FournisseurController extends Controller
{

    public function index(): void
    {
        $fournisseurs = $this->loadModel("fournisseur")->findAll();
        $this->render("fournisseur", compact("fournisseurs"));
    }
}
