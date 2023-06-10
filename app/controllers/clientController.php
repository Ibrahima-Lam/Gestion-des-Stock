<?php

namespace App\Controllers;
    
class ClientController extends Controller
{
    
    public function index(): void
    {
    $this->render("client");
    }
}
