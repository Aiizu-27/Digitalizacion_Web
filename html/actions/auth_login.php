<?php
session_start();
require_once "../includes/config.php";

// Limpiamos cualquier salida previa
ob_clean();
header('Content-Type: application/json');

$correo = $_POST['correo'] ?? '';
$pass   = $_POST['contrasena'] ?? '';
$response = [];

$stmt = $conn->prepare("SELECT ID_USUARIO, NOMBRE, APELLIDOS, EMAIL, CONTRASENA, LOWER(ROL) AS ROL FROM USUARIOS WHERE EMAIL = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($usuario = $resultado->fetch_assoc()) {
    if (password_verify($pass, $usuario['CONTRASENA'])) {
        $_SESSION['ID_USUARIO'] = $usuario['ID_USUARIO'];
        $_SESSION['NOMBRE']     = $usuario['NOMBRE'];
        $_SESSION['ROL']        = $usuario['ROL'];
        
        $response = ["status" => "login_ok", "rol" => $usuario['ROL']];
    } else {
        $response = ["status" => "contraseña_incorrecta"];
    }
} else {
    $response = ["status" => "usuario_no_encontrado"];
}

$stmt->close();
$conn->close();

echo json_encode($response);
exit;