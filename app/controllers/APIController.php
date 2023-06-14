<?php

namespace App\Controllers;

class ApiController extends Controller
{
    public function __construct()
    {
        header('Content-Type:application/json');
    }


    public function article(string $slug,  $id = null): void
    {
        $model = $this->loadModel("article");
        $dt = $_GET["data"] ?? "[]";
        $dt = json_decode($dt, true);
        extract($dt ?? []);
        if ($slug == "find") {
            $data = $id ? $model->findOne($id) : $model->findAll();
        } elseif ($slug == "edit") {
            $res = $model->update($id, $nom, $prix, $description, $categorie);
            $data =  $model->findOne($id);
        } elseif ($slug == "insert") {
            $res = $model->insert($id, $nom, $prix, $description, $categorie);
            $data = $res ?  $model->findLastOne() : ["res" => false];
        } elseif ($slug == "delete") {
            $res = $model->delete($id);
            $data = $res ? ["res" => true] : ["res" => false];
        }
        if (!$data) $data = ["res" => false];
        echo json_encode($data);
    }
    public function categorie(string $slug,  $id = null): void
    {
        $model = $this->loadModel("categorie");
        $dt = $_GET["data"] ?? "[]";
        $dt = json_decode($dt, true);
        extract($dt ?? []);
        $data =  ["res" => false];
        if ($slug == "find") {
            $data = $id ? $model->findOne($id) : $model->findAll();
        } elseif ($slug == "edit") {
            $res = $model->update($id, $nom);
            $data =  $model->findOne($id);
        } elseif ($slug == "insert") {
            $res = $model->insert($id, $nom);
            $data = $res ?  $model->findLastOne() : ["res" => false];
        } elseif ($slug == "delete") {
            $res = $model->delete($id);
            $data = $res ? ["res" => true] : ["res" => false];
        }
        if (!$data) $data = ["res" => false];
        echo json_encode($data);
    }

    public function client(string $slug,  $id = null): void
    {
        $model = $this->loadModel("client");
        $dt = $_GET["data"] ?? "[]";
        $dt = json_decode($dt, true);
        extract($dt ?? []);
        if ($slug == "find") {
            $data = $id ? $model->findOne($id) : $model->findAll();
        } elseif ($slug == "edit") {
            $res = $model->update($id, $nom, $adresse, $tel, $email);
            $data =  $model->findOne($id);
        } elseif ($slug == "insert") {
            $res = $model->insert($id, $nom, $adresse, $tel, $email);
            $data = $res ?  $model->findLastOne() : ["res" => false];
        } elseif ($slug == "delete") {
            $res = $model->delete($id);
            $data = $res ? ["res" => true] : ["res" => false];
        }
        if (!$data) $data = ["res" => false];
        echo json_encode($data);
    }

    public function fournisseur(string $slug,  $id = null): void
    {
        $model = $this->loadModel("fournisseur");
        $dt = $_GET["data"] ?? "[]";
        $dt = json_decode($dt, true);
        extract($dt ?? []);
        if ($slug == "find") {
            $data = $id ? $model->findOne($id) : $model->findAll();
        } elseif ($slug == "edit") {
            $res = $model->update($id, $nom, $adresse, $tel);
            $data =  $model->findOne($id);
        } elseif ($slug == "insert") {
            $res = $model->insert($id, $nom, $adresse, $tel);
            $data = $res ?  $model->findLastOne() : ["res" => false];
        } elseif ($slug == "delete") {
            $res = $model->delete($id);
            $data = $res ? ["res" => true] : ["res" => false];
        }
        if (!$data) $data = ["res" => false];
        echo json_encode($data);
    }

    public function commande(string $slug,  $id = null): void
    {
        $model = $this->loadModel("commande");
        $dt = $_GET["data"] ?? "[]";
        $dt = json_decode($dt, true);
        extract($dt ?? []);
        if ($slug == "find") {
            $data = $id ? $model->findOne($id) : $model->findAll();
        } elseif ($slug == "edit") {
            $res = $model->update($id, $date, $delai,  $client);
            $data =  $model->findOne($id);
        } elseif ($slug == "insert") {
            $res = $model->insert($id, $date, $delai,  $client);
            $data = $res ?  $model->findLastOne() : ["res" => false];
        } elseif ($slug == "delete") {
            $res = $model->delete($id);
            $data = $res ? ["res" => true] : ["res" => false];
        }
        if (!$data) $data = ["res" => false];
        echo json_encode($data);
    }

    public function vente(string $slug,  $id = null): void
    {
        $model = $this->loadModel("contenir");
        $dt = $_GET["data"] ?? "[]";
        $dt = json_decode($dt, true);
        extract($dt ?? []);
        if ($slug == "find") {
            $data =  $model->findAll();
        } elseif ($slug == "match") {
            $data =  $model->findAllByid($id);
        } elseif ($slug == "edit") {
            $res = $model->update($idC, $idA, $quantite);
            $data =  $model->findOne($idC, $idA);
        } elseif ($slug == "insert") {
            $res = $model->insert($idC, $idA, $quantite);
            $data = $res ?  $model->findLastOne() : ["res" => false];
        } elseif ($slug == "delete") {
            $res = $model->delete($idC, $idA);
            $data = $res ? ["res" => true] : ["res" => false];
        }
        if (!$data) $data = ["res" => false];
        echo json_encode($data);
    }
}
