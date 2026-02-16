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

// (Opcional) Aquí podrías hacer otra consulta para obtener sus últimos 3 pedidos
// $pedidos_stmt = $conn->prepare("SELECT * FROM PEDIDOS WHERE ID_USUARIO = ? ORDER BY FECHA DESC LIMIT 3");
// ...
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Panel - DailyDose</title>
    <link rel="stylesheet" href="../assets/css/panel.css"> 
    <style>
        body { font-family: sans-serif; background-color: #f4f7f6; margin: 0; padding: 20px; color: #333; }
        .dashboard-container { max-width: 1000px; margin: 0 auto; }
        .welcome-header { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); margin-bottom: 20px; text-align: center; }
        
        /* Sistema de Tarjetas (Cards) para el menú */
        .cards-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); text-align: center; transition: transform 0.2s; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .card h3 { margin-top: 0; color: #007bff; }
        .card p { color: #666; font-size: 0.9em; }
        .card .btn { display: inline-block; margin-top: 15px; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; }
        .card .btn:hover { background: #0056b3; }
        
        /* Botón de cierre de sesión */
        .logout-container { text-align: center; margin-top: 40px; }
        .logout-btn { background: #dc3545; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
        .logout-btn:hover { background: #c82333; }
    </style>
</head>
<body>

<div class="dashboard-container">
    
    <div class="welcome-header">
        <h2>¡Hola, <?= htmlspecialchars($cliente['NOMBRE']) ?>! 👋</h2>
        <p>Bienvenido a tu panel de cliente de DailyDose. ¿Qué te apetece hacer hoy?</p>
    </div>

    <div class="cards-grid">
        
        <div class="card">
            <h3>🍔 Nuestra Carta</h3>
            <p>Descubre nuestros nuevos platos y bebidas. Haz tu pedido online rápidamente.</p>
            <a href="../carta.php" class="btn">Ver Carta</a>
        </div>

        <div class="card">
            <h3>📦 Mis Pedidos</h3>
            <p>Revisa el estado de tus pedidos actuales y tu historial de compras anteriores.</p>
            <a href="../views/pedidos_vista.php" class="btn">Ver Mis Pedidos</a>
        </div>

        <div class="card">
            <h3>🎁 Promociones</h3>
            <p>Aprovecha los descuentos exclusivos que tenemos preparados para ti.</p>
            <a href="../promociones.php" class="btn">Ver Ofertas</a>
        </div>

        <div class="card">
            <h3>⚙️ Mi Perfil</h3>
            <p>Actualiza tus datos de contacto: <br> <strong><?= htmlspecialchars($cliente['EMAIL']) ?></strong></p>
            <a href="cambiar_contraseña.php" class="btn">Ajustes</a>
        </div>

    </div>

    <div class="logout-container">
        <a href="../actions/auth_logout.php" class="logout-btn">Cerrar Sesión</a>
    </div>

</div>

</body>
</html>