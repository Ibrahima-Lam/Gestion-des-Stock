<?php

namespace App\Controllers;

class ClientController extends Controller
{

    public function index(): void
    {
        $clients = $this->loadModel("client")->findAll();
        $this->render("client", compact("clients"));
    }
}
