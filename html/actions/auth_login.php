<?php
// actions/auth_login.php
session_start();
require_once "../includes/config.php";

// 2. Intentamos asignarlo a las variables
$correo = trim($_POST['correo'] ?? '');
$pass   = $_POST['contrasena'] ?? '';




$stmt = $conn->prepare(
    "SELECT ID_USUARIO, NOMBRE, APELLIDOS, CONTRASENA, ROL, CAMBIAR_PASSWORD
     FROM USUARIOS
     WHERE EMAIL = ?"
);
$stmt->bind_param("s", $correo);  //pone el correo introducido en iniciar sesion en el select
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();

    // Verificar contraseña
    if (password_verify($pass, $usuario['CONTRASENA'])) {

        $_SESSION['ID_USUARIO'] = $usuario['ID_USUARIO'];
        $_SESSION['NOMBRE'] = $usuario['NOMBRE'];
        echo "login_ok";
    } else {
        echo "usuario_no_encontrado";
    }
}

$stmt->close();
$conn->close();