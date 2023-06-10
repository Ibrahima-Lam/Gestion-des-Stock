<?php

namespace App\Modele;

class Categorie extends Modele
{
    public $idCategorie;
    public $nomCategorie;

    public function findAll(): false|array
    {
        return $this->select("select * from categorie", self::class);
    }
}
