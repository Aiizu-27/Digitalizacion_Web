<?php
session_start();
require_once "../includes/config.php";

// --- SEGURIDAD ---
if (!isset($_SESSION['ROL']) || $_SESSION['ROL'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

// --- 1. LÓGICA: CAMBIAR ROL ---
if (isset($_POST['cambiar_rol'])) {
    $id_usuario = intval($_POST['id_usuario']);
    $nuevo_rol = $_POST['nuevo_rol'];
    $stmt = $conn->prepare("UPDATE USUARIOS SET ROL = ? WHERE ID_USUARIO = ?");
    $stmt->bind_param("si", $nuevo_rol, $id_usuario);
    $stmt->execute();
    $stmt->close();
    header("Location: dashboard_admin.php"); // Recargar para ver cambios
    exit();
}

// --- 2. LÓGICA: AÑADIR TRABAJADOR ---
if (isset($_POST['add_trabajador'])) {
    // Aquí recibes los datos del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // ¡Siempre encriptada!
    $rol = 'TRABAJADOR';

    // Si mencionabas "pl" refiriéndote a un Procedimiento Almacenado, cambiarías el INSERT por "CALL tu_procedimiento(?, ?, ?, ?, ?)"
    $stmt = $conn->prepare("INSERT INTO USUARIOS (NOMBRE, APELLIDOS, EMAIL, CONTRASENA, ROL) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre, $apellidos, $email, $pass, $rol);
    $stmt->execute();
    $stmt->close();
    header("Location: dashboard_admin.php");
    exit();
}

// --- 3. LÓGICA: DAR DE BAJA ---
if (isset($_POST['baja_usuario'])) {
    $id_baja = intval($_POST['id_baja']);
    // Ojo: Esto borra al usuario físicamente. A veces es mejor hacer un UPDATE ESTADO = 'inactivo'.
    $stmt = $conn->prepare("DELETE FROM USUARIOS WHERE ID_USUARIO = ?");
    $stmt->bind_param("i", $id_baja);
    $stmt->execute();
    $stmt->close();
    header("Location: dashboard_admin.php");
    exit();
}

// Obtener todos los usuarios para los desplegables
$result = $conn->query("SELECT ID_USUARIO, NOMBRE, APELLIDOS, EMAIL, ROL FROM USUARIOS ORDER BY ID_USUARIO ASC");
// Guardamos los usuarios en un array para poder usarlos en varios desplegables sin tener que hacer la consulta SQL de nuevo
$usuarios = [];
while($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAILY DOSE - Tu dosis diaria de café</title>

    <!-- CSS Global -->
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- CSS Componentes -->
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/dashboard_admin.css">
</head>
<body>

<div class="container">
    <h2 style="text-align:center;">Panel de Control Administrativo</h2>
    <p style="text-align:center;">Bienvenido, <strong><?= htmlspecialchars($_SESSION['NOMBRE'] ?? 'Admin') ?></strong></p>

    <details open> <summary>Gestión de Roles de Usuarios</summary>
        <div class="details-content">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol Actual</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($usuarios as $user): ?>
                    <tr>
                        <td><?= $user['ID_USUARIO'] ?></td>
                        <td><?= htmlspecialchars($user['NOMBRE'] . ' ' . $user['APELLIDOS']) ?></td>
                        <td><?= htmlspecialchars($user['EMAIL']) ?></td>
                        <td><?= $user['ROL'] ?></td>
                        <td>
                            <form method="post" class="inline-form">
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
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </details>

    <details>
        <summary>Alta de Nuevo Trabajador</summary>
        <div class="details-content">
            <form method="post" class="form-grid">
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="text" name="apellidos" placeholder="Apellidos" required>
                <input type="email" name="email" placeholder="Correo Electrónico" required>
                <input type="password" name="contrasena" placeholder="Contraseña temporal" required>
                <button type="submit" name="add_trabajador">Registrar Trabajador</button>
            </form>
        </div>
    </details>

    <details>
        <summary>Dar de Baja a un Usuario</summary>
        <div class="details-content">
            <form method="post" style="text-align: center;">
                <p>Selecciona el usuario que deseas eliminar del sistema:</p>
                <select name="id_baja" required style="width: 60%; margin-bottom: 15px;">
                    <option value="">-- Seleccionar Usuario --</option>
                    <?php foreach($usuarios as $user): ?>
                        <option value="<?= $user['ID_USUARIO'] ?>">
                            ID: <?= $user['ID_USUARIO'] ?> - <?= htmlspecialchars($user['NOMBRE'] . ' ' . $user['APELLIDOS']) ?> (<?= $user['ROL'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
                <br>
                <button type="submit" name="baja_usuario" class="btn-danger" onclick="return confirm('¿Estás SEGURO de que quieres eliminar a este usuario? Esta acción no se puede deshacer.');">
                    Eliminar Usuario Definitivamente
                </button>
            </form>
        </div>
    </details>

    <a href="../actions/auth_logout.php" class="logout-btn">Cerrar Sesión</a>
</div>

</body>
</html>