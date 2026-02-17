<?php
session_start();
require_once "../includes/config.php";

if (!isset($_SESSION['ROL']) || $_SESSION['ROL'] !== 'cliente') {
    header("Location: ../index.php");
    exit();
}

$id_usuario = $_SESSION['ID_USUARIO'];

// 1. DATOS DEL CLIENTE (Y sacamos también su ID_CLIENTE para buscar sus pedidos)
$stmt = $conn->prepare("
    SELECT u.NOMBRE, u.APELLIDOS, u.EMAIL, c.ID_CLIENTE, c.TELEFONO, c.PUNTOS 
    FROM USUARIOS u
    LEFT JOIN CLIENTES c ON u.ID_USUARIO = c.ID_USUARIO
    WHERE u.ID_USUARIO = ?
");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$cliente = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Guardamos el ID_CLIENTE en una variable (si no existe, le ponemos 0 por seguridad)
$id_cliente_actual = $cliente['ID_CLIENTE'] ?? 0;

// 2. ÚLTIMOS 5 PEDIDOS DEL CLIENTE (Adaptado a tu tabla PEDIDOS)
$stmt_pedidos = $conn->prepare("
    SELECT ID_PEDIDO, FECHA, TOTAL 
    FROM PEDIDOS 
    WHERE ID_CLIENTE = ? 
    ORDER BY FECHA DESC 
    LIMIT 5
");
$stmt_pedidos->bind_param("i", $id_cliente_actual);
$stmt_pedidos->execute();
$ultimos_pedidos = $stmt_pedidos->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt_pedidos->close();

// 3. TUS FAVORITOS (Basado en la cantidad total comprada en DETALLE_PEDIDO)
$stmt_favs = $conn->prepare("
    SELECT pr.NOMBRE, SUM(dp.CANTIDAD) as VECES_PEDIDO 
    FROM DETALLE_PEDIDO dp
    JOIN PEDIDOS p ON dp.ID_PEDIDO = p.ID_PEDIDO
    JOIN PRODUCTOS pr ON dp.ID_PRODUCTO = pr.ID_PRODUCTO
    WHERE p.ID_CLIENTE = ?
    GROUP BY dp.ID_PRODUCTO, pr.NOMBRE
    ORDER BY VECES_PEDIDO DESC
    LIMIT 3
");
$stmt_favs->bind_param("i", $id_cliente_actual);
$stmt_favs->execute();
$favoritos = $stmt_favs->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt_favs->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Panel - DailyDose</title>

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

<main class="dashboard-container">
    
    <div class="welcome-header">
        <h2>¡Hola, <?= htmlspecialchars($cliente['NOMBRE'] ?? 'Cliente') ?>!</h2>
        <p>Bienvenido a tu panel de DailyDose. Aquí tienes el control de tu cuenta.</p>
    </div>

    <div class="perfil-seccion">
        
        <div class="datos-personales">
            <h3>Mis Datos</h3>
            <p><strong>Nombre:</strong> <?= htmlspecialchars(($cliente['NOMBRE'] ?? '') . ' ' . ($cliente['APELLIDOS'] ?? '')) ?></p>
            <p><strong>Correo:</strong> <?= htmlspecialchars($cliente['EMAIL'] ?? '') ?></p>
            <p><strong>Teléfono:</strong> <?= htmlspecialchars($cliente['TELEFONO'] ?? 'No especificado') ?></p>
        </div>

        <div class="puntos-card">
            <p class="titulo-puntos">Daily Points</p>
            <div class="cantidad-puntos">
                <?= htmlspecialchars($cliente['PUNTOS'] ?? '0') ?>
            </div>
            <p class="desc-puntos">¡Canjéalos por recompensas!</p>
        </div>

    </div>

    <div class="logout-container">
        <a href="../actions/auth_logout.php" class="btn-logout">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            Cerrar Sesión
        </a>
    </div>

</main> <?php include "../includes/footer.php"; ?>

<script src="../assets/js/script.js"></script>

</body>
</html>