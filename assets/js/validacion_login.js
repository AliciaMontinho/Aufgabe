document.addEventListener("DOMContentLoaded", () => {
//mejoras para validación de login
    console.log("JS cargado.");

    try {
        const email = document.getElementById("email");
        const password = document.getElementById("password");
        const emailError = document.getElementById("emailError");
        const passwordError = document.getElementById("passwordError");
        const form = document.getElementById("formLogin");

        console.log("Elementos capturados:", email, password, emailError, passwordError);


        email.addEventListener("input", validarEmail);
        password.addEventListener("input", validarPassword);

        email.addEventListener("blur", validarEmail);
        password.addEventListener("blur", validarPassword);

        form.addEventListener("submit", function (e) {
            validarEmail();
            validarPassword();

            if (email.classList.contains("is-invalid") ||
                password.classList.contains("is-invalid")) {
                e.preventDefault();
            }
        });

        console.log("Leyendo parámetro error de la URL...");
        const params = new URLSearchParams(window.location.search);
        const error = params.get("error");
        console.log("Valor de error =", error);

        if (error === "email") {
            console.log("→ MOSTRANDO ERROR DE EMAIL INCORRECTO");
            marcarError(email, emailError, "Correo incorrecto.");
        }

        if (error === "password") {
            console.log("→ MOSTRANDO ERROR DE PASSWORD INCORRECTO");
            marcarError(password, passwordError, "Contraseña incorrecta.");
        }

        function validarEmail() {
            console.log("Validando email...");
            const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!regexEmail.test(email.value.trim())) {
                marcarError(email, emailError, "Formato de correo no válido.");
            } else {
                marcarBien(email, emailError);
            }
        }

        function validarPassword() {
            console.log("Validando password...");
            if (password.value.trim().length < 4) {
                marcarError(password, passwordError, "Mínimo 4 caracteres.");
            } else {
                marcarBien(password, passwordError);
            }
        }

        function marcarError(campo, divError, mensaje) {
            campo.classList.add("is-invalid");
            campo.classList.remove("is-valid");
            campo.style.boxShadow = "0 0 6px rgba(255,0,0,1)";
            divError.textContent = mensaje;
            divError.classList.remove("d-none");
        }

        function marcarBien(campo, divError) {
            campo.classList.remove("is-invalid");
            campo.classList.add("is-valid");
            campo.style.boxShadow = "0 0 6px rgba(0,200,0,1)";
            divError.classList.add("d-none");
        }

    } catch (error) {
        console.error("⚠️ ERROR EN EL SCRIPT:", error);
    }
});
