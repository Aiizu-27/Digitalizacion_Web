// ==========================
// Modo oscuro
// ==========================
const toggle = document.getElementById("toggleTema"); // checkbox
const body = document.body;
const circle = document.querySelector(".circle");
const sol = document.querySelector(".sol");
const luna = document.querySelector(".luna");

toggle.addEventListener("change", () => {
    // Añade o quita la clase dark-mode al body
    body.classList.toggle("dark-mode", toggle.checked);

    // Animación del toggle (mover el círculo y cambiar iconos)
    if(toggle.checked){
        circle.style.transform = "translateX(26px)";
        sol.style.opacity = "0"; // Oculta el sol
        luna.style.opacity = "1"; // Muestra la luna
    } else {
        circle.style.transform = "translateX(0)";
        sol.style.opacity = "1"; // Muestra el sol
        luna.style.opacity = "0"; // Oculta la luna
    }
});

// ==========================
// Menú lateral
// ==========================
const menuBtn = document.getElementById("menuBtn");
const sidebar = document.getElementById("sidebar");
const overlay = document.getElementById("overlay");

function toggleMenu() {
    // Activa/desactiva la clase 'active' en el sidebar y overlay
    sidebar.classList.toggle("active");
    overlay.classList.toggle("active");

    // Cambia el icono del botón (hamburguesa <-> X)
    menuBtn.innerHTML = sidebar.classList.contains("active") ? "&#10005;" : "&#9776;";
}

// Eventos para abrir/cerrar menú
menuBtn.addEventListener("click", toggleMenu);
overlay.addEventListener("click", toggleMenu);

// ==========================
// Cambiar entre login y registro
// ==========================
const tabLogin = document.getElementById("tabLogin");
const tabRegistro = document.getElementById("tabRegistro");
const formLogin = document.getElementById("formLogin");
const formRegistro = document.getElementById("formRegistro");

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

// ==========================
// Mostrar / ocultar contraseña
// ==========================
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    const ojoAbierto = icon.querySelectorAll(".ojo-abierto");
    const ojoCerrado = icon.querySelectorAll(".ojo-cerrado");

    // Inicial: ojo cerrado oculto
    ojoCerrado.forEach(path => path.style.display = "none");

    icon.addEventListener("click", () => {
        const tipo = input.type === "password" ? "text" : "password";
        input.type = tipo;

        if (tipo === "text") {
            ojoAbierto.forEach(path => path.style.display = "none");
            ojoCerrado.forEach(path => path.style.display = "block");
        } else {
            ojoAbierto.forEach(path => path.style.display = "block");
            ojoCerrado.forEach(path => path.style.display = "none");
        }
    });
}

togglePassword("claveLogin", "iconoOjoLogin");
togglePassword("claveRegistro", "iconoOjoRegistro");