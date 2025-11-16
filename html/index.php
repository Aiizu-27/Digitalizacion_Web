<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DAILY DOSE - Tu dosis diaria de café</title>
<!-- Enlace al CSS externo -->
<link rel="stylesheet" href="css/variables.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/footer.css">
</head>
<body>

<!-- Header / Cabecera de la página -->
<?php include "header.php"; ?>

  <!-- Contenedor de pantalla inicial -->
  <div class="contenedor-fijo">
    <!-- Video de fondo -->
    <video class="video-fondo" autoplay muted loop>
      <source src="imagenes/VideoInicio.mp4" type="video/mp4">
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
          <img src="imagenes/APP.png">
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

<footer class="footer-cristal">
  <div class="footer-contenido">
    <div class="footer-info">
      <h3>DAILY DOSE</h3>
      <p>Tu dosis diaria de café.</p>
      <p>Calle del Café, 12 · Madrid</p>
      <p><a href="mailto:contacto@dailydose.com">contacto@dailydose.com</a></p>
    </div>

    <div class="footer-redes">
      <h4>Síguenos</h4>
      <div class="iconos-redes">
        <a href="https://www.instagram.com/_aiizu_27_?igsh=bGJkd2tlNmNkcjJq"><img src="Imagenes/instagram.svg" alt="Instagram"></a>
        <a href="#"><img src="Imagenes/twitter.svg" alt="Twitter"></a>
      </div>
    </div>
  </div>

  <div class="footer-copy">
    <p>&copy; 2025 DAILY DOSE · Todos los derechos reservados</p>
  </div>
</footer>

<!-- JS -->
<script src="js/script.js"></script>
</body>
</html>