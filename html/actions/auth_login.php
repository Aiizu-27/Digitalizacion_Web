<?php
// actions/auth_login.php
session_start();
require_once "../includes/config.php";

// 1. Recogida de datos
$correo = trim($_POST['correo'] ?? '');
$pass   = trim($_POST['contrasena'] ?? '');

// 2. Validación básica
if (empty($correo) || empty($pass)) {
    // Si falla, lo mandamos de vuelta al login con un error en la URL
    header("Location: ../index.php?error=campos_vacios");
    exit;
}

// 3. Consulta a la Base de Datos
$stmt = $conn->prepare("SELECT ID_USUARIO, NOMBRE, APELLIDOS, CONTRASENA, ROL, CAMBIAR_PASSWORD FROM USUARIOS WHERE EMAIL = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    // 4. Verificar contraseña
    if (password_verify($pass, $usuario['CONTRASENA'])) {

        // Seguridad de sesión
        session_regenerate_id(true);
        $_SESSION['ID_USUARIO']       = $usuario['ID_USUARIO'];
        $_SESSION['NOMBRE']           = $usuario['NOMBRE'];
        $_SESSION['APELLIDOS']        = $usuario['APELLIDOS'];
        $_SESSION['ROL']              = $usuario['ROL'];
        $_SESSION['CAMBIAR_PASSWORD'] = $usuario['CAMBIAR_PASSWORD'];

        // 5. REDIRECCIÓN DE ÉXITO
        if ($usuario['CAMBIAR_PASSWORD']) {
            // Ajusta esta ruta si tienes una página para cambiar pass
            header("Location: ../cambiar_password.php"); 
        } else {
            // ¡ÉXITO! Vamos al panel
            header("Location: ../panel.php");
        }
        exit;

    } else {
        // Contraseña mal -> Vuelta al login
        header("Location: ../index.php?error=contrasena_incorrecta");
        exit;
    }
} else {
    // Usuario no existe -> Vuelta al login
    header("Location: ../index.php?error=usuario_no_encontrado");
    exit;
}

$stmt->close();
$conn->close();