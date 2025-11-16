<?php
session_start();

// Verificar si el usuario está logueado
if(!isset($_SESSION['ID_CLIENTE'])){
    header("Location: login.php"); // Redirige al login si no hay sesión
    exit;
}

// Datos de conexión
$host = "localhost";
$usuario = "admin_dd";
$contrasena = "271304Lu"; // Tu contraseña MySQL
$basedatos = "dailydose";

// Conexión a MySQL
$conn = new mysqli($host, $usuario, $contrasena, $basedatos);
if ($conn->connect_error) {
    die("Error_conexion:" . $conn->connect_error);
}

// Obtener información del usuario desde la base de datos
$id_cliente = $_SESSION['ID_CLIENTE'];
$stmt = $conn->prepare("SELECT NOMBRE, CORREO, TELEFONO, PUNTOS FROM CLIENTES WHERE ID_CLIENTE = ?");
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$result = $stmt->get_result();
$usuario_info = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panel de Usuario - DAILY DOSE</title>
<link rel="stylesheet" href="css/variables.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/footer.css">
</head>
<body>

<?php include "header.php"; ?>

<div class="panel-usuario">
    <h1>Bienvenido, <?php echo htmlspecialchars($usuario_info['NOMBRE']); ?>!</h1>
    <div class="info-usuario">
        <p><strong>Correo:</strong> <?php echo htmlspecialchars($usuario_info['CORREO']); ?></p>
        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($usuario_info['TELEFONO']); ?></p>
        <p><strong>Puntos:</strong> <?php echo htmlspecialchars($usuario_info['PUNTOS']); ?></p>
    </div>
    <form method="post" action="cerrar_sesion.php">
        <button type="submit">Cerrar sesión</button>
    </form>
</div>

<!-- Enlace al JS externo -->
<script src="js/script.js"></script>

</body>
</html>
