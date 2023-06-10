<?php

namespace App\Controllers;
    
class StockController extends Controller
{
    
    public function index(): void
    {
    $this->render("stock");
    }
}