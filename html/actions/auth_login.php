<?php
session_start();
require_once "../includes/config.php";

// Evitar cualquier salida accidental
ob_start(); 

$correo = $_POST['correo'] ?? '';
$pass   = $_POST['contrasena'] ?? '';

$stmt = $conn->prepare(
    "SELECT ID_USUARIO, NOMBRE, APELLIDOS, EMAIL, CONTRASENA, LOWER(ROL) AS ROL 
     FROM USUARIOS 
     WHERE EMAIL = ?"
);
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    if (password_verify($pass, $usuario['CONTRASENA'])) {
        $_SESSION['ID_USUARIO'] = $usuario['ID_USUARIO'];
        $_SESSION['NOMBRE']     = $usuario['NOMBRE'];
        $_SESSION['ROL']        = $usuario['ROL'];
        echo json_encode([
            "status" => "login_ok",
            "role"   => $usuario['ROL']
        ]);
        exit;
    } else {
        echo json_encode(["status" => "contraseña_incorrecta"]);
        exit;
    }
} else {
    echo json_encode(["status" => "usuario_no_encontrado"]);
    exit;
}

$stmt->close();
$conn->close();
ob_end_flush();
?>