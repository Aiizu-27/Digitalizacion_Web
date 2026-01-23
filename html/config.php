//Punto central de la conexión con la base de datos

<?php
// CONFIGURACIÓN DE BASE DE DATOS
$host = "localhost";
$usuario = "admin_dd";
$contrasena = "271304Lu";
#$usuario = "root";
#$contrasena = "13001300"; // Tu contraseña MySQL
$basedatos = "dailydose";
#$db_host = "prueba.ckn6a668aan5.us-east-1.rds.amazonaws.com";
#$db_port = "3306";

// Crear conexión
$conn = new mysqli($host, $usuario, $password, $bd);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Configurar charset
$conn->set_charset("utf8");
?>
