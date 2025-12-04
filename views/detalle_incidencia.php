<?php
include '../includes/header.php';
include '../includes/auth.php';
require_once '../config/Database.php';

// Validar ID
if (!isset($_GET['id'])) {
    header("Location: incidencias.php?error=id_invalido");
    exit;
}

$id = intval($_GET['id']);

$database = new Database();
$db = $database->conectar();

// Obtener todos los datos completos de la incidencia
$sql = "
    SELECT i.*, 
           h.numero AS habitacion_numero,
           c.nombre AS casa_nombre,
           u.nombre AS creador_nombre,
           u.apellido AS creador_apellido
    FROM incidencias i
    LEFT JOIN habitaciones h ON i.id_habitacion = h.id_habitacion
    LEFT JOIN casas c ON h.id_casa = c.id_casa
    LEFT JOIN usuarios u ON i.id_creador = u.id_usuario
    WHERE i.id_incidencia = :id
";

$stmt = $db->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();
$inc = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$inc) {
    header("Location: incidencias.php?error=no_existe");
    exit;
}

// Clases visuales según relevancia / estado
$badgeRel = [
    'alto' => 'bg-danger',
    'medio' => 'bg-warning text-dark',
    'bajo' => 'bg-success'
][$inc['relevancia']] ?? 'bg-secondary';

$badgeEstado = [
    'no_atendido' => 'bg-secondary',
    'en_proceso'  => 'bg-warning text-dark',
    'completado'  => 'bg-success'
][$inc['estado']] ?? 'bg-light text-dark';
?>

<link rel="stylesheet" href="../assets/css/detalle_incidencia.css">

<div class="container py-4">

    <a href="incidencias.php" class="btn btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Volver
    </a>

    <div class="card shadow-sm p-4">
        <h2 class="text-primary fw-bold mb-3">
            <i class="bi bi-info-circle"></i> Detalle de incidencia
        </h2>

        <div class="row g-4">

            <!-- Información principal -->
            <div class="col-md-6">
                <h4 class="fw-semibold"><?= htmlspecialchars($inc['titulo']) ?></h4>
                <p class="text-muted mb-1">
                    <strong>Casa:</strong> <?= htmlspecialchars($inc['casa_nombre']) ?>
                </p>
                <p class="text-muted mb-1">
                    <strong>Habitación:</strong> <?= htmlspecialchars($inc['habitacion_numero']) ?>
                </p>
                <p class="text-muted mb-1">
                    <strong>Creador:</strong> <?= htmlspecialchars($inc['creador_nombre'] . " " . $inc['creador_apellido']) ?>
                </p>
                <p class="text-muted mb-1">
                    <strong>Fecha inicio:</strong> <?= date("Y-m-d", strtotime($inc['fecha_inicio'])) ?>
                </p>
            </div>

            <!-- Badges -->
            <div class="col-md-6">
                <p>
                    <strong>Relevancia: </strong>
                    <span class="badge <?= $badgeRel ?>"><?= ucfirst($inc['relevancia']) ?></span>
                </p>
                <p>
                    <strong>Estado: </strong>
                    <span class="badge <?= $badgeEstado ?>">
                        <?= str_replace('_', ' ', ucfirst($inc['estado'])) ?>
                    </span>
                </p>

                <?php if ($_SESSION['rol'] === 'tecnico'): ?>
                    <a href="editar_incidencia.php?id=<?= $id ?>" class="btn btn-warning text-white mt-2">
                        <i class="bi bi-pencil"></i> Editar incidencia
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <hr>

        <!-- Descripción -->
        <h5 class="fw-bold">Descripción</h5>
        <p><?= nl2br(htmlspecialchars($inc['descripcion'])) ?></p>

    </div>
</div>

<?php include '../includes/footer.php'; ?>
