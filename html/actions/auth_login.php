<?php
session_start();
require_once "../includes/config.php";

// Recoger datos enviados por POST
$correo = $_POST['correo'] ?? '';
$pass   = $_POST['contrasena'] ?? '';

// Preparar y ejecutar consulta
$stmt = $conn->prepare(
    "SELECT ID_USUARIO, NOMBRE, APELLIDOS, EMAIL, CONTRASENA, ROL 
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
        // Guardar datos en sesión
        $_SESSION['ID_USUARIO'] = $usuario['ID_USUARIO'];
        $_SESSION['NOMBRE']     = $usuario['NOMBRE'];
        $_SESSION['ROL']        = $usuario['ROL']; // Ahora sí existe
        // Devolver JSON con rol para JS
        echo json_encode([
            "status" => "login_ok",
            "role"   => $usuario['ROL']
        ]);
    } else {
        echo json_encode(["status" => "contraseña_incorrecta"]);
    }
} else {
    echo json_encode(["status" => "usuario_no_encontrado"]);
}

$stmt->close();
$conn->close();
?>
