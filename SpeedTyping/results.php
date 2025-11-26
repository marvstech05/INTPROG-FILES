<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
$wpm = $_POST['wpm'] ?? 0;
$accuracy = $_POST['accuracy'] ?? 0;


$data = date("Y-m-d H:i:s") . " | WPM: $wpm | Accuracy: $accuracy%\n";


file_put_contents("results.txt", $data, FILE_APPEND);


echo "Saved";
}
?>