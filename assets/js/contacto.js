document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("formContacto");
    const inputs = form.querySelectorAll("input, textarea");
    const btn = form.querySelector("button");

    btn.disabled = true; // inicio
    btn.style.opacity = "0.6";

    
    const validaciones = {
        nombre: valor => valor.trim().length >= 3,
        email: valor => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valor),
        asunto: valor => valor.trim().length >= 4,
        mensaje: valor => valor.trim().length >= 10
    };

    inputs.forEach(input => {
        input.addEventListener("input", () => {
            validarInput(input);
            verificarFormulario();
        });
    });

    form.addEventListener("submit", e => {
        e.preventDefault();
        if (verificarFormulario()) {
            sendEmail();
            // Aquí podrías enviar el formulario con AJAX si tuvieras backend
            form.reset();
            btn.disabled = true;
            btn.style.opacity = "0.6";
            limpiarClases();
        } else {
            mostrarMensaje("Por favor, revisa los campos marcados.", "error");
        }
    });

    function validarInput(input) {
        const campo = input.name;
        const valor = input.value;

        if (validaciones[campo] && validaciones[campo](valor)) {
            input.classList.remove("is-invalid");
            input.classList.add("is-valid");
        } else {
            input.classList.remove("is-valid");
            input.classList.add("is-invalid");
        }
    }

    function verificarFormulario() {
        for (let input of inputs) {
            if (validaciones[input.name] && !validaciones[input.name](input.value)) {
                btn.disabled = true;
                btn.style.opacity = "0.6";
                btn.style.cursor = "not-allowed";
                return false;
            }
        }
        btn.disabled = false;
        btn.style.opacity = "1";
        btn.style.cursor = "pointer";
        return true;
    }

    function limpiarClases() {
        inputs.forEach(input =>
            input.classList.remove("is-valid","is-invalid")
        );
    }

    function mostrarMensaje(texto, tipo) {
        const div = document.createElement("div");
        div.textContent = texto;
        div.classList.add("mensaje-flotante", tipo);
        document.body.appendChild(div);
        setTimeout(() => div.remove(), 3500);
    }
});


//serviceID: aufgabe
//templateID: template_55b4b5h
//publicKey: XraosLltaJZxx3ZUR