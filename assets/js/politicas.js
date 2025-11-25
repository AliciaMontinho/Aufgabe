document.addEventListener("DOMContentLoaded", () => {
    setTimeout(() => { 
        const elementos = document.querySelectorAll(".politicas-container .card > *");
        console.log("Elementos encontrados:", elementos.length);
        
        elementos.forEach((el, i) => {
            setTimeout(() => el.classList.add("aparecer"), i * 120);
        });
    }, 100);

    //JS para actualizar la fecha automáticamente
    const fechaSpan = document.getElementById("fecha-actualizacion"); // 👈 ID del span en HTML
    if (fechaSpan) {

        const meses = [
            "enero", "febrero", "marzo", "abril", "mayo", "junio",
            "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
        ];

        const hoy = new Date();
        const mes = meses[hoy.getMonth()]; //Como es noviembre guarda como íncice 10 y lo busca en el array
        const anio = hoy.getFullYear(); //recoge el año actual

        fechaSpan.textContent = `${mes} ${anio}`; //lo que veremos en el HTML
    }
});