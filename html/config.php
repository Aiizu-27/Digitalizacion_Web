//Punto central de la conexión con la base de datos

<?php
// CONFIGURACIÓN DE BASE DE DATOS
$host = "localhost";      // servidor de la base de datos
$usuario = "root";        // usuario de la base de datos
$password = "";           // contraseña
$bd = "dailydose";       // nombre de la base de datos
$db_host = "prueba.ckn6a668aan5.us-east-1.rds.amazonaws.com"
$db_port = "3306"

// Crear conexión
$conn = new mysqli($host, $usuario, $password, $bd);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Configurar charset
$conn->set_charset("utf8");
?>
