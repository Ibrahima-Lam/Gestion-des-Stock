<?php

namespace App\Controllers;

class FournisseurController extends Controller
{

    public function index(): void
    {
        $this->render("fournisseur");
    }
}
