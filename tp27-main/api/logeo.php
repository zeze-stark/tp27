<?php

include("../classes/user.php");
include("../config/config.php");

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");

$usuarios = new User($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo json_encode($usuarios->login($_POST['usuario'], $_POST['password']));
    header("HTTP/1.1 200 OK");
    exit();
}
