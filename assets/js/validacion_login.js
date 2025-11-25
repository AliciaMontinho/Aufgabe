document.addEventListener("DOMContentLoaded", () => {
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const emailError = document.getElementById("emailError");
    const passwordError = document.getElementById("passwordError");
    const form = document.getElementById("formLogin");

    //evento para validar mientras se está escribiendo
    email.addEventListener("input", validarEmail);
    password.addEventListener("input", validarPassword);

    //evento para validar al salir del campo
    email.addEventListener("blur", validarEmail);
    password.addEventListener("blur", validarPassword);

    //validar al enviar el formulario
    form.addEventListener("submit", function (e) {
        validarEmail();
        validarPassword();

        if (email.classList.contains("is-invalid") ||
            password.classList.contains("is-invalid")) {
            e.preventDefault(); 
        }
    });

    function validarEmail() {
        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!regexEmail.test(email.value.trim())) {
            marcarError(email, emailError, "Formato de correo no válido.");
        } else {
            marcarBien(email, emailError);
        }
    }

    function validarPassword() {
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
});
