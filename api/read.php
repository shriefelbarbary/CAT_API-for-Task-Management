<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once '../config/Database.php';
include_once '../models/Task.php';

$database = new Database();
$db = $database->connect();
$post = new Task($db);
$result = $post->read();
$num = $post->rowCount();

if ($num > 0) {
    $post_arr = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $post_item = array(
            'id' => $id,
            'title' => $title,
            'description' => $description
        );
        //        $post_arr['data'][] = $post_item;
        array_push($post_arr, $post_item);
    }
    echo json_encode($post_arr);
}
else{
    echo json_encode(
        array('message' => 'No Posts Found !')
    );
}