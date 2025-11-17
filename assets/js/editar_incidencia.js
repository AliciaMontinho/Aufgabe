document.addEventListener('DOMContentLoaded', async () => {
    const casaSelect = document.getElementById('casaSeleccionada');
    const habitacionSelect = document.getElementById('habitacionSeleccionada');
    if (!casaSelect || !habitacionSelect) return;

    const habitacionActual = habitacionSelect.dataset.habitacionActual;

    async function cargarHabitaciones(idCasa, habitacionSeleccionada = null) {
        if (!idCasa) return;

        try {
            console.log("➡️ Cargando habitaciones para casa ID:", idCasa);
            const response = await fetch(`../controller/IncidenciaController.php?action=habitaciones&id_casa=${idCasa}`);
            const data = await response.json();

            console.log("📦 Datos recibidos del backend:", data); //aquí veremos qué llega

            habitacionSelect.innerHTML = '<option value="" disabled selected>Selecciona una habitación</option>';

            if (!data || data.length === 0) {
                habitacionSelect.innerHTML = '<option value="">No hay habitaciones en esta casa</option>';
                return;
            }

            data.forEach(h => {
                const opt = document.createElement('option');
                opt.value = h.id_habitacion;
                opt.textContent = h.numero || "sin numero detectado";
                if (habitacionSeleccionada && h.id_habitacion == habitacionSeleccionada) {
                    opt.selected = true;
                }
                habitacionSelect.appendChild(opt);
            });
        } catch (error) {
            console.error("Error al cargar habitaciones:", error);
        }
    }

    const casaInicial = casaSelect.value;
    if (casaInicial) {
        await cargarHabitaciones(casaInicial, habitacionActual);
    }

    casaSelect.addEventListener('change', () => {
        cargarHabitaciones(casaSelect.value);
    });
});
