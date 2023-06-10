<?php

namespace App\Controllers;

class CommandeController extends Controller
{

    public function index(): void
    {
        $this->render("commande");
    }
}
