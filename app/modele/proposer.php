<?php

namespace App\Modele;

class Proposer extends Modele
{
    const QUERY = "select * from proposer natural join article natural join categorie natural join fournisseur  ";

    public $idArticle;
    public $nomArticle;
    public $prix_vente;
    public $description;

    public $idCategorie;
    public $nomCategorie;

    public $idFournisseur;
    public $nomFournisseur;
    public $adresseFournisseur;
    public $telFournisseur;

    public $dateProposer;
    public $quantiteProposer;


    public function findAll(): false|array
    {
        $res = $this->select(self::QUERY, self::class);
        return $res;
    }
    public function findAllById($id): false|array
    {
        $req = self::QUERY;
        $req .= " where idAricle='$id'";
        $res = $this->select($req, self::class);
        return $res;
    }
    public function findOne($idA, $idF): false|self
    {
        $req = self::QUERY;
        $req .= " where idArticle='$idA'and idFournisseur='$idF'";
        $res = $this->select($req, self::class, true);
        return $res;
    }
    public function findLastOne(): false|self
    {
        $req = self::QUERY;
        $req .= "  order by idArticle desc ,idFournisseur desc ";
        $res = $this->select($req, self::class, true);
        return $res;
    }

    public function insert($idA, $idF, $quantite, $date): bool
    {
        $req = "insert into proposer values('$idA','$idF','$date','$quantite')";
        return $this->exec($req);
    }

    public function
    update($idA, $idF, $quantite, $date): bool
    {
        $req = "update proposer set idFournisseur='$idF',idArticle='$idA',quantiteProposer='$quantite',dateProposer='$date' where  idFournisseur='$idF'and idArticle='$idA'";
        return $this->exec($req);
    }

    public function delete(string $idA, string $idF): bool
    {
        $req = "delete from proposer where idFournisseur='$idF'and idArticle='$idA'";
        return $this->exec($req);
    }
}
