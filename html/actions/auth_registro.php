<?php
// actions/auth_registro.php
session_start();
require_once "../includes/config.php";

// Recoger datos
$nombre   = trim($_POST['nombre'] ?? '');
$correo   = trim($_POST['correo'] ?? '');
$pass     = $_POST['contrasena'] ?? '';
$telefono = trim($_POST['telefono'] ?? '');

// Validar campos obligatorios
if (empty($nombre) || empty($correo) || empty($pass)) {
    echo "campos_vacios";
    exit;
}

// Comprobar si el correo ya existe
$stmt = $conn->prepare("SELECT ID_CLIENTE FROM CLIENTES WHERE CORREO = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "correo_existente";
    $stmt->close();
    $conn->close();
    exit;
}
$stmt->close();

// Encriptar contraseña (HASH)
$pass_hash = password_hash($pass, PASSWORD_DEFAULT);

// Insertar usuario
$stmt = $conn->prepare(
    "INSERT INTO CLIENTES (NOMBRE, CORREO, CONTRASENA, TELEFONO, PUNTOS)
     VALUES (?, ?, ?, ?, 0)"
);
$stmt->bind_param("ssss", $nombre, $correo, $pass_hash, $telefono);

if ($stmt->execute()) {
    echo "registro_ok";
} else {
    echo "error_insert";
}

$stmt->close();
$conn->close();