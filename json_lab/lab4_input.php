<?php
$jsonInput = file_get_contents('php://input');
$data = json_decode($jsonInput, true);

if (!$data) {
    $data = ["username" => "admin", "password" => "1234"];
}

echo "Username: " . $data['username'] . "<br>";
echo "Password: " . $data['password'];
?>