<?php
// CONFIGURACIÓN DE BASE DE DATOS
$host = "localhost";
$usuario = "admin_dd";
$contrasena = "271304Lu"; 
$basedatos = "dailydose";

// Crear conexión
// CORRECCIÓN: Usamos $contrasena en lugar de $password
// CORRECCIÓN: Usamos $basedatos en lugar de $bd
$conn = new mysqli($host, $usuario, $contrasena, $basedatos);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Configurar charset para tildes y ñ
$conn->set_charset("utf8");
?>