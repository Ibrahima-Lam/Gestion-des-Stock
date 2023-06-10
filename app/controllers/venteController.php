<?php

namespace App\Controllers;
    
class VenteController extends Controller
{
    
    public function index(): void
    {
    $this->render("vente");
    }
}
