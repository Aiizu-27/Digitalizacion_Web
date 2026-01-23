<?php
session_start();

// Datos de conexión
$host = "localhost";
$usuario = "admin_dd";
$contrasena = "271304Lu"; // Tu contraseña de MySQL
$basedatos = "dailydose";
$db_host = "prueba.ckn6a668aan5.us-east-1.rds.amazonaws.com"
$db_port = "3306"

// Conexión a MySQL
$conn = new mysqli($host, $usuario, $contrasena, $basedatos);

if ($conn->connect_error) {
    die("Error_conexion:" . $conn->connect_error);
}

// Recoger datos enviados por POST
$correo = $_POST['correo'] ?? '';
$pass = $_POST['contrasena'] ?? '';

// Preparar y ejecutar consulta
$stmt = $conn->prepare("SELECT ID_CLIENTE, NOMBRE, CONTRASENA FROM CLIENTES WHERE CORREO = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();

    // Verificación de contraseña (texto plano por ahora)
    if ($pass === $usuario['CONTRASENA']) {
        $_SESSION['ID_CLIENTE'] = $usuario['ID_CLIENTE'];
        $_SESSION['NOMBRE'] = $usuario['NOMBRE'];
        echo "login_ok";
    } else {
        echo "contraseña_incorrecta";
    }
} else {
    echo "usuario_no_encontrado";
}

// Cerrar conexiones
$stmt->close();
$conn->close();
?>