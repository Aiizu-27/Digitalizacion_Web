<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['ROL'])) {
    header("Location: registro.php"); 
    
    exit(); 
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
    <link rel="stylesheet" href="assets/css/promociones.css">

</head>

  <?php include "includes/header.php"; ?>

  <?php include "includes/footer.php"; ?>
</html>