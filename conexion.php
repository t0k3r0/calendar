<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notes";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener datos del visitante
$ipVisitante = $_SERVER["REMOTE_ADDR"];
$fechaHora = date("Y-m-d H:i:s");
$agenteUsuario = $_SERVER["HTTP_USER_AGENT"];

// Insertar datos del visitante en la tabla visitantes
$sql = "INSERT INTO visitantes (ip, fechaHora, agenteUsuario) 
        VALUES ('$ipVisitante', '$fechaHora', '$agenteUsuario')";

if ($conn->query($sql) === FALSE) {
    echo "Error al insertar datos: " . $conn->error;
}

// Cerrar conexión al finalizar
$conn->close();
?>
