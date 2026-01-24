<?php
// actions/auth_login.php
session_start();
require_once "../includes/config.php";

$correo = trim($_POST['correo'] ?? '');
$pass = $_POST['contrasena'] ?? '';

// Buscar usuario por correo
$stmt = $conn->prepare("SELECT ID_CLIENTE, NOMBRE, CONTRASENA FROM CLIENTES WHERE CORREO = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();

    // COMPARACIÓN DIRECTA (Texto Plano)
    // Comparamos si lo escrito es idéntico a lo guardado en BD
    if ($pass === $usuario['CONTRASENA']) {
        
        // Login correcto: Guardamos datos en sesión
        $_SESSION['ID_CLIENTE'] = $usuario['ID_CLIENTE'];
        $_SESSION['NOMBRE'] = $usuario['NOMBRE'];
        
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