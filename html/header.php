?php include "includes/header.php"; ?

<header>
  <!-- Logo de la web -->
  <div class="logo">DAILY DOSE</div>

  <!-- Botón de menú (solo visible en móvil) -->
  <button id="menuBtn" aria-label="Abrir menú">☰</button>

  <!-- Menú horizontal -->
  <div class="menu-container" id="menu">
    <nav class="menu-header">
      <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="carta.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'carta.php' ? 'activo' : ''; ?>">Carta</a></li>
        <li><a href="novedades.php">Novedades</a></li>
        <li><a href="pedidos.php">Pedidos</a></li>
        <li><a href="promociones.php">Promociones</a></li>
      </ul>
    </nav>
  </div>

  <!-- Sección derecha del header: modo oscuro + usuario -->
  <div class="header-right">
    <!-- Toggle modo oscuro -->
    <label class="switch">
      <input type="checkbox" id="toggleTema">
      <span class="slider">
        <span class="circle">
          <!-- Icono Sol -->
          <svg class="icono sol" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="5" fill="var(--rojo-japones)" />
            <g stroke="var(--rojo-japones)" stroke-width="2">
              <line x1="12" y1="1" x2="12" y2="4"/>
              <line x1="12" y1="20" x2="12" y2="23"/>
              <line x1="1" y1="12" x2="4" y2="12"/>
              <line x1="20" y1="12" x2="23" y2="12"/>
              <line x1="4.2" y1="4.2" x2="6" y2="6"/>
              <line x1="18" y1="18" x2="19.8" y2="19.8"/>
              <line x1="4.2" y1="19.8" x2="6" y2="18"/>
              <line x1="18" y1="6" x2="19.8" y2="4.2"/>
            </g>
          </svg>
          <!-- Icono Luna -->
          <svg class="icono luna" viewBox="0 0 24 24">
            <path d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z" fill="var(--rojo-japones)"/>
          </svg>
        </span>
      </span>
    </label>

    <!-- Icono de usuario / perfil -->
    <a href="registro.php" class="iconoUsuario" title="Iniciar sesión / Registrarse">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="28" height="28">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M5.121 17.804A9 9 0 0112 15a9 9 0 016.879 2.804M12 12a5 5 0 100-10 5 5 0 000 10z"/>
      </svg>
    </a>
  </div>
</header>