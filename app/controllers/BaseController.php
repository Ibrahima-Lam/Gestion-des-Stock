<?php

namespace App\Controllers;
    
class BaseController extends Controller
{
    
    public function index(): void
    {
    $this->render("texte");
    }
}
