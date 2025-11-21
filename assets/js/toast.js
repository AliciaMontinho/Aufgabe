function mostrarToast(mensaje, tipo = "success") {
    const toast = document.createElement("div");
    toast.className = `toast-notificacion ${tipo}`;
    toast.innerHTML = `
        <i class="bi ${tipo === "success" ? "bi-check-circle" : "bi-exclamation-circle"}"></i>
        <span>${mensaje}</span>
    `;
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.add("mostrar");
    }, 10);

    setTimeout(() => {
        toast.classList.remove("mostrar");
        setTimeout(() => toast.remove(), 300);
    }, 3500);
}