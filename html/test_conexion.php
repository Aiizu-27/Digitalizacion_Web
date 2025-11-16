<?php
// Datos de conexión
$host = "localhost";      // o 127.0.0.1
$usuario = "admin_dd";        // usuario MySQL
$contrasena = "";         // contraseña MySQL
$basedatos = "dailydose"; // nombre exacto de la BD

// Intentar conexión
$conn = mysqli_connect($host, $usuario, $contrasena, $basedatos);

// Verificar conexión
if (!$conn) {
    die("❌ Conexión fallida: " . mysqli_connect_error());
}

echo "✅ Conexión exitosa a la base de datos '$basedatos'";

// Opcional: mostrar la lista de tablas
$result = mysqli_query($conn, "SHOW TABLES");
echo "<br>Tablas en la base de datos:<br>";
while($row = mysqli_fetch_row($result)) {
    echo $row[0] . "<br>";
}

mysqli_close($conn);
?>