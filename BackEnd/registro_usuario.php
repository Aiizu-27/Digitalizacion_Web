//Procesa el registro de los usuarios

<?php
include('config.php'); // conexión a MySQL

header('Content-Type: application/json'); // devolver JSON

$input = json_decode(file_get_contents('php://input'), true);
$nombre = $conn->real_escape_string($input['nombre']);
$correo = $conn->real_escape_string($input['correo']);
$contrasena = password_hash($input['contrasena'], PASSWORD_DEFAULT);

// Comprobar si correo ya existe
$sql = "SELECT * FROM CLIENTES WHERE CORREO = '$correo'";
$result = $conn->query($sql);

if($result->num_rows > 0){
    echo json_encode(['success' => false, 'message' => 'El correo ya está registrado']);
} else {
    $sqlInsert = "INSERT INTO CLIENTES (NOMBRE, CORREO, CONTRASENA, PUNTOS) VALUES ('$nombre', '$correo', '$contrasena', 0)";
    if($conn->query($sqlInsert)){
        echo json_encode(['success' => true, 'message' => 'Registro exitoso']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar']);
    }
}

$conn->close();
