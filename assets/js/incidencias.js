document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("filtroForm");
    const tbody = document.querySelector(".tabla-incidencias tbody");

    form.addEventListener("change", filtrarIncidencias);

    function filtrarIncidencias() {
        const datos = new FormData(form);

        fetch('tabla_incidencias.php?' + new URLSearchParams(datos))
            .then(res => res.text())
            .then(html => {
                tbody.innerHTML = html;        
                aplicarEfectosVisuales();      
            })
            .catch(err => console.error('Error AJAX:', err));
    }

    aplicarEfectosVisuales();
});


function aplicarEfectosVisuales() {

    const filas = document.querySelectorAll(".tabla-incidencias tbody tr");
    filas.forEach((fila, i) => {
        setTimeout(() => fila.classList.add("mostrar"), i * 120);
    });

    document.querySelectorAll(".badge").forEach(badge => {
        const texto = badge.textContent.toLowerCase();

        if (texto.includes("alto"))   badge.style.background = "#e63946";
        if (texto.includes("medio"))  badge.style.background = "#ffdd57";
        if (texto.includes("bajo"))   badge.style.background = "#2a9d8f";
    });
}
