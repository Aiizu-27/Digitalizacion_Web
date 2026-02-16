<?php
session_start();
require_once "../includes/config.php";

// --- SEGURIDAD ---
// Verificamos que esté logueado y que su rol sea EXACTAMENTE 'cliente'
if (!isset($_SESSION['ROL']) || $_SESSION['ROL'] !== 'cliente') {
    header("Location: ../index.php");
    exit();
}

// Obtenemos el ID del usuario actual de la sesión
$id_usuario = $_SESSION['ID_USUARIO'];

// --- OBTENER DATOS DEL CLIENTE (Opcional pero recomendado) ---
// Podemos sacar sus datos frescos de la BD por si actualizó algo
$stmt = $conn->prepare("SELECT NOMBRE, APELLIDOS, EMAIL FROM USUARIOS WHERE ID_USUARIO = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$cliente = $resultado->fetch_assoc();
$stmt->close();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Panel - DailyDose</title>
    <link rel="stylesheet" href="../assets/css/panel.css"> 

    <!-- CSS Global -->
    <link rel="stylesheet" href="../assets/css/variables.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- CSS Componentes -->
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/dashboard_cliente.css">

</head>
<body>

<?php include "../includes/header.php"; ?>



<?php include "../includes/footer.php"; ?>

<!-- JS -->
<script src="../assets/js/script.js"></script>

</body>
</html>