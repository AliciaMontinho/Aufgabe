document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".dashboard-card, .caja-resumen");
    cards.forEach((card, i) => {
        card.style.opacity = "0";

        setTimeout(() => {
            card.style.opacity = "1";
            card.style.transform = "translateY(0)";
        }, i * 120); 
    });
});