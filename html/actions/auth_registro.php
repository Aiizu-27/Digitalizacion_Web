<?php
// actions/auth_registro.php
session_start();
require_once "../includes/config.php";

// Recoger datos del formulario
$nombre    = trim($_POST['nombre'] ?? '');
$apellidos = trim($_POST['apellidos'] ?? '');
$correo    = trim($_POST['correo'] ?? '');
$pass      = $_POST['contrasena'] ?? '';
$telefono  = trim($_POST['telefono'] ?? '');

// Validar campos obligatorios
if (empty($nombre) || empty($correo) || empty($pass)) {
    echo "campos_vacios";
    exit;
}

// Comprobar si el correo ya existe en USUARIOS
$stmt = $conn->prepare("SELECT ID_USUARIO FROM USUARIOS WHERE EMAIL = ?");
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

// Encriptar contraseña con HASH
$pass_hash = password_hash($pass, PASSWORD_DEFAULT);

// Insertar primero en USUARIOS
$stmt = $conn->prepare(
    "INSERT INTO USUARIOS (NOMBRE, APELLIDOS, EMAIL, CONTRASENA, ROL, CAMBIAR_PASSWORD)
     VALUES (?, ?, ?, ?, 'CLIENTE', FALSE)"
);
$stmt->bind_param("ssss", $nombre, $apellidos, $correo, $pass_hash);

if (!$stmt->execute()) {
    echo "error_insert_usuario";
    $stmt->close();
    $conn->close();
    exit;
}

// Obtener ID_USUARIO generado
$id_usuario = $stmt->insert_id;
$stmt->close();

// Insertar en CLIENTES
$stmt = $conn->prepare(
    "INSERT INTO CLIENTES (ID_USUARIO, TELEFONO, PUNTOS)
     VALUES (?, ?, 0)"
);
$stmt->bind_param("is", $id_usuario, $telefono);

if ($stmt->execute()) {
    echo "registro_ok";
} else {
    echo "error_insert_cliente";
}

$stmt->close();
$conn->close();