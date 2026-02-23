<?php
session_start();
require_once "../includes/config.php";

// 1. SEGURIDAD A PRUEBA DE BOMBAS
if (!isset($_SESSION['ROL'])) {
    header("Location: ../index.php");
    exit();
}

$rol_usuario = strtoupper(trim($_SESSION['ROL']));
if (!in_array($rol_usuario, ['EMPLEADO', 'TRABAJADOR', 'ADMIN'])) {
    header("Location: ../index.php");
    exit();
}

// 2. OBTENER PEDIDOS ACTIVOS (Con el DOBLE JOIN para llegar al nombre del usuario)
$sql_pedidos = "SELECT p.*, u.NOMBRE as CLIENTE_NOMBRE 
                FROM PEDIDOS p 
                LEFT JOIN CLIENTES c ON p.ID_CLIENTE = c.ID_CLIENTE 
                LEFT JOIN USUARIOS u ON c.ID_USUARIO = u.ID_USUARIO
                WHERE p.ESTADO IN ('PENDIENTE', 'EN_PREPARACION', 'LISTO') 
                ORDER BY 
                    FIELD(p.ESTADO, 'LISTO', 'EN_PREPARACION', 'PENDIENTE'), 
                    p.ID_PEDIDO ASC";

$result_pedidos = $conn->query($sql_pedidos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comandas - DAILY DOSE</title>
    <link rel="stylesheet" href="../assets/css/variables.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/dashboard_trabajador.css?v=<?php echo time(); ?>">
</head>
<body>

<?php 
// Definimos BASE_URL para que el menú superior funcione bien desde la subcarpeta
if (!defined('BASE_URL')) define('BASE_URL', '../');
include "../includes/header.php"; 
?>

<main class="worker-container">
    <div class="cabecera-panel">
        <h1>Panel de Comandas</h1>
        <p>Gestión de pedidos en tiempo real.</p>
    </div>

    <div class="grid-comandas">
        <?php if ($result_pedidos && $result_pedidos->num_rows > 0): ?>
            <?php while ($pedido = $result_pedidos->fetch_assoc()): ?>
                
                <div class="ticket-pedido estado-<?php echo strtolower($pedido['ESTADO']); ?>">
                    
                    <div class="ticket-header">
                        <span class="id-pedido">#<?php echo $pedido['ID_PEDIDO']; ?></span>
                        <span class="mesa-badge">
                            <?php echo $pedido['NUMERO_MESA'] ? 'Mesa ' . $pedido['NUMERO_MESA'] : 'Para Llevar'; ?>
                        </span>
                    </div>

                    <div class="ticket-info">
                        <p><strong>Cliente:</strong> <?php echo htmlspecialchars($pedido['CLIENTE_NOMBRE'] ?? 'Desconocido'); ?></p>
                        <p><strong>Total:</strong> <?php echo number_format($pedido['TOTAL'], 2); ?> €</p>
                    </div>

                    <div class="ticket-productos">
                        <ul>
                            <?php
                            $id_ped = $pedido['ID_PEDIDO'];
                            $sql_detalles = "SELECT dp.CANTIDAD, pr.NOMBRE 
                                             FROM DETALLE_PEDIDO dp 
                                             JOIN PRODUCTOS pr ON dp.ID_PRODUCTO = pr.ID_PRODUCTO 
                                             WHERE dp.ID_PEDIDO = ?";
                            $stmt_det = $conn->prepare($sql_detalles);
                            $stmt_det->bind_param("i", $id_ped);
                            $stmt_det->execute();
                            $detalles = $stmt_det->get_result();
                            
                            while ($item = $detalles->fetch_assoc()) {
                                echo "<li><strong>" . $item['CANTIDAD'] . "x</strong> " . htmlspecialchars($item['NOMBRE']) . "</li>";
                            }
                            $stmt_det->close();
                            ?>
                        </ul>
                    </div>

                    <div class="ticket-acciones">
                        <?php if ($pedido['ESTADO'] == 'PENDIENTE'): ?>
                            <a href="../actions/cambiar_estado.php?id=<?php echo $pedido['ID_PEDIDO']; ?>&estado=EN_PREPARACION" class="btn-accion btn-preparar">Empezar a Preparar</a>
                            <a href="../actions/cambiar_estado.php?id=<?php echo $pedido['ID_PEDIDO']; ?>&estado=CANCELADO" class="btn-accion btn-cancelar" onclick="return confirm('¿Seguro que quieres cancelar este pedido?');">Cancelar Pedido</a>
                        
                        <?php elseif ($pedido['ESTADO'] == 'EN_PREPARACION'): ?>
                            <a href="../actions/cambiar_estado.php?id=<?php echo $pedido['ID_PEDIDO']; ?>&estado=LISTO" class="btn-accion btn-listo">¡Marcar como Listo!</a>
                        
                        <?php elseif ($pedido['ESTADO'] == 'LISTO'): ?>
                            <a href="../actions/cambiar_estado.php?id=<?php echo $pedido['ID_PEDIDO']; ?>&estado=ENTREGADO" class="btn-accion btn-entregar">Entregar al Cliente</a>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="tarjeta-cristal" style="grid-column: 1 / -1; text-align: center; padding: 50px;">
                <h2>No hay pedidos activos</h2>
                <p>Buen trabajo. La barra está limpia y todos los cafés servidos. ☕</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<script src="../assets/js/script.js"></script>
</body>
</html>