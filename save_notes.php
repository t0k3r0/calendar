<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calendar";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$date = $data['date'];
$notes = $data['notes'];

foreach ($notes as $note) {
    $id = $note['id'];
    $hour = $note['hour'];
    $text = $note['text'];
    $moreInfo = $note['moreInfo'];

    $sql = "INSERT INTO notes (id, date, hour, text, more_info, completed)
            VALUES ($id, '$date', '$hour', '$text', '$moreInfo', FALSE)
            ON DUPLICATE KEY UPDATE
                hour = '$hour',
                text = '$text',
                more_info = '$moreInfo',
                completed = FALSE";
    $conn->query($sql);
}

$conn->close();
?>
