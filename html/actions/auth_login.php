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

// Buscar usuario en USUARIOS
$stmt = $conn->prepare(
    "SELECT ID_USUARIO, NOMBRE, APELLIDOS, CONTRASENA, ROL, CAMBIAR_PASSWORD
     FROM USUARIOS
     WHERE EMAIL = ?"
);
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    // Verificar contraseña
    if (password_verify($pass, $usuario['CONTRASENA'])) {

        // Seguridad extra
        session_regenerate_id(true);

        $_SESSION['ID_USUARIO']       = $usuario['ID_USUARIO'];
        $_SESSION['NOMBRE']           = $usuario['NOMBRE'];
        $_SESSION['APELLIDOS']        = $usuario['APELLIDOS'];
        $_SESSION['ROL']              = $usuario['ROL'];
        $_SESSION['CAMBIAR_PASSWORD'] = $usuario['CAMBIAR_PASSWORD'];

        // Si debe cambiar la contraseña
        if ($usuario['CAMBIAR_PASSWORD']) {
            echo "cambiar_password";
        } else {
            echo "login_ok";
        }
    } else {
        echo "contraseña_incorrecta";
    }
} else {
    echo "usuario_no_encontrado";
}

$stmt->close();
$conn->close();