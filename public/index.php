<?php

use src\Database;

require_once "../autoload/autoloder.php";

$p = $_GET["p"] ?? "app/index";
$args = explode("/", $p);
$class = $args[0] ?? null;

$controller = "App\Controllers\\" . $class . "Controller";
$methode = $args[1] ?? "index";
unset($args[0]);
unset($args[1]);
$instance = new $controller;
if (method_exists($instance, $methode)) call_user_func_array([$instance, $methode], $args ?? []);
elseif (strtoupper($class) === "API") "{res:error}";
else echo "error 404";
