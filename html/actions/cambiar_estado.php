<?php
session_start();
require_once "../includes/config.php";

// Forzamos a que PHP nos muestre cualquier error de la base de datos
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

echo "<h3>Modo Depuración Activado</h3>";

try {
    // 1. Comprobar sesión
    if (!isset($_SESSION['ROL'])) {
        die("Error: No tienes sesión iniciada.");
    }

    // 2. Comprobar que llegan los datos del formulario (POST)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        if (!isset($_POST['id']) || !isset($_POST['estado'])) {
            die("Error: El formulario no está enviando el ID o el Estado.");
        }

        $id_pedido = intval($_POST['id']);
        $nuevo_estado = $_POST['estado'];
        $id_empleado = !empty($_POST['id_empleado']) ? intval($_POST['id_empleado']) : null;

        echo "Datos recibidos correctamente:<br>";
        echo "- ID Pedido: " . $id_pedido . "<br>";
        echo "- Nuevo Estado: " . $nuevo_estado . "<br>";
        echo "- ID Empleado asignado: " . ($id_empleado ? $id_empleado : "Ninguno") . "<br><br>";

        // 3. Ejecutar la consulta
        if ($nuevo_estado == 'EN_PREPARACION' && $id_empleado) {
            echo "Intentando actualizar estado y empleado...<br>";
            $stmt = $conn->prepare("UPDATE PEDIDOS SET ESTADO = ?, ID_EMPLEADO = ? WHERE ID_PEDIDO = ?");
            $stmt->bind_param("sii", $nuevo_estado, $id_empleado, $id_pedido);
        } else {
            echo "Intentando actualizar SOLO el estado...<br>";
            $stmt = $conn->prepare("UPDATE PEDIDOS SET ESTADO = ? WHERE ID_PEDIDO = ?");
            $stmt->bind_param("si", $nuevo_estado, $id_pedido);
        }
        
        $stmt->execute();
        $stmt->close();

        echo "<h3 style='color:green;'>¡Éxito! Base de datos actualizada.</h3>";
        echo "<a href='../panel/dashboard_trabajador.php'>Volver al panel (Haz clic aquí)</a>";

    } else {
        die("Error: No se ha accedido mediante el formulario (POST).");
    }

} catch (Exception $e) {
    // Si la base de datos falla (ej. clave foránea), nos lo dirá aquí en rojo
    echo "<h3 style='color:red;'>Error fatal en la base de datos:</h3>";
    echo $e->getMessage();
}
?>