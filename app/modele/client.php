<?php

namespace App\Modele;

class Client extends Modele
{
    public  $idClient;
    public  $nomClient;
    public  $adresseClient;
    public  $telClient;
    public  $emailClient;

    public function findAll(): false|array
    {
        $res = $this->select("select * from client", self::class);
        return $res;
    }
    public function findOne($id): false|self
    {
        $res = $this->select("select * from client where idClient='$id'", self::class, true);
        return $res;
    }
    public function findLastOne(): false|self
    {
        $res = $this->select("select * from client  order by idClient desc", self::class, true);
        return $res;
    }

    public function insert($id, $nom, $adresse, $tel, $email): bool
    {
        $req = "insert into client values(null,'$nom','$adresse','$tel','$email')";
        return $this->exec($req);
    }

    public function update($id, $nom, $adresse, $tel, $email): bool
    {
        $req = "update client set nomClient='$nom',adresseClient='$adresse',telClient='$tel',emailClient='$email' where idClient='$id'";
        return $this->exec($req);
    }

    public function delete(string $id): bool
    {
        $req = "delete from client where idClient='$id'";
        return $this->exec($req);
    }
}
