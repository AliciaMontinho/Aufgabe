document.addEventListener("DOMContentLoaded", () => {
    
    // Inicializar EmailJS
    emailjs.init("XraosLltaJZxx3ZUR"); // <-- tu publicKey

});

// Esta función será llamada desde contacto.js
function sendEmail() {

    const params = {
        nombre: document.getElementById("nombre").value,
        email: document.getElementById("email").value,
        asunto: document.getElementById("asunto").value,
        mensaje: document.getElementById("mensaje").value
    };

    emailjs.send("aufgabe", "template_55b4b5h", params)
        .then(() => {
            mostrarMensajeFlotante("Mensaje enviado correctamente.", "exito");
            document.getElementById("formContacto").reset();
        })
        .catch(() => {
            mostrarMensajeFlotante("Error al enviar el mensaje. Intenta de nuevo.", "error");
        });
}


// Mensaje flotante compatible con CSS
function mostrarMensajeFlotante(texto, tipo) {
    const div = document.createElement("div");
    div.textContent = texto;
    div.classList.add("mensaje-flotante", tipo);
    document.body.appendChild(div);
    setTimeout(() => div.remove(), 3500);
}