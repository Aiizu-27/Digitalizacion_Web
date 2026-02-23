<?php
session_start();
require_once "../includes/config.php";

// Seguridad: Comprobamos de nuevo el ROL
if (!isset($_SESSION['ROL']) || !in_array(strtolower($_SESSION['ROL']), ['empleado', 'trabajador', 'admin'])) {
    die("Acceso denegado. No tienes permisos para realizar esta acción.");
}

if (isset($_GET['id']) && isset($_GET['estado'])) {
    $id_pedido = intval($_GET['id']);
    $nuevo_estado = $_GET['estado'];

    // Validar que el estado sea uno de los permitidos por tu base de datos
    $estados_validos = ['PENDIENTE', 'EN_PREPARACION', 'LISTO', 'ENTREGADO', 'CANCELADO'];
    
    if (in_array($nuevo_estado, $estados_validos)) {
        $stmt = $conn->prepare("UPDATE PEDIDOS SET ESTADO = ? WHERE ID_PEDIDO = ?");
        $stmt->bind_param("si", $nuevo_estado, $id_pedido);
        $stmt->execute();
        $stmt->close();
    }
}

// Redirigir de vuelta al panel de comandas rapidísimo
header("Location: ../panel/dashboard_trabajador.php");
exit();
?>