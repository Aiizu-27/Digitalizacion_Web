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
    const menu = document.querySelector('.menu-container');

    if(menuBtn && menuCerrar && menu){
        menuBtn.addEventListener('click', () => menu.classList.add('open'));
        menuCerrar.addEventListener('click', () => menu.classList.remove('open'));
    }

    // ---------- Mostrar / Ocultar contraseña ----------
    function togglePassword(inputId, iconId){
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if(!input || !icon) return;

        const ojoAbierto = icon.querySelectorAll(".ojo-abierto");
        const ojoCerrado = icon.querySelectorAll(".ojo-cerrado");

        // Inicializar estado visual
        if(input.type === "password"){
            ojoCerrado.forEach(p => p.style.display = "none");
            ojoAbierto.forEach(p => p.style.display = "block");
        }

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

    // Aplicar toggle a los inputs de contraseña
    togglePassword("claveLogin", "iconoOjoLogin");
    togglePassword("claveRegistro", "iconoOjoRegistro");

    // ---------- Login con redirección ----------
    const formLogin = document.getElementById("formLogin");
    if(formLogin){
        formLogin.addEventListener('submit', function(e){
            e.preventDefault();
            const formData = new FormData(this);

            // Ruta absoluta recomendada
            fetch('/actions/auth_login.php', { method:'POST', body: formData })
            .then(res => res.text())
            .then(data => {
                const respuesta = data.trim();

                switch(respuesta){
                    case "login_ok_admin":
                        window.location.href = "panel/dashboard_admin.php";
                        break;
                    case "login_ok_cliente":
                        window.location.href = "panel/dashboard_cliente.php";
                        break;
                    case "cambiar_password":
                        alert("Debes cambiar tu contraseña primero");
                        window.location.href = "panel/cambiar_contraseña.php";
                        break;
                    case "contraseña_incorrecta":
                        alert("Contraseña incorrecta");
                        break;
                    case "usuario_no_encontrado":
                        alert("Usuario no encontrado");
                        break;
                    case "campos_vacios":
                        alert("Por favor, completa todos los campos");
                        break;
                    default:
                        console.error("Respuesta inesperada de PHP:", respuesta);
                }
            })
            .catch(err => console.error("Error en fetch:", err));
        });
    }

    // ---------- REGISTRO ----------
    const formRegistro = document.getElementById("formRegistro");
    if(formRegistro){
        formRegistro.addEventListener('submit', function(e){
            e.preventDefault();
            const formData = new FormData(this);

            fetch('actions/auth_registro.php', { method:'POST', body: formData })
            .then(res => res.text())
            .then(data => {
                const respuesta = data.trim();

                if(respuesta === "registro_ok"){
                    alert("Registro exitoso. Ya puedes iniciar sesión.");
                    document.getElementById('tabLogin')?.click();
                    this.reset();
                } else if(respuesta === "correo_existente"){
                    alert("Este correo ya está registrado.");
                } else {
                    alert("Error: " + respuesta);
                }
            })
            .catch(err => console.error("Error en fetch:", err));
        });
    }
});