<?php

namespace App\Modele;

class Fournisseur extends Modele
{
    public  $idFournisseur;
    public  $nomFournisseur;
    public  $adresseFournisseur;
    public  $telFournisseur;

    public function findAll(): false|array
    {
        $res = $this->select("select * from fournisseur", self::class);
        return $res;
    }
    public function findOne($id): false|self
    {
        $res = $this->select("select * from fournisseur where idFournisseur='$id'", self::class, true);
        return $res;
    }
    public function findLastOne(): false|self
    {
        $res = $this->select("select * from fournisseur  order by idFournisseur desc", self::class, true);
        return $res;
    }

    public function insert($id, $nom, $adresse, $tel): bool
    {
        $req = "insert into fournisseur values('$id','$nom','$adresse','$tel')";
        return $this->exec($req);
    }

    public function update($id, $nom, $adresse, $tel): bool
    {
        $req = "update fournisseur set nomFournisseur='$nom',adresseFournisseur='$adresse',telFournisseur='$tel' where idFournisseur='$id'";
        return $this->exec($req);
    }

    public function delete(string $id): bool
    {
        $req = "delete from fournisseur where idFournisseur='$id'";
        return $this->exec($req);
    }
}
