<?php

namespace App\Modele;

class Article extends Modele
{
    public $idArticle;
    public $nomArticle;
    public $prix_vente;
    public $description;
    public $idCategorie;
    public $nomCategorie;
    public function findAll(): false|array
    {
        $res = $this->select("select * from article natural join categorie", self::class);
        return $res;
    }
    public function findOne($id): false|self
    {
        $res = $this->select("select * from article natural join categorie where idArticle='$id'", self::class, true);
        return $res;
    }
    public function findLastOne(): false|self
    {
        $res = $this->select("select * from article natural join categorie order by idArticle desc", self::class, true);
        return $res;
    }

    public function insert($id, $nom, $prix, $description, $categorie): bool
    {
        $req = "insert into article values(null,'$nom','$prix','$description','$categorie')";
        return $this->exec($req);
    }

    public function update($id, $nom, $prix, $description, $categorie): bool
    {
        $req = "update article set nomArticle='$nom',prix_vente='$prix',description='$description',idCategorie='$categorie' where idArticle='$id'";
        return $this->exec($req);
    }

    public function delete(string $id): bool
    {
        $req = "delete from article where idArticle='$id'";
        return $this->exec($req);
    }
}
