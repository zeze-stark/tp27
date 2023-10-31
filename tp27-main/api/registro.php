<?php

include("../classes/user.php");
include("../config/config.php");

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");

$usuarios = new User($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    // echo json_encode($_POST);
    echo json_encode($usuarios->register($_POST['usuario'], $_POST['password'], $_POST['email']));
    header("HTTP/1.1 200 OK");
    exit();
}
