<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DAILY DOSE - Tu dosis diaria de café</title>
<!-- Enlace al CSS externo -->
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- Header / Cabecera de la página -->
<?php include "includes/header.php"; ?>

  <!-- Contenedor de pantalla inicial -->
  <div class="contenedor-fijo">
    <!-- Video de fondo -->
    <video class="video-fondo" autoplay muted loop>
      <source src="Imagenes/VideoInicio.mp4" type="video/mp4">
    </video>

    <!-- Contenido encima del video -->
    <div class="contenido-sobre-video">
    </div>
  </div>

  <!-- Contenido principal que aparecerá al hacer scroll -->
  <div class="contenido-principal">
    <div class="fila1">
      <div class="div1">

      </div>
      <div class="div2">
        <H1>Descarga la app</H1>
        <br>
        <p>Ve a la tienda y descarga nuestra app para no perderte nada y tener todo al alcance de tu mano</p>
        <div class="imagen-app">
          <img src="Imagenes/APP.png">
        </div>
      </div>
    </div>

    <div class="fila2">
      <div class="div3"></div>
      <div class="div4"></div>
    </div>

    <div class="fila3">
      <div class="div5"></div>
    </div>
  </div>

<!-- JS -->
<script src="js/script.js"></script>
</body>
</html>