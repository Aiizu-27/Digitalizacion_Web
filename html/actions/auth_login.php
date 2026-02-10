<?php
session_start();
require_once "../includes/config.php";

// Recoger datos enviados por POST
$correo = $_POST['correo'] ?? '';
$pass   = $_POST['contrasena'] ?? '';

// Preparar y ejecutar consulta
$stmt = $conn->prepare(
    "SELECT ID_USUARIO, NOMBRE, APELLIDOS, EMAIL, CONTRASENA 
     FROM USUARIOS 
     WHERE EMAIL = ?"
);
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();

    // 🔐 Verificar contraseña cifrada
    if (password_verify($pass, $usuario['CONTRASENA'])) {
        $_SESSION['ID_USUARIO'] = $usuario['ID_USUARIO'];
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
?>
