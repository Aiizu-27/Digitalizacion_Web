<?php
<?php
// TUS DATOS NUEVOS
$host = "dailydosedb.cfw8im4q8gip.eu-south-2.rds.amazonaws.com";
$usuario = "admin_DD"; // (O el que hayas puesto)
$contrasena = "271304Lu"; 
$basedatos = "dailydose";

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $basedatos);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Configurar charset para tildes y ñ
$conn->set_charset("utf8");
?>