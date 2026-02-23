<?php
session_start();
require_once "../includes/config.php";

// --- SEGURIDAD ---
if (!isset($_SESSION['ROL']) || $_SESSION['ROL'] != 'trabajador') {
    header("Location: ../index.php");
    exit();
}

// 1. OBTENER LA LISTA DE EMPLEADOS (Para el desplegable)
$sql_empleados = "SELECT e.ID_EMPLEADO, u.NOMBRE 
                  FROM EMPLEADOS e 
                  JOIN USUARIOS u ON e.ID_USUARIO = u.ID_USUARIO";
$res_empleados = $conn->query($sql_empleados);
$empleados = [];
while ($emp = $res_empleados->fetch_assoc()) {
    $empleados[] = $emp;
}

// 2. OBTENER PEDIDOS Y ORGANIZARLOS POR ESTADO
$sql_pedidos = "SELECT p.*, u.NOMBRE as CLIENTE_NOMBRE, emp_u.NOMBRE as BARISTA
                FROM PEDIDOS p 
                LEFT JOIN CLIENTES c ON p.ID_CLIENTE = c.ID_CLIENTE 
                LEFT JOIN USUARIOS u ON c.ID_USUARIO = u.ID_USUARIO
                LEFT JOIN EMPLEADOS e ON p.ID_EMPLEADO = e.ID_EMPLEADO
                LEFT JOIN USUARIOS emp_u ON e.ID_USUARIO = emp_u.ID_USUARIO
                WHERE p.ESTADO IN ('PENDIENTE', 'EN_PREPARACION', 'LISTO') 
                ORDER BY p.ID_PEDIDO ASC";
$result_pedidos = $conn->query($sql_pedidos);

// Preparamos las 3 columnas vacías
$columnas = [
    'PENDIENTE' => [],
    'EN_PREPARACION' => [],
    'LISTO' => []
];

// Metemos cada pedido en su columna correspondiente
while ($pedido = $result_pedidos->fetch_assoc()) {
    $columnas[$pedido['ESTADO']][] = $pedido;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comandas - DAILY DOSE</title>
    <link rel="stylesheet" href="../assets/css/variables.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/worker_panel.css?v=<?php echo time(); ?>">
</head>
<body>

<?php 
if (!defined('BASE_URL')) define('BASE_URL', '../');
include "../includes/header.php"; 
?>

<main class="worker-container">
    <div class="cabecera-panel">
        <h1>Tablero de Comandas</h1>
        <p>Arrastra visualmente los pedidos por las fases.</p>
    </div>

    <div class="kanban-board">
        
        <?php foreach (['PENDIENTE', 'EN_PREPARACION', 'LISTO'] as $fase): ?>
            <div class="kanban-columna fase-<?= strtolower($fase) ?>">
                <h2><?= str_replace('_', ' ', $fase) ?> <span class="contador"><?= count($columnas[$fase]) ?></span></h2>
                
                <div class="kanban-tickets">
                    <?php foreach ($columnas[$fase] as $pedido): ?>
                        <div class="ticket-pedido">
                            
                            <div class="ticket-header">
                                <span class="id-pedido">#<?= $pedido['ID_PEDIDO'] ?></span>
                                <span class="mesa-badge"><?= $pedido['NUMERO_MESA'] ? 'Mesa '.$pedido['NUMERO_MESA'] : 'Llevar' ?></span>
                            </div>

                            <div class="ticket-info">
                                <p><strong>👤 Cliente:</strong> <?= htmlspecialchars($pedido['CLIENTE_NOMBRE'] ?? 'Desconocido') ?></p>
                                <?php if ($pedido['BARISTA']): ?>
                                    <p><strong>☕ Barista:</strong> <?= htmlspecialchars($pedido['BARISTA']) ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="ticket-acciones">
                                <?php if ($fase == 'PENDIENTE'): ?>
                                    <form action="../actions/cambiar_estado.php" method="POST" class="form-asignar">
                                        <input type="hidden" name="id" value="<?= $pedido['ID_PEDIDO'] ?>">
                                        <input type="hidden" name="estado" value="EN_PREPARACION">
                                        <select name="id_empleado" required class="select-empleado">
                                            <option value="" disabled selected>¿Quién lo prepara?</option>
                                            <?php foreach ($empleados as $emp): ?>
                                                <option value="<?= $emp['ID_EMPLEADO'] ?>"><?= htmlspecialchars($emp['NOMBRE']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="submit" class="btn-accion btn-preparar">Empezar</button>
                                    </form>
                                    
                                <?php elseif ($fase == 'EN_PREPARACION'): ?>
                                    <form action="../actions/cambiar_estado.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $pedido['ID_PEDIDO'] ?>">
                                        <input type="hidden" name="estado" value="LISTO">
                                        <button type="submit" class="btn-accion btn-listo w-100">¡Marcar Listo!</button>
                                    </form>
                                    
                                <?php elseif ($fase == 'LISTO'): ?>
                                    <form action="../actions/cambiar_estado.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $pedido['ID_PEDIDO'] ?>">
                                        <input type="hidden" name="estado" value="ENTREGADO">
                                        <button type="submit" class="btn-accion btn-entregar w-100">Entregar</button>
                                    </form>
                                <?php endif; ?>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</main>

<script src="../assets/js/script.js"></script>
</body>
</html>