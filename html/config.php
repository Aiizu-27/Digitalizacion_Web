<?php
// CONFIGURACIÓN DE BASE DE DATOS
$host = "localhost";
$usuario = "admin_dd";
$contrasena = "271304Lu"; 
$basedatos = "dailydose";

#$usuario = "root";
#$contrasena = "13001300";
#$host = "prueba.ckn6a668aan5.us-east-1.rds.amazonaws.com";
#$port = "3306";

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $basedatos);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Configurar charset para tildes y ñ
$conn->set_charset("utf8");
?>