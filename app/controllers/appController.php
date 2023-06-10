<?php

namespace App\Controllers;

class AppController extends Controller
{

    public function index(): void
    {
        $this->render("home");
    }
}
