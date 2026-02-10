<?php
// panel.php -> ESTE ES EL ARCHIVO QUE ABRES EN EL NAVEGADOR

session_start();

// 1. Verificar seguridad
if(!isset($_SESSION['ID_CLIENTE'])){
    header("Location: actions/auth_login.php");
    exit;
}

// 2. Conexión centralizada
require_once "includes/config.php"; 

// 3. Obtener datos del usuario
$id_cliente = $_SESSION['ID_CLIENTE'];
$stmt = $conn->prepare("SELECT NOMBRE, CORREO, TELEFONO, PUNTOS FROM CLIENTES WHERE ID_CLIENTE = ?");
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$result = $stmt->get_result();
$usuario_info = $result->fetch_assoc();

// 4. Cerrar recursos
$stmt->close();
$conn->close();

// 5. CARGAR LA VISTA (El HTML)
// Las variables creadas arriba ($usuario_info) estarán disponibles en este archivo
include "../views/panel_vista.php";
?>