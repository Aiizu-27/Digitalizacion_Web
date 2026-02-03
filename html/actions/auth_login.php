<?php
// actions/auth_login.php
session_start();
require_once "../includes/config.php";

// 1. RECOGIDA DE DATOS
$correo = trim($_POST['correo'] ?? '');
$pass   = trim($_POST['contrasena'] ?? '');

var_dump("Correo: ", $correo, "Contraseña: ", $pass);

// 2. VALIDACIÓN
if (empty($correo) || empty($pass)) {
    header("Location: ../index.php?error=campos_vacios");
    exit;
}

// 3. CONSULTA SEGURA
$stmt = $conn->prepare("SELECT ID_USUARIO, NOMBRE, APELLIDOS, CONTRASENA, ROL, CAMBIAR_PASSWORD FROM USUARIOS WHERE EMAIL = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    // 4. VERIFICAR CONTRASEÑA
    if (password_verify($pass, $usuario['CONTRASENA'])) {

        // Regenerar sesión (seguridad)
        session_regenerate_id(true);
        $_SESSION['ID_USUARIO']       = $usuario['ID_USUARIO'];
        $_SESSION['NOMBRE']           = $usuario['NOMBRE'];
        $_SESSION['APELLIDOS']        = $usuario['APELLIDOS'];
        $_SESSION['ROL']              = $usuario['ROL'];
        $_SESSION['CAMBIAR_PASSWORD'] = $usuario['CAMBIAR_PASSWORD'];

        // 5. REDIRECCIÓN (Login exitoso)
        if ($usuario['CAMBIAR_PASSWORD']) {
            header("Location: ../cambiar_password.php"); 
        } else {
            header("Location: ../panel.php");
        }
        exit;

    } else {
        // Contraseña incorrecta
        header("Location: ../index.php?error=contrasena_incorrecta");
        exit;
    }
} else {
    // Usuario no encontrado
    header("Location: ../index.php?error=usuario_no_encontrado");
    exit;
}

$stmt->close();
$conn->close();