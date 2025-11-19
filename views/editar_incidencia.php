<?php
include '../includes/header.php';
include '../includes/auth.php';
require_once '../config/Database.php';
require_once '../models/Incidencia.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'tecnico') {
    header("Location: incidencias.php?error=permiso_denegado");
    exit;
}


$database = new Database();
$db = $database->conectar();

$incidenciaModel = new Incidencia($db);

$id_incidencia = $_GET['id'] ?? null;
if (!$id_incidencia) {
    header("Location: historial/historial.php");
    exit;
}

$incidencia = $incidenciaModel->obtenerPorId($id_incidencia);
if (!$incidencia) {
    echo "<div class='alert alert-danger m-4'>Incidencia no encontrada.</div>";
    include '../includes/footer.php';
    exit;
}

$stmt = $db->prepare("
    SELECT c.id_casa, c.nombre 
    FROM casas c 
    JOIN habitaciones h ON c.id_casa = h.id_casa 
    WHERE h.id_habitacion = :id_habitacion
");
$stmt->bindParam(':id_habitacion', $incidencia['id_habitacion'], PDO::PARAM_INT);
$stmt->execute();
$casa = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../assets/css/nueva_incidencia.css">

<div class="container py-4" style="max-width: 700px;">
    <h2 class="text-primary fw-bold mb-4">Editar incidencia</h2>

    <form action="../controller/IncidenciaController.php?action=actualizar" method="POST">
        <input type="hidden" name="id_incidencia" value="<?= $incidencia['id_incidencia'] ?>">

        <div class="mb-3">
            <label class="form-label">Casa</label>
            <select id="casaSeleccionada" class="form-select" required>
                <option value="" disabled>Selecciona una casa</option>
                <option value="1" <?= ($casa['id_casa'] == 1) ? 'selected' : '' ?>>Kronenhof</option>
                <option value="2" <?= ($casa['id_casa'] == 2) ? 'selected' : '' ?>>Seefeld</option>
                <option value="3" <?= ($casa['id_casa'] == 3) ? 'selected' : '' ?>>Seeheim</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Habitación</label>
            <select id="habitacionSeleccionada" name="id_habitacion" class="form-select" required data-habitacion-actual="<?= htmlspecialchars($incidencia['id_habitacion']) ?>">
                <option value="">Selecciona una habitación</option>
            </select>

        </div>

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" required value="<?= htmlspecialchars($incidencia['titulo']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" rows="3" class="form-control" required><?= htmlspecialchars($incidencia['descripcion']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Relevancia</label>
            <select name="relevancia" class="form-select" required>
                <option value="bajo" <?= ($incidencia['relevancia'] == 'bajo') ? 'selected' : '' ?>>Baja</option>
                <option value="medio" <?= ($incidencia['relevancia'] == 'medio') ? 'selected' : '' ?>>Media</option>
                <option value="alto" <?= ($incidencia['relevancia'] == 'alto') ? 'selected' : '' ?>>Alta</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-select" required>
                <option value="no_atendido" <?= ($incidencia['estado'] == 'no_atendido') ? 'selected' : '' ?>>No atendido</option>
                <option value="en_proceso" <?= ($incidencia['estado'] == 'en_proceso') ? 'selected' : '' ?>>En proceso</option>
                <option value="completado" <?= ($incidencia['estado'] == 'completado') ? 'selected' : '' ?>>Completada</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Guardar cambios</button>
    </form>
</div>

<!--Reutilizar el mismo script AJAX -->

<script src="../assets/js/editar_incidencia.js"></script>

<!-- Mi intención más adelante es que cuando se cree una nueva incidencia esta sea notificada con una pantallita emergente bonita
 mientras tanto lo haré con un alert-->
<?php if (isset($_GET['exito']) && $_GET['exito'] == 1): ?>
    <script>
        alert('Incidencia creada');
    </script>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>