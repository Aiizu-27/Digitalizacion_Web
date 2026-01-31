<?php
// actions/auth_login.php
session_start();
require_once "../includes/config.php"; // Ajusta según tu config.php

header('Content-Type: text/plain'); // Solo texto

$correo = trim($_POST['correo'] ?? '');
$pass   = $_POST['contrasena'] ?? '';

if (empty($correo) || empty($pass)) {
    echo "campos_vacios";
    exit;
}

// Buscar usuario
$stmt = $conn->prepare("SELECT ID_USUARIO, NOMBRE, APELLIDOS, CONTRASENA, ROL, CAMBIAR_PASSWORD 
                        FROM USUARIOS 
                        WHERE EMAIL = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    if (password_verify($pass, $usuario['CONTRASENA'])) {

        session_regenerate_id(true);

        $_SESSION['ID_USUARIO']       = $usuario['ID_USUARIO'];
        $_SESSION['NOMBRE']           = $usuario['NOMBRE'];
        $_SESSION['APELLIDOS']        = $usuario['APELLIDOS'];
        $_SESSION['ROL']              = $usuario['ROL'];
        $_SESSION['CAMBIAR_PASSWORD'] = $usuario['CAMBIAR_PASSWORD'];

        $rol = strtoupper($usuario['ROL']);

// Depuración temporal
ob_clean(); // Limpia cualquier salida previa
header('Content-Type: text/plain'); 
echo "DEBUG:\n";
echo "Correo recibido: '" . $correo . "'\n";
echo "Número de filas encontradas: " . $resultado->num_rows . "\n";

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();
    echo "ROL recibido: '" . $usuario['ROL'] . "'\n";
    echo "CONTRASEÑA HASH DB: " . $usuario['CONTRASENA'] . "\n";
} else {
    echo "Usuario no encontrado\n";
}

exit; // Para que solo muestre esto


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

$conn->close();