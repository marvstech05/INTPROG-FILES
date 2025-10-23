<?php
$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (isset($data['name'])) {
    $name = $data['name'];
} else {
    $name = "Guest"; 
}

$response = array(
    "status" => "success",
    "message" => "Welcome, $name!"
);

header('Content-Type: application/json');
echo json_encode($response);
?>