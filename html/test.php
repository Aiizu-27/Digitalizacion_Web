<?php
// Cambia este nombre por uno que tengas en la BD
$imagen = "cafe-latte.jpg";

// Ruta relativa que usa tu web
$ruta = "assets/img/productos/" . $imagen;

// Ruta absoluta en el sistema (solo para comprobar existencia)
$rutaFisica = __DIR__ . "/" . $ruta;

echo "<h2>Prueba de imágenes</h2>";

echo "<p><strong>Ruta web:</strong> $ruta</p>";
echo "<p><strong>Ruta física:</strong> $rutaFisica</p>";

if (file_exists($rutaFisica)) {
    echo "<p style='color:green;'>✔ El archivo EXISTE</p>";
    echo "<img src='$ruta' style='max-width:200px;border:1px solid #000'>";
} else {
    echo "<p style='color:red;'>✘ El archivo NO existe</p>";
}
