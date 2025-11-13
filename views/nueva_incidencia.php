<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../assets/css/nueva_incidencia.css">

<div class="container py-4" style="max-width: 700px;">
    <h2 class="text-primary fw-bold mb-4">Nueva incidencia</h2>

    <form action="../controller/IncidenciaController.php?action=guardar" method="POST">


        <div class="mb-3">
            <label class="form-label">Casa</label>
            <select id="casaSeleccionada" class="form-select" required>
                <option value="" selected disabled>Selecciona una casa</option>
                <option value="1">Kronenhof</option>
                <option value="2">Seefeld</option>
                <option value="3">Seeheim</option>
            </select>
        </div>


        <div class="mb-3">
            <label class="form-label">Habitación</label>
            <select id="habitacionSeleccionada" name="id_habitacion" class="form-select shadow-sm" required>
                <option value="" selected disabled>Selecciona una habitación</option>
            </select>

        </div>

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" rows="3" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Relevancia</label>
            <select name="relevancia" class="form-select" required>
                <option value="bajo">Baja</option>
                <option value="medio" selected>Media</option>
                <option value="alto">Alta</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-select" required>
                <option value="no_atendido" selected>No atendido</option>
                <option value="en_proceso">En proceso</option>
                <option value="finalizada">Finalizada</option>
            </select>
        </div>

        <input type="hidden" name="id_creador" value="1">

        <button type="submit" class="btn btn-primary w-100">Crear incidencia</button>
    </form>
</div>

<!-- Script de AJAX -->
<script src="../assets/js/nueva_incidencia.js"></script>


<!-- Mi intención más adelante es que cuando se cree una nueva incidencia esta sea notificada con una pantallita emergente bonita
 mientras tanto lo haré con un alert-->
<?php if (isset($_GET['exito']) && $_GET['exito'] == 1): ?>
<script>
    alert('Incidencia creada');
</script>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>