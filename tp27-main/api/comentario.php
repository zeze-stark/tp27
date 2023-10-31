<?php

include("../classes/comment.php");
include("../config/config.php");

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");

$comentario = new Comment($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($comentario->createComment($data['post_id'], $data['content'], $data['author_id']));
    header("HTTP/1.1 200 OK");
    exit();
}
