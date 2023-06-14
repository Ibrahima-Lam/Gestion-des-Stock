<?php

namespace App\Modele;

class Commande extends Modele
{
    public $idCommande;
    public $dateCommande;
    public $delaiCommande;
    public $idClient;
    public $nomClient;

    public function findAll(): false|array
    {
        $res = $this->select("select * from commande natural join client ", self::class);
        return $res;
    }
    public function findOne($id): false|self
    {
        $res = $this->select("select * from commande natural join client where idCommande='$id'", self::class, true);
        return $res;
    }
    public function findLastOne(): false|self
    {
        $res = $this->select("select * from commande natural join client order by idCommande desc", self::class, true);
        return $res;
    }

    public function insert($id, $date, $delai, $client): bool
    {
        $req = "insert into commande values('$id','$date','$delai','$client')";
        return $this->exec($req);
    }

    public function update($id, $date, $delai, $client): bool
    {
        $req = "update commande set dateCommande='$date',delaiCommande='$delai',idClient='$client' where idCommande='$id'";
        return $this->exec($req);
    }

    public function delete(string $id): bool
    {
        $req = "delete from commande where idCommande='$id'";
        return $this->exec($req);
    }
}
