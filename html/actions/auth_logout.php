<?php
// 1. Reanudamos la sesión actual para saber qué vamos a destruir
session_start();

// 2. Vaciamos todas las variables de sesión ($_SESSION['ROL'], $_SESSION['ID_USUARIO'], etc.)
session_unset();

// 3. Destruimos la sesión en el servidor
session_destroy();

// 4. Redirigimos al usuario a la página principal (index.php)
// Como este archivo está dentro de 'actions', usamos '../' para salir a la raíz
header("Location: ../index.php");
exit();
?>