<?php
session_start();
require_once "../includes/config.php"; // archivo con conexión a la base de datos

// Verificar si el usuario es admin
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Cambiar rol si se envió un formulario
if (isset($_POST['cambiar_rol'])) {
    $id_usuario = intval($_POST['id_usuario']);
    $nuevo_rol = $_POST['nuevo_rol'];

    $stmt = $conn->prepare("UPDATE USUARIOS SET ROL = ? WHERE ID_USUARIO = ?");
    $stmt->bind_param("si", $nuevo_rol, $id_usuario);
    $stmt->execute();
    $stmt->close();
}

// Obtener todos los usuarios
$result = $conn->query("SELECT ID_USUARIO, NOMBRE, APELLIDOS, EMAIL, ROL FROM USUARIOS ORDER BY ID_USUARIO ASC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background-color: #eee; }
        form { display: inline; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Panel de Administrador</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acción</th>
        </tr>
        <?php while($user = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $user['ID_USUARIO'] ?></td>
            <td><?= htmlspecialchars($user['NOMBRE']) ?></td>
            <td><?= htmlspecialchars($user['APELLIDOS']) ?></td>
            <td><?= htmlspecialchars($user['EMAIL']) ?></td>
            <td><?= $user['ROL'] ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="id_usuario" value="<?= $user['ID_USUARIO'] ?>">
                    <select name="nuevo_rol">
                        <option value="CLIENTE" <?= $user['ROL']=='CLIENTE'?'selected':'' ?>>CLIENTE</option>
                        <option value="TRABAJADOR" <?= $user['ROL']=='TRABAJADOR'?'selected':'' ?>>TRABAJADOR</option>
                        <option value="ADMIN" <?= $user['ROL']=='ADMIN'?'selected':'' ?>>ADMIN</option>
                    </select>
                    <button type="submit" name="cambiar_rol">Actualizar</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
