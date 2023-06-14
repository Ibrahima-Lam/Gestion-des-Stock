<?php

namespace App\Controllers;

class StatistiqueController extends Controller
{

    public function index(): void
    {
        $this->render("statistique");
    }
}
