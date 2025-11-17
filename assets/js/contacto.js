document.addEventListener('DOMContentLoaded', function () {

    const formulario = document.querySelector("form");

    formulario.addEventListener("submit", function (e) {
        let errores = [];

        const nombre = document.getElementById("nombre");
        const email = document.getElementById("email");
        const asunto = document.getElementById("asunto");
        const mensaje = document.getElementById("mensaje");

        // Limpiar errores anteriores
        document.querySelectorAll(".error").forEach(el => el.remove());

        if (nombre.value.trim() === "") {
            errores.push("El campo nombre es obligatorio");
        }

        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email.value.trim() === "" || !regexEmail.test(email.value)) {
            errores.push("El campo email es obligatorio y debe ser válido");
        }

        if (asunto.value.trim().length < 10) {
            errores.push("El campo asunto debe tener al menos 10 caracteres");
        }

        if (errores.length > 0) {

            errores.forEach(function (error) {
                const errorElemento = document.createElement("div");
                errorElemento.classList.add("error", "text-danger", "mb-2");
                errorElemento.innerText = error;
                formulario.prepend(errorElemento);
            });
        }


        formulario.reset();

        alert("Tu mensaje ha sido enviado con éxito.");
        window.location.href = "contacto.php";
    });

});
