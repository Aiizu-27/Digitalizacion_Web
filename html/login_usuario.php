//Procesa el login de los usuarios

<?php
session_start();

// Datos de conexión
$host = "localhost";
$usuario = "admin_dd";
$contrasena = "271304Lu";
$basedatos = "dailydose";

$conn = new mysqli($host, $usuario, $contrasena, $basedatos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recoger datos
$correo = $_POST['correo'] ?? '';
$pass = $_POST['contrasena'] ?? '';

// Buscar usuario
$stmt = $conn->prepare("SELECT ID_CLIENTE, NOMBRE, CONTRASENA FROM CLIENTES WHERE CORREO = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    
    // Verificar contraseña
    if (password_verify($pass, $usuario['CONTRASENA'])) {
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