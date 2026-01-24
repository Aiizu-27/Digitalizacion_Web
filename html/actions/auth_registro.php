<?php
session_start();
require_once "../includes/config.php"; // <--- CONEXIÓN CENTRALIZADA

// Recoger datos
$nombre = $_POST['nombre'] ?? '';
$correo = $_POST['correo'] ?? '';
// ... resto de variables ...

// Verificar si correo ya existe
// $conn viene de config.php
$stmt = $conn->prepare("SELECT ID_CLIENTE FROM CLIENTES WHERE CORREO = ?");

// ... resto del código ...
?>