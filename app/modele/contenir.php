<?php

namespace App\Modele;

class Contenir extends Modele
{
    const QUERY = "select * from contenir natural join article natural join categorie natural join client natural join commande ";

    public $idArticle;
    public $nomArticle;
    public $prix_vente;
    public $description;
    public $idCategorie;
    public $nomCategorie;
    public $idCommande;
    public $dateCommande;
    public $delaiCommande;
    public $quantite;
    public $idClient;
    public $nomClient;
    public $adresseClient;
    public $telClient;
    public $emailClient;

    public function findAll(): false|array
    {
        $res = $this->select(self::QUERY, self::class);
        return $res;
    }
    public function findAllById($id): false|array
    {
        $req = self::QUERY;
        $req .= " where idCommande='$id'";
        $res = $this->select($req, self::class);
        return $res;
    }
    public function findOne($idC, $idA): false|self
    {
        $req = self::QUERY;
        $req .= " where idArticle='$idA'and idCommande='$idC'";
        $res = $this->select($req, self::class, true);
        return $res;
    }
    public function findLastOne(): false|self
    {
        $req = self::QUERY;
        $req .= "  order by idCommande desc, idArticle desc";
        $res = $this->select($req, self::class, true);
        return $res;
    }

    public function insert($idC, $idA, $quantite): bool
    {
        $req = "insert into contenir values('$idC','$idA','$quantite')";
        return $this->exec($req);
    }

    public function
    update($idC, $idA, $quantite): bool
    {
        $req = "update contenir set idCommande='$idC',idArticle='$idA',quantite='$quantite' where  idCommande='$idC'and idArticle='$idA'";
        return $this->exec($req);
    }

    public function delete(string $idC, string $idA): bool
    {
        $req = "delete from contenir where idCommande='$idC'and idArticle='$idA'";
        return $this->exec($req);
    }
}
