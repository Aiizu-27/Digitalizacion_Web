// ==========================
// script.js
// ==========================

document.addEventListener('DOMContentLoaded', () => {

    // ==========================
    // Modo oscuro
    // ==========================
    const toggle = document.getElementById("toggleTema");
    const body = document.body;
    const circle = document.querySelector(".circle");
    const sol = document.querySelector(".sol");
    const luna = document.querySelector(".luna");

    if(toggle){
        toggle.addEventListener("change", () => {
            body.classList.toggle("dark-mode", toggle.checked);

            if(toggle.checked){
                circle.style.transform = "translateX(26px)";
                sol.style.opacity = "0";
                luna.style.opacity = "1";
            } else {
                circle.style.transform = "translateX(0)";
                sol.style.opacity = "1";
                luna.style.opacity = "0";
            }
        });
    }

    // ==========================
    // Menú lateral
    // ==========================
    const menuBtn = document.getElementById("menuBtn");
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    function toggleMenu() {
        if(!sidebar || !overlay || !menuBtn) return;

        sidebar.classList.toggle("active");
        overlay.classList.toggle("active");
        menuBtn.innerHTML = sidebar.classList.contains("active") ? "&#10005;" : "&#9776;";
    }

    if(menuBtn && overlay){
        menuBtn.addEventListener("click", toggleMenu);
        overlay.addEventListener("click", toggleMenu);
    }

    // ==========================
    // Cambiar entre login y registro
    // ==========================
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

    // ==========================
    // Mostrar / ocultar contraseña
    // ==========================
    function togglePassword(inputId, iconId){
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if(!input || !icon) return;

        const ojoAbierto = icon.querySelectorAll(".ojo-abierto");
        const ojoCerrado = icon.querySelectorAll(".ojo-cerrado");

        ojoCerrado.forEach(path => path.style.display = "none");

        icon.addEventListener("click", () => {
            const tipo = input.type === "password" ? "text" : "password";
            input.type = tipo;

            if(tipo === "text"){
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

    // ==========================
    // Registro con PHP (fetch)
    // ==========================
    if(formRegistro){
        formRegistro.addEventListener('submit', function(e){
            e.preventDefault();

            const data = {
                nombre: formRegistro.elements['nombre'].value,
                correo: formRegistro.elements['correo'].value,
                contrasena: formRegistro.elements['contrasena'].value
            };

            fetch('registro.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(resp => {
                alert(resp.message);
            })
            .catch(err => console.error("Error al enviar registro:", err));
        });
    }

});

//menu en movil
const menuBtn = document.getElementById('menuBtn');
const menu = document.getElementById('menu');

menuBtn.addEventListener('click', () => {
    menu.classList.toggle('open');
});

