<?php
// ===== CONFIGURACIÓN DE BASE DE DATOS =====
//$host = "localhost";       // Cambia si usas otro host
$host = "dailydosedb.cfw8im4q8gip.eu-south-2.rds.amazonaws.com";
$usuario = "app_user";         // Tu usuario MySQL
$contrasena = "Bvcxz98765";    // Tu contraseña
$basedatos = "dailydose";  // Tu base de datos

// ===== MOSTRAR ERRORES (solo desarrollo) =====
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ===== CONEXIÓN A MYSQL =====
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $usuario, $contrasena, $basedatos);
    $conn->set_charset("utf8"); // Para soportar tildes y ñ
} catch (Exception $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}

// ===== FUNCIÓN OPCIONAL PARA DEBUG =====
// Puedes usar esta función para imprimir errores de consultas fácilmente
function debugQuery($stmt) {
    if ($stmt->errno) {
        echo "Error en consulta: " . $stmt->error;
    }
}

function esCliente($conn, $idUsuario) {
    $stmt = $conn->prepare("SELECT 1 FROM CLIENTES WHERE ID_USUARIO=?");
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    return $stmt->get_result()->num_rows > 0;
}

function esEmpleado($conn, $idUsuario) {
    $stmt = $conn->prepare("SELECT 1 FROM EMPLEADOS WHERE ID_USUARIO=?");
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    return $stmt->get_result()->num_rows > 0;
}
