document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("filtroHistorial");
    const tbody = document.querySelector(".tabla-historial tbody");

    form.addEventListener("change", filtrarHistorial);

    function filtrarHistorial() {
        const datos = new FormData(form);

        tbody.innerHTML = `<tr><td colspan="7" class="text-center py-4">⏳ Cargando...</td></tr>`;

        fetch('./tabla_historial.php?' + new URLSearchParams(datos))
            .then(res => res.text())
            .then(html => {
                tbody.innerHTML = html;
                aplicarEfectosVisualesHistorial();  
            })
            .catch(err => console.error("ERROR AJAX:", err));
    }


    filtrarHistorial();
});

function aplicarEfectosVisualesHistorial() {

    const filas = document.querySelectorAll(".tabla-historial tbody tr");
    filas.forEach((fila, i) => {
        setTimeout(() => fila.classList.add("mostrar"), i * 120);
    });

    document.querySelectorAll(".badge").forEach(badge => {
        const texto = badge.textContent.toLowerCase();

        if (texto.includes("completado"))  badge.style.background = "#2a9d8f"; 
        if (texto.includes("en proceso"))  badge.style.background = "#ffdd57"; 
        if (texto.includes("no atendido")) badge.style.background = "#6c757d"; 
    });
}
