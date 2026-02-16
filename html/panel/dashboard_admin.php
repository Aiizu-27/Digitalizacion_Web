<?php
session_start();
require_once "../includes/config.php"; // archivo con conexión a la base de datos

// --- SEGURIDAD Y REDIRECCIÓN ---
// 1. Verificamos si existe la sesión 'ROL' (en mayúsculas, como en tu login)
// 2. Verificamos si el valor es 'admin' (tu login guardaba el rol en minúsculas)
if (!isset($_SESSION['ROL']) || $_SESSION['ROL'] != 'admin') {
    // Si falla, te manda al index (login) fuera de la carpeta panel
    header("Location: ../index.php");
    exit(); // Detiene la ejecución para que nadie vea el panel sin permiso
}

// --- LÓGICA DE ACTUALIZACIÓN ---
// Cambiar rol si se envió el formulario
if (isset($_POST['cambiar_rol'])) {
    $id_usuario = intval($_POST['id_usuario']);
    $nuevo_rol = $_POST['nuevo_rol'];

    // Usamos prepare para seguridad
    $stmt = $conn->prepare("UPDATE USUARIOS SET ROL = ? WHERE ID_USUARIO = ?");
    $stmt->bind_param("si", $nuevo_rol, $id_usuario);
    
    if($stmt->execute()) {
        // Opcional: Mensaje de éxito o recarga limpia para evitar reenvío de formulario
        header("Location: dashboard_admin.php");
        exit();
    }
    $stmt->close();
}

// --- OBTENER DATOS ---
// Obtener todos los usuarios para la tabla
$result = $conn->query("SELECT ID_USUARIO, NOMBRE, APELLIDOS, EMAIL, ROL FROM USUARIOS ORDER BY ID_USUARIO ASC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>
    <style>
        body { font-family: sans-serif; }
        table { border-collapse: collapse; width: 90%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
        form { display: flex; gap: 5px; justify-content: center; }
        button { cursor: pointer; padding: 5px 10px; background: #007bff; color: white; border: none; border-radius: 4px;}
        button:hover { background: #0056b3; }
        select { padding: 5px; }
        .logout-btn { display: block; width: 100px; margin: 20px auto; text-align: center; background: #dc3545; color: white; padding: 10px; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Panel de Administrador</h2>
    <p style="text-align:center;">Bienvenido, <strong><?= htmlspecialchars($_SESSION['NOMBRE'] ?? 'Admin') ?></strong></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Rol Actual</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
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
                            <option value="CLIENTE" <?= strtoupper($user['ROL'])=='CLIENTE'?'selected':'' ?>>CLIENTE</option>
                            <option value="TRABAJADOR" <?= strtoupper($user['ROL'])=='TRABAJADOR'?'selected':'' ?>>TRABAJADOR</option>
                            <option value="ADMIN" <?= strtoupper($user['ROL'])=='ADMIN'?'selected':'' ?>>ADMIN</option>
                        </select>
                        <button type="submit" name="cambiar_rol">Actualizar</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    
    <a href="../actions/auth_logout.php" class="logout-btn">Cerrar Sesión</a>
</body>
</html>