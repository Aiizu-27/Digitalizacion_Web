<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario - DAILY DOSE</title>
    <link rel="stylesheet" href="../assets/css/variables.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>

    <?php include "includes/header.php"; ?>

    <?php include "../includes/header.php"; ?>
    <div class="panel-usuario">
        <h1>Bienvenido, <?php echo htmlspecialchars($usuario_info['NOMBRE']); ?>!</h1>
        
        <div class="info-usuario">
            <p><strong>Correo:</strong> <?php echo htmlspecialchars($usuario_info['CORREO']); ?></p>
            
            <p><strong>Teléfono:</strong> 
                <?php echo !empty($usuario_info['TELEFONO']) ? htmlspecialchars($usuario_info['TELEFONO']) : 'No registrado'; ?>
            </p>
            
            <p><strong>Puntos:</strong> <?php echo htmlspecialchars($usuario_info['PUNTOS']); ?></p>
        </div>

        <form method="post" action="cerrar_sesion.php">
            <button type="submit">Cerrar sesión</button>
        </form>
    </div>

    <script src="../assets/js/script.js"></script>
</body>
</html>