<?php
include_once '../includes/header.php';
require_once '../config/Database.php';
require_once '../includes/auth.php';

$database = new Database();
$db = $database->conectar();

$ano = $_GET['ano'] ?? '';
$mes = $_GET['mes'] ?? '';

//solo finalizadas
$sql = "
    SELECT i.id_incidencia, i.titulo, i.fecha_inicio, i.fecha_fin,
           i.estado,
            h.numero AS habitacion,
           u.nombre AS tecnico,
           c.nombre AS casa
    FROM incidencias i
    LEFT JOIN habitaciones h ON i.id_habitacion = h.id_habitacion
    LEFT JOIN casas c ON h.id_casa = c.id_casa
    LEFT JOIN usuarios u ON i.id_tecnico = u.id_usuario
    WHERE i.estado = 'completado'
"; 
//  Usamos left join para mostrar todas las incidencias aunque no tengan técnico asignado
//ya que left join incluye todas las filas de la tabla izquierda (incidencias) aunque no haya coincidencia en la derecha (usuarios)



//filtros
if ($ano !== '') {
    $sql .= " AND YEAR(i.fecha_fin) = :year";
}
if ($mes !== '') {
    $sql .= " AND MONTH(i.fecha_fin) = :month";
}

// if (!empty($_GET['casa'])) {
//     $sql .= " AND c.id_casa = :casa";
// }

$sql .= " ORDER BY i.fecha_fin DESC"; //concatena a la consulta principal

$stmt = $db->prepare($sql);
if ($ano !== '') $stmt->bindParam(':year', $ano, PDO::PARAM_INT);
if ($mes !== '') $stmt->bindParam(':month', $mes, PDO::PARAM_INT);
$stmt->execute();

$historial = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../assets/css/historial.css">
<div class="container historial-container py-4">
    <div class="text-center mb-4">
        <h2 class="text-primary fw-bold">
            <i class="bi bi-clock-history me-2"></i> Historial de incidencias
        </h2>
        <p class="text-muted">Consulta las incidencias finalizadas.</p>
    </div>

    <!--filtros-->
    <div class="card shadow-sm p-4 filtro-historial mb-4">
        <form class="row g-3" id="filtroHistorial">

    <div class="col-md-3">
        <label class="form-label fw-semibold">Casa</label>
        <select class="form-select" name="casa">
            <option value="">Todas</option>
            <option value="1">Kronenhof</option>
            <option value="2">Seefeld</option>
            <option value="3">Seeheim</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Año</label>
        <select class="form-select" name="ano">
            <option value="">Todos</option>
            <option value="2026">2026</option>
            <option value="2025">2025</option>
            <option value="2024">2024</option>
            <option value="2023">2023</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Mes</label>
        <select class="form-select" name="mes">
            <option value="">Todos</option>
            <?php 
            $meses = ["1"=>"Enero","2"=>"Febrero","3"=>"Marzo","4"=>"Abril","5"=>"Mayo",
                      "6"=>"Junio","7"=>"Julio","8"=>"Agosto","9"=>"Septiembre",
                      "10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre"];
            foreach ($meses as $num => $nombre): ?>
                <option value="<?= $num ?>"><?= $nombre ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-3 d-flex align-items-end">
        <button class="btn btn-primary w-100 fw-semibold">
            <i class="bi bi-funnel-fill me-1"></i> Filtrar
        </button>
    </div>
</form><br>

    <!--tabla del historial -->
    <div class="table-responsive">
        <table class="table table-hover tabla-responsive tabla-historial shadow-sm align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Incidencia</th>
                    <th>Casa</th>
                    <th>Habitación</th>
                    <th>Estado</th>
                    <th>Técnico</th>
                    <th>Fecha inicio</th>
                    <th>Fecha fin</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($historial)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No hay incidencias en el historial.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($historial as $h): ?>
                        <tr>
                            <td><?= htmlspecialchars($h['titulo']) ?></td>
                            <td><?= htmlspecialchars($h['casa'] ?? '—') ?></td>
                            <td><?= htmlspecialchars($h['habitacion']) ?></td>
                            <td><span class='badge bg-success'><?= htmlspecialchars($h['estado']) ?></span></td>
                            <td><?= htmlspecialchars($h['tecnico'] ?? '—') ?></td>
                            <td><?= date('Y-m-d H:i', strtotime($h['fecha_inicio'])) ?></td>
                            <td><?= $h['fecha_fin'] ? date('Y-m-d H:i', strtotime($h['fecha_fin'])) : '—' ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Acordeón que se visualizará en pantallas pequeñas (en este caso móvil) -->
    <div class="accordion mobile-accordion" id="accordionTable">
    <?php foreach ($historial as $h): ?>
        <?php $id = $h['id_incidencia'] ?? $h['id'] ?? uniqid(); ?>

        <div class="accordion-item">
            <h2 class="accordion-header" id="heading-<?= $id ?>">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-<?= $id ?>" aria-expanded="false"
                    aria-controls="collapse-<?= $id ?>">
                    <strong><?= htmlspecialchars($h['titulo']) ?></strong>
                </button>
            </h2>

            <div id="collapse-<?= $id ?>" class="accordion-collapse collapse"
                 aria-labelledby="heading-<?= $id ?>" data-bs-parent="#accordionTable">

                <div class="accordion-body">

                    <p><strong>Casa:</strong> <?= htmlspecialchars($h['casa'] ?? '—') ?></p>

                    <p><strong>Habitación:</strong> <?= htmlspecialchars($h['habitacion'] ?? '—') ?></p>

                    <p>
                        <strong>Estado:</strong>
                        <span class="badge bg-success">
                            <?= htmlspecialchars($h['estado']) ?>
                        </span>
                    </p>

                    <p><strong>Técnico:</strong> <?= htmlspecialchars($h['tecnico'] ?? '—') ?></p>

                    <p><strong>Fecha inicio:</strong>
                        <?= date('Y-m-d H:i', strtotime($h['fecha_inicio'])) ?>
                    </p>

                    <p><strong>Fecha fin:</strong>
                        <?= $h['fecha_fin']
                                ? date('Y-m-d H:i', strtotime($h['fecha_fin']))
                                : '—'
                        ?>
                    </p>

                </div>

            </div>
        </div>
    <?php endforeach; ?>
</div>
</div>

<script src="../assets/js/historial.js"></script>
<?php include_once '../includes/footer.php'; ?>
