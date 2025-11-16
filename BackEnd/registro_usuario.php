//Procesa el registro de los usuarios

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

// Insertar usuario (contraseña plana)
$stmt = $conn->prepare("INSERT INTO CLIENTES (NOMBRE, CORREO, CONTRASENA) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombre, $correo, $pass);

if($stmt->execute()){
    echo "registro_ok";
} else {
    echo "error_insert";
}

// Cerrar conexiones
$stmt->close();
$conn->close();
?>