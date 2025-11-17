//Este script sirve para que a la hora de crear una nueva incidencia se rellene la opción de seleccionar
//habitaciones con las habitaciones de las caas, por ejemplo, la casa 1 tiene las habitaciones que empiezan por 100, 
//la casa 2 tiene las habitaciones que empiezan por 2 y la 3 las que empiezan por 3. Así se nos facilita la búsqueda.
//Cargamos el documento
document.addEventListener('DOMContentLoaded', () => {
    const casaSelect = document.getElementById('casaSeleccionada');
    const habitacionSelect = document.getElementById('habitacionSeleccionada');

    casaSelect.addEventListener('change', async () => {
        const idCasa = casaSelect.value;  //recogemos el id de la cas que se selecciona en el form.

        try {
            const res = await fetch(`../controller/IncidenciaController.php?action=habitaciones&id_casa=${idCasa}`);
            const data = await res.json();

            habitacionSelect.innerHTML = '<option value="" disabled selected>Selecciona una habitación</option>';

            data.forEach(h => {
                const opt = document.createElement('option');
                opt.value = h.id_habitacion;
                //Uso un fallback para asegurarme de que se puede mostrar un valor alternativo si el principal no existe o está vacío
                opt.textContent = h.numero ?? h.nombre ?? h.numero ?? (`Hab ${h.id_habitacion}`);
                habitacionSelect.appendChild(opt);
            });
        } catch (e) {
            console.error(e);
            habitacionSelect.innerHTML = '<option disabled>Error al cargar habitaciones</option>';
        }
    });
});
