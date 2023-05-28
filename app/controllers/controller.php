<?php

namespace App\Controllers;

class Controller
{

    public function render(string $view, array $data = []): void
    {
        extract($data);
        ob_start();
        $file = "../App/views/$view.php";
        if (file_exists($file)) require_once $file;
        else echo "Erreur de fichier";
        $content = ob_get_clean();
        require_once "layout.php";
    }
}
