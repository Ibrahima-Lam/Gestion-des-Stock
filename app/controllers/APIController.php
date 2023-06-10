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
            $data = $res ?  $model->findLastOne() : false;
        } elseif ($slug == "delete") {
            $res = $model->delete($id);
            $data = $res ?  true : false;
        }

        echo json_encode($data);
    }
}
