<?php
// actions/auth_login.php
session_start();
require_once "../includes/config.php";

// 1. Imprimimos lo que llega realmente del formulario (RAW)
echo "--- PASO 1: Lo que llega del Formulario ---\n";
var_dump($_POST); 

// 2. Intentamos asignarlo a las variables
$correo = trim($_POST['correo'] ?? '');
$pass   = trim($_POST['contrasena'] ?? '');

// 3. Imprimimos cómo han quedado las variables
echo "\n--- PASO 2: Cómo quedan las variables ---\n";
echo "Variable \$correo: "; var_dump($correo);
echo "Variable \$pass:   "; var_dump($pass);

// 4. Hacemos la prueba de la verdad
echo "\n--- PASO 3: ¿Qué dice el IF? ---\n";
if (empty($correo)) {
    echo "EL IF DICE: \$correo está vacío (CULPABLE)\n";
} else {
    echo "EL IF DICE: \$correo tiene datos (INOCENTE)\n";
}

if (empty($pass)) {
    echo "EL IF DICE: \$pass está vacío (CULPABLE)\n";
} else {
    echo "EL IF DICE: \$pass tiene datos (INOCENTE)\n";
}

exit; // Paramos aquí para que leas el informe
// 2. VALIDACIÓN
// Si alguno de los dos está vacío, paramos aquí.
if (empty($correo) || empty($pass)) {
    echo "campos_vacios";
    exit;
}


// 3. LÓGICA DE BASE DE DATOS
$stmt = $conn->prepare(
    "SELECT ID_USUARIO, NOMBRE, APELLIDOS, CONTRASENA, ROL, CAMBIAR_PASSWORD
     FROM USUARIOS
     WHERE EMAIL = ?"
);
$stmt->bind_param("s", $correo);  //pone el correo introducido en iniciar sesion en el select
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    // Verificar contraseña
    if (password_verify($pass, $usuario['CONTRASENA'])) {

        // Seguridad: regenerar ID de sesión para evitar robos
        session_regenerate_id(true);

        $_SESSION['ID_USUARIO']       = $usuario['ID_USUARIO'];
        $_SESSION['NOMBRE']           = $usuario['NOMBRE'];
        $_SESSION['APELLIDOS']        = $usuario['APELLIDOS'];
        $_SESSION['ROL']              = $usuario['ROL'];
        $_SESSION['CAMBIAR_PASSWORD'] = $usuario['CAMBIAR_PASSWORD'];

        // Respuesta final para JS
        if ($usuario['CAMBIAR_PASSWORD']) {
            echo "cambiar_password";
        } else {
            echo "login_ok";
        }
    } else {
        echo "contraseña_incorrecta";
    }
} else {
    echo "usuario_no_encontrado";
}

$stmt->close();
$conn->close();