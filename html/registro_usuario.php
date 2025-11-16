<?php
session_start();

// Datos de conexión
$host = "localhost";
$usuario = "admin_dd";
$contrasena = "271304Lu"; // Tu contraseña MySQL
$basedatos = "dailydose";

// Conexión
$conn = new mysqli($host, $usuario, $contrasena, $basedatos);

if ($conn->connect_error) {
    die("Error_conexion:" . $conn->connect_error);
}

// Recoger datos
$nombre = $_POST['nombre'] ?? '';
$correo = $_POST['correo'] ?? '';
$pass = $_POST['contrasena'] ?? '';
$telefono = $_POST['telefono'] ?? ''; // Nuevo campo teléfono

// Verificar si correo ya existe
$stmt = $conn->prepare("SELECT ID_CLIENTE FROM CLIENTES WHERE CORREO = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if($resultado->num_rows > 0){
    echo "correo_existente";
    $stmt->close();
    $conn->close();
    exit;
}

// Insertar usuario (contraseña plana por ahora)
$stmt = $conn->prepare("INSERT INTO CLIENTES (NOMBRE, CORREO, CONTRASENA, TELEFONO) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre, $correo, $pass, $telefono);

if($stmt->execute()){
    echo "registro_ok";
} else {
    echo "error_insert: " . $stmt->error; // Para debug
}

// Cerrar conexiones
$stmt->close();
$conn->close();
?>