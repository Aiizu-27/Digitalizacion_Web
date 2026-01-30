<?php
// actions/auth_cambiar_pass.php
session_start();
require_once "../includes/config.php";

$id_usuario = $_POST['id_usuario'] ?? 0;
$nueva_pass = $_POST['nueva_contrasena'] ?? '';
$confirmar  = $_POST['confirmar_contrasena'] ?? '';

// Validaciones básicas
if (empty($nueva_pass) || empty($confirmar) || $nueva_pass !== $confirmar) {
    echo "error_validacion";
    exit;
}

// Hash de la nueva contraseña
$pass_hash = password_hash($nueva_pass, PASSWORD_DEFAULT);

// Actualizar en la base de datos
$stmt = $conn->prepare(
    "UPDATE USUARIOS SET CONTRASENA = ?, CAMBIAR_PASSWORD = FALSE WHERE ID_USUARIO = ?"
);
$stmt->bind_param("si", $pass_hash, $id_usuario);

if ($stmt->execute()) {
    echo "cambio_ok";
    // Opcional: actualizar sesión
    $_SESSION['CAMBIAR_PASSWORD'] = false;
} else {
    echo "error_actualizar";
}

$stmt->close();
$conn->close();