document.addEventListener("DOMContentLoaded", () => {



    const form = document.querySelector("form");

    form.addEventListener("submit", function (e) {


        const actual = document.querySelector("input[name='password_actual']").value;
        const nueva = document.querySelector("input[name='password_nueva']").value;
        const repetir = document.querySelector("input[name='password_repetir']").value;


        if (nueva !== repetir) {
            e.preventDefault();
            mostrarMensaje("Las contraseñas no coinciden", "error");
            return;
        }

        if (nueva.length < 6) {
            e.preventDefault();
            mostrarMensaje("La contraseña debe tener al menos 6 caracteres", "warning");
            return;
        }

        form.submit();
    });


    function mostrarMensaje(texto, tipo) {
        let color = {
            exito: "green",
            error: "red",
            warning: "orange"
        }[tipo];

        const div = document.createElement("div");
        div.textContent = texto;
        div.style.background = color;
        div.style.color = "white";
        div.style.padding = "10px";
        div.style.marginTop = "10px";
        div.style.borderRadius = "5px";

        form.appendChild(div);

        setTimeout(() => div.remove(), 3500);
    }

    const cbNotificaciones = document.getElementById("notificaciones");
    const cbModoOscuro = document.getElementById("temaOscuro");

    cbNotificaciones.checked = localStorage.getItem("notificaciones") === "true";
    cbModoOscuro.checked = localStorage.getItem("temaOscuro") === "true";

    if (cbModoOscuro.checked) document.body.classList.add("dark-mode");

    cbNotificaciones.addEventListener("change", () => {
        localStorage.setItem("notificaciones", cbNotificaciones.checked);
    });

    cbModoOscuro.addEventListener("change", () => {
        localStorage.setItem("temaOscuro", cbModoOscuro.checked);
        document.body.classList.toggle("dark-mode");
    });

});
