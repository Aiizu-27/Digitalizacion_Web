<?php
// actions/auth_login.php
session_start();
require_once "../includes/config.php";

header('Content-Type: text/plain');

$correo = trim($_POST['correo'] ?? '');
$pass   = $_POST['contrasena'] ?? '';

if (empty($correo) || empty($pass)) {
    echo "campos_vacios";
    exit;
}

// Preparar y ejecutar query
$stmt = $conn->prepare("SELECT ID_USUARIO, NOMBRE, APELLIDOS, CONTRASENA, ROL, CAMBIAR_PASSWORD 
                        FROM USUARIOS 
                        WHERE EMAIL = ?");
if (!$stmt) {
    echo "error_sql_prepare";
    exit;
}

$stmt->bind_param("s", $correo);

if (!$stmt->execute()) {
    echo "error_sql_execute";
    exit;
}

$resultado = $stmt->get_result();

if ($resultado && $resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    if (!$usuario) {
        echo "error_fetch_assoc";
        exit;
    }

    // Asegurarse de que las columnas existen
    $rol = strtoupper($usuario['ROL'] ?? '');
    $hashPass = $usuario['CONTRASENA'] ?? '';

    if (password_verify($pass, $hashPass)) {
        session_regenerate_id(true);
        $_SESSION['ID_USUARIO']       = $usuario['ID_USUARIO'];
        $_SESSION['NOMBRE']           = $usuario['NOMBRE'];
        $_SESSION['APELLIDOS']        = $usuario['APELLIDOS'];
        $_SESSION['ROL']              = $rol;
        $_SESSION['CAMBIAR_PASSWORD'] = $usuario['CAMBIAR_PASSWORD'];

        if ($usuario['CAMBIAR_PASSWORD']) {
            echo "cambiar_password";
        } elseif ($rol === 'ADMIN') {
            echo "login_ok_admin";
        } elseif ($rol === 'TRABAJADOR') {
            echo "login_ok_trabajador";
        } else {
            echo "login_ok_cliente";
        }
        exit;

    } else {
        echo "contraseña_incorrecta";
        exit;
    }

} else {
    echo "usuario_no_encontrado";
    exit;
}

$stmt->close();
$conn->close();