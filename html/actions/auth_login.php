<?php
// actions/auth_login.php
session_start();
require_once "../includes/config.php";

$correo = trim($_POST['correo'] ?? '');
$pass   = $_POST['contrasena'] ?? '';

// Validación básica
if (empty($correo) || empty($pass)) {
    echo "campos_vacios";
    exit;
}

// Buscar usuario
$stmt = $conn->prepare(
    "SELECT ID_CLIENTE, NOMBRE, CONTRASENA
     FROM CLIENTES
     WHERE CORREO = ?"
);
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();


    // Verificar contraseña (HASH)
    if (password_verify($pass, $usuario['CONTRASENA'])) {

        // Seguridad extra recomendada
        session_regenerate_id(true);

        $_SESSION['ID_CLIENTE'] = $usuario['ID_CLIENTE'];
        $_SESSION['NOMBRE']     = $usuario['NOMBRE'];

        echo "login_ok";
    } else {
        echo "contraseña_incorrecta";
    }
} else {
    echo "usuario_no_encontrado";
}

$stmt->close();
$conn->close();