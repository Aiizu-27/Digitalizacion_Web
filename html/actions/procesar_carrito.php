<?php
session_start();
require_once "../includes/config.php";

// 1. SEGURIDAD: Si no hay sesión o el carrito está vacío, fuera.
if (!isset($_SESSION['ROL']) || empty($_SESSION['carrito'])) {
    header("Location: ../index.php");
    exit();
}

$id_usuario = $_SESSION['ID_USUARIO'];
$numero_mesa = !empty($_POST['numero_mesa']) ? intval($_POST['numero_mesa']) : null;
$total_pedido = 0;

// Calculamos el total primero
foreach ($_SESSION['carrito'] as $item) {
    $total_pedido += ($item['precio'] * $item['cantidad']);
}

// 2. REGLA DE PUNTOS: Por cada 1€ ganado, damos 1 punto (puedes ajustarlo)
// Ejemplo: 15.50€ = 15 puntos
$puntos_ganados = floor($total_pedido); 

// Iniciamos una transacción para que si algo falla, no se guarde nada a medias
$conn->begin_transaction();

try {
    // A. Insertar el Pedido (incluyendo la mesa)
    $stmt = $conn->prepare("INSERT INTO PEDIDOS (ID_USUARIO, TOTAL, ESTADO, NUMERO_MESA) VALUES (?, ?, 'PENDIENTE', ?)");
    $stmt->bind_param("idi", $id_usuario, $total_pedido, $numero_mesa);
    $stmt->execute();
    $id_pedido = $conn->insert_id; // Obtenemos el ID del pedido recién creado

    // B. Insertar los detalles del pedido y restar Stock
    $stmt_detalle = $conn->prepare("INSERT INTO DETALLE_PEDIDOS (ID_PEDIDO, ID_PRODUCTO, CANTIDAD, PRECIO_UNITARIO) VALUES (?, ?, ?, ?)");
    $stmt_stock = $conn->prepare("UPDATE PRODUCTOS SET STOCK = STOCK - ? WHERE ID_PRODUCTO = ?");

    foreach ($_SESSION['carrito'] as $id_prod => $item) {
        // Guardar detalle
        $stmt_detalle->bind_param("iiid", $id_pedido, $id_prod, $item['cantidad'], $item['precio']);
        $stmt_detalle->execute();

        // Restar Stock
        $stmt_stock->bind_param("ii", $item['cantidad'], $id_prod);
        $stmt_stock->execute();
    }

    // C. ACTUALIZAR PUNTOS DEL CLIENTE
    $stmt_puntos = $conn->prepare("UPDATE CLIENTES SET PUNTOS = PUNTOS + ? WHERE ID_USUARIO = ?");
    $stmt_puntos->bind_param("ii", $puntos_ganados, $id_usuario);
    $stmt_puntos->execute();

    // Si todo ha ido bien, confirmamos los cambios en la DB
    $conn->commit();

    // Limpiamos el carrito
    unset($_SESSION['carrito']);

    // Redirigimos a una página de éxito (puedes crear pedido_exito.php)
    header("Location: ../index.php?pedido=ok&puntos=" . $puntos_ganados);
    exit();

} catch (Exception $e) {
    // Si algo falla (ej: error de conexión), deshacemos todo
    $conn->rollback();
    echo "Error al procesar el pedido: " . $e->getMessage();
}