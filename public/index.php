<?php
require_once "../autoload/autoloder.php";

$p = $_GET["p"] ?? null;
$args = explode("/", $p);


$controller = "App\Controllers\\" . $args[0] . "Controller";
$methode = $args[1];
$instance = new $controller;
call_user_func_array([$instance, $methode], []);
