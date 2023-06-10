<?php

use src\Database;

require_once "../autoload/autoloder.php";

$p = $_GET["p"] ?? "app/index";
$args = explode("/", $p);


$controller = "App\Controllers\\" . $args[0] . "Controller";
$methode = $args[1] ?? "index";
unset($args[0]);
unset($args[1]);
$instance = new $controller;
if (method_exists($instance, $methode)) call_user_func_array([$instance, $methode], $args ?? []);
else echo "error 404";
