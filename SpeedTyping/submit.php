<?php
$host = "localhost";  
$user = "root";       
$pass = "";           
$db = "typify";       

$conn = new mysqli($host, $user, $pass, $db);
if($conn->connect_error) die("Connection failed: ".$conn->connect_error);

$name = $_POST['name'] ?? '';
$wpm = $_POST['wpm'] ?? 0;
$time = $_POST['time'] ?? 0;

if($name && $wpm) {
    $stmt = $conn->prepare("INSERT INTO leaderboard (name, wpm, time) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $name, $wpm, $time);
    $stmt->execute();
    $stmt->close();
    echo "Success";
} else {
    echo "Error: Missing name or WPM";
}

$conn->close();
?>
