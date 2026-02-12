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
    <link rel="stylesheet" href="assets/css/index.css">
  </head>

  <body>

  <!-- Header / Cabecera de la página -->
  <?php include "includes/header.php"; ?>

  <!-- Contenedor de pantalla inicial -->
  <div class="contenedor-fijo">
    <!-- Video de fondo -->
    <video class="video-fondo" autoplay muted loop>
      <source src="assets/video/VideoInicio.mp4" type="video/mp4">
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
        <h2>Descarga la app</h2>
        <p>
        Gestiona tus pedidos, acumula puntos y reserva tu espacio desde cualquier lugar.
        Todo tu Daily Dose en la palma de tu mano.
        </p>
        <div class="imagen-app">
          <img src="assets/img/APP.png">
        </div>
      </div>
    </div>

    <div class="fila2">
      <div class="div3">
        <h2>Tu experiencia en 4 pasos</h2>
        <ul class="pasos">
          <li>Elige tu bebida favorita desde nuestra carta online.</li>
          <li>Haz tu pedido o reserva tu sala en pocos clics.</li>
          <li>Acumula puntos con cada compra.</li>
          <li>Disfruta tu Daily Dose en un entorno pensado para ti.</li>
        </ul>
      </div>
      <div class="div4">

      </div>
    </div>

    <div class="fila3">
      <div class="div5">
        <h2>Cada café cuenta</h2>
        <p>Con nuestro programa de fidelización, cada compra suma puntos.
        Canjea recompensas, consulta tu historial y disfruta ventajas exclusivas.</p>
        <a href="registro.php" class="btn-principal">Crear cuenta</a>
      </div>
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
          <a href="#"><img src="assets/img/instagram.svg" alt="Instagram"></a>
          <a href="#"><img src="assets/img/twitter.svg" alt="Twitter"></a>
        </div>
      </div>
    </div>

    <div class="footer-copy">
      <p>&copy; 2025 DAILY DOSE · Todos los derechos reservados</p>
    </div>
  </footer>

<!-- JS -->
<script src="assets/js/script.js"></script>
</body>
</html>