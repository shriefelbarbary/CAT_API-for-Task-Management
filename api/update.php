<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');

include_once __DIR__ . '/../config/Database.php';
include_once __DIR__ . '/../models/Task.php';

// Database connection
$database = new Database();
$db = $database->connect();

// Create Task instance
$task = new Task($db);

// Get raw PUT data
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id) && !empty($data->title) && !empty($data->description)) {
    $task->id = $data->id;
    $task->title = $data->title;
    $task->description = $data->description;

    if ($task->update()) {
        echo json_encode(["message" => "Task updated successfully!"]);
    } else {
        echo json_encode(["message" => "Failed to update task."]);
    }
} else {
    echo json_encode(["message" => "Incomplete data."]);
}
?>
