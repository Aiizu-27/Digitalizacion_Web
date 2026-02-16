<?php
session_start(); // 1. Obligatorio iniciar sesión para leer las variables

// 2. Comprobamos si NO hay usuario O si el rol NO es cliente
if (!isset($_SESSION['ID_USUARIO']) || $_SESSION['ROL'] !== 'cliente') {
    
    // 3. REDIRECCIÓN CORRECTA
    // Usamos "../" para salir de la carpeta 'panel' y volver a la raíz 'html'
    // Asumo que tu login está en index.php o en un archivo login.php en la raíz.
    // Cambia 'index.php' por el nombre de tu archivo de login principal.
    header("Location: ../index.php"); 
    exit();
}

// Aquí empieza el HTML de tu dashboard...
?>
<!DOCTYPE html>
<html lang="es">


</html>