document.addEventListener('DOMContentLoaded', () => {
  const body = document.body;

  // ---------- Toggle Dark Mode ----------
  const toggleTema = document.getElementById("toggleTema");
  if(toggleTema){
    const solIcon = document.querySelector(".header-right .sol");
    const lunaIcon = document.querySelector(".header-right .luna");
    const circle = document.querySelector(".header-right .circle");

    toggleTema.addEventListener("change", () => {
      body.classList.toggle("dark-mode", toggleTema.checked);
      solIcon.style.opacity = toggleTema.checked ? "0" : "1";
      lunaIcon.style.opacity = toggleTema.checked ? "1" : "0";
      circle.style.transform = toggleTema.checked ? "translateX(26px)" : "translateX(0)";
    });
  }

  // ---------- Menú hamburguesa ----------
  const menuBtn = document.getElementById('menuBtn');
  const menuCerrar = document.getElementById('menuCerrar');
  const menu = document.getElementById('menu');

  if(menuBtn && menuCerrar && menu){
    menuBtn.addEventListener('click', () => menu.classList.add('open'));
    menuCerrar.addEventListener('click', () => menu.classList.remove('open'));
  }

  // ---------- Login / Registro ----------
  const tabLogin = document.getElementById("tabLogin");
  const tabRegistro = document.getElementById("tabRegistro");
  const formLogin = document.getElementById("formLogin");
  const formRegistro = document.getElementById("formRegistro");

  if(tabLogin && tabRegistro && formLogin && formRegistro){
    tabLogin.addEventListener("click", () => {
      tabLogin.classList.add("active");
      tabRegistro.classList.remove("active");
      formLogin.style.display = "block";
      formRegistro.style.display = "none";
    });
    tabRegistro.addEventListener("click", () => {
      tabRegistro.classList.add("active");
      tabLogin.classList.remove("active");
      formRegistro.style.display = "block";
      formLogin.style.display = "none";
    });
  }

  // ---------- Mostrar / Ocultar contraseña ----------
  function togglePassword(inputId, iconId){
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if(!input || !icon) return;

    const ojoAbierto = icon.querySelectorAll(".ojo-abierto");
    const ojoCerrado = icon.querySelectorAll(".ojo-cerrado");
    ojoCerrado.forEach(p => p.style.display = "none");

    icon.addEventListener("click", () => {
      const tipo = input.type === "password" ? "text" : "password";
      input.type = tipo;
      if(tipo === "text"){
        ojoAbierto.forEach(p => p.style.display = "none");
        ojoCerrado.forEach(p => p.style.display = "block");
      } else {
        ojoAbierto.forEach(p => p.style.display = "block");
        ojoCerrado.forEach(p => p.style.display = "none");
      }
    });
  }

  togglePassword("claveLogin", "iconoOjoLogin");
  togglePassword("claveRegistro", "iconoOjoRegistro");
});

