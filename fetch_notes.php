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

$sql = "SELECT * FROM notes WHERE date = '$date'";
$result = $conn->query($sql);

$notes = array();
while ($row = $result->fetch_assoc()) {
    $notes[] = $row;
}

echo json_encode($notes);

$conn->close();
?>
