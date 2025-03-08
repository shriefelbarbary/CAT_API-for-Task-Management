<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

include_once __DIR__ . '/../config/Database.php';
include_once __DIR__ . '/../models/Task.php';

$database = new Database();
$db = $database->connect();
$task = new Task($db);
$data = json_decode(file_get_contents('php://input'));
if (!empty($data->title) && !empty($data->description)){
    $task->title = $data->title;
    $task->description = $data->description;
    if ($task->create())
        echo json_encode(["message" => "Task created successfully!"]);
    else
        echo json_encode(['message' => "Failed to create task."]);
}
else
    echo json_encode(['message' => "Incomplete data."]);
?>
