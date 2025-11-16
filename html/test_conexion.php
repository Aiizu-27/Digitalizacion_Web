<?php
$host = "localhost";      // o 127.0.0.1
$usuario = "root";        // tu usuario de MySQL
$contrasena = "";         // tu contraseña de MySQL
$basedatos = "DailyDose"; // tu base de datos

$conn = new mysqli($host, $usuario, $contrasena, $basedatos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "¡Conexión exitosa a la base de datos!";
}
?>
