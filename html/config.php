//Punto central de la conexión con la base de datos

<?php
// CONFIGURACIÓN DE BASE DE DATOS
$host = "localhost";      // servidor de la base de datos
$usuario = "root";        // usuario de la base de datos
$password = "";           // contraseña
$bd = "daily_dose";       // nombre de la base de datos

// Crear conexión
$conn = new mysqli($host, $usuario, $password, $bd);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Configurar charset
$conn->set_charset("utf8");
?>
