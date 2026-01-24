<?php
session_start();
require_once "../includes/config.php"; // <--- ESTO REEMPLAZA TUS 15 LÍNEAS DE CONEXIÓN

// Recoger datos enviados por POST
$correo = $_POST['correo'] ?? '';
$pass = $_POST['contrasena'] ?? '';

// ... resto de tu lógica de login (SELECT, password verify, etc) ...
// ...
// Al final solo cierras la conexión
$conn->close();
?>