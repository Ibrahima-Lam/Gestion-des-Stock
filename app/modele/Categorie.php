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


    public function findOne($id): false|self
    {
        return $this->select("select * from categorie where idCategorie='$id'", self::class, true);
    }


    public function findLastOne(): false|self
    {
        return $this->select("select * from categorie order  by idCategorie desc", self::class, true);
    }


    public function insert($id, $nom): bool
    {
        $req = "insert into categorie values (null,'$nom')";
        return $this->exec($req);
    }


    public function update($id, $nom): bool
    {
        $req = "update categorie  set nomCategorie='$nom' where idCategorie='$id'";
        return $this->exec($req);
    }


    public function delete($id): bool
    {
        $req = "delete from categorie  where idCategorie='$id'";
        return $this->exec($req);
    }
}
