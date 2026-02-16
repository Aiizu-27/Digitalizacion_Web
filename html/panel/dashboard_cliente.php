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

</div> <div style="text-align: center; margin-top: 50px; margin-bottom: 20px;">
        <a href="../actions/auth_logout.php" style="background-color: #dc3545; color: white; padding: 12px 25px; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 1.1em; display: inline-flex; align-items: center; gap: 10px; transition: 0.3s; box-shadow: 0 4px 6px rgba(220, 53, 69, 0.2);" onmouseover="this.style.backgroundColor='#c82333'" onmouseout="this.style.backgroundColor='#dc3545'">
            
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>

            Cerrar Sesión
        </a>
    </div>
</div>

<?php include "../includes/footer.php"; ?>

<!-- JS -->
<script src="../assets/js/script.js"></script>

</body>
</html>