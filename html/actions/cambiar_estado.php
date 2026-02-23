<?php
session_start();
require_once "../includes/config.php";

if (!isset($_SESSION['ROL'])) {
    die("Acceso denegado.");
}
$rol_usuario = strtoupper(trim($_SESSION['ROL']));
if (!in_array($rol_usuario, ['EMPLEADO', 'TRABAJADOR', 'ADMIN'])) {
    die("Acceso denegado.");
}

// Recogemos los datos (ahora vienen por POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['estado'])) {
    $id_pedido = intval($_POST['id']);
    $nuevo_estado = $_POST['estado'];
    
    // Si viene el ID del empleado (cuando pasa a EN_PREPARACION)
    $id_empleado = !empty($_POST['id_empleado']) ? intval($_POST['id_empleado']) : null;

    $estados_validos = ['PENDIENTE', 'EN_PREPARACION', 'LISTO', 'ENTREGADO', 'CANCELADO'];
    
    if (in_array($nuevo_estado, $estados_validos)) {
        
        if ($nuevo_estado == 'EN_PREPARACION' && $id_empleado) {
            // Actualizamos el estado Y le asignamos el trabajador
            $stmt = $conn->prepare("UPDATE PEDIDOS SET ESTADO = ?, ID_EMPLEADO = ? WHERE ID_PEDIDO = ?");
            $stmt->bind_param("sii", $nuevo_estado, $id_empleado, $id_pedido);
        } else {
            // Solo actualizamos el estado
            $stmt = $conn->prepare("UPDATE PEDIDOS SET ESTADO = ? WHERE ID_PEDIDO = ?");
            $stmt->bind_param("si", $nuevo_estado, $id_pedido);
        }
        
        $stmt->execute();
        $stmt->close();
    }
}

header("Location: ../panel/dashboard_trabajador.php");
exit();
?>