<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once __DIR__ . '/../config/Database.php';
include_once __DIR__ . '/../models/Task.php';

// Database connection
$database = new Database();
$db = $database->connect();

$task = new Task($db);
$data = json_decode(file_get_contents('php://input'));
if (!empty($data->id)){
    $task->id = $data->id;
    if ($task->delete()){
        echo json_encode(["message" => "Task deleted successfully!"]);
    } else {
        echo json_encode(["message" => "Failed to delete task."]);
    }
}
else{
    echo json_encode(["message" => "Missed id!"]);

}