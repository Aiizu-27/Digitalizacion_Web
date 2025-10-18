// ==========================
// script.js
// ==========================

document.addEventListener('DOMContentLoaded', () => {

// ------------ TOGGLE DARK MODE ------------

// Seleccionamos toggles
const toggleMobile = document.getElementById("toggleTemaMobile");
const toggleDesktop = document.getElementById("toggleTemaDesktop");
const body = document.body;

// Función para cambiar modo oscuro y animación del toggle
function toggleDarkMode(toggle, solIcon, lunaIcon, circle) {
    toggle.addEventListener("change", () => {
        body.classList.toggle("dark-mode", toggle.checked);
        solIcon.style.opacity = toggle.checked ? "0" : "1";
        lunaIcon.style.opacity = toggle.checked ? "1" : "0";
        circle.style.transform = toggle.checked ? "translateX(26px)" : "translateX(0)";
    });
}

// Móvil
if(toggleMobile){
    const solMobile = document.querySelector(".header-right-mobile .sol");
    const lunaMobile = document.querySelector(".header-right-mobile .luna");
    const circleMobile = document.querySelector(".header-right-mobile .circle");
    toggleDarkMode(toggleMobile, solMobile, lunaMobile, circleMobile);
}

// Escritorio
if(toggleDesktop){
    const solDesktop = document.querySelector(".header-right .sol");
    const lunaDesktop = document.querySelector(".header-right .luna");
    const circleDesktop = document.querySelector(".header-right .circle");
    toggleDarkMode(toggleDesktop, solDesktop, lunaDesktop, circleDesktop);
}

// ------------ MENÚ HAMBURGUESA ------------

const menuBtn = document.getElementById("menuBtn");
const menu = document.getElementById("menu");

menuBtn.addEventListener("click", () => {
    menu.classList.toggle("menu-abierto");
});

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

const menuBtn = document.getElementById('menuBtn');
const menuCerrar = document.getElementById('menuCerrar');
const menu = document.getElementById('menu');

// Abrir menú
menuBtn.addEventListener('click', () => {
    menu.classList.add('open');
});

// Cerrar menú con la X
menuCerrar.addEventListener('click', () => {
    menu.classList.remove('open');
});

