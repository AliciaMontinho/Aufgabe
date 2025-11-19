<?php include_once '../includes/header.php';
require_once '../config/Database.php';
require_once '../includes/auth.php';
$database = new Database();
$db = $database->conectar();

$sql = "
    SELECT i.id_incidencia, i.titulo, i.fecha_inicio, i.fecha_fin,
           i.estado,
           i.id_tecnico,
           c.nombre AS casa, 
           u.nombre AS tecnico
    FROM incidencias i
    LEFT JOIN habitaciones h ON i.id_habitacion = h.id_habitacion
    LEFT JOIN casas c ON h.id_casa = c.id_casa
    LEFT JOIN usuarios u ON i.id_tecnico = u.id_usuario
    WHERE i.estado = 'completado'
    ORDER BY i.fecha_fin DESC
";

$stmt = $db->prepare($sql);
$stmt->execute();
$historial = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../assets/css/historial.css">

<div class="container historial-container py-4">
    <div class="text-center mb-4">
        <h2 class="text-primary fw-bold">
            <i class="bi bi-clock-history me-2"></i> Historial de incidencias
        </h2>
        <p class="text-muted">Consulta las incidencias ya finalizadas o que cambiaron de estado.</p>
    </div>
    <div class="card shadow-sm p-4 filtro-historial mb-4">

        <form class="row g-3">

            <div class="col-md-4">
                <label class="form-label fw-semibold">Año</label>
                <select class="form-select" name="year">
                    <option value="">Todos</option>
                    <option>2025</option>
                    <option>2024</option>
                    <option>2023</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">Mes</label>
                <select class="form-select" name="month">
                    <option value="">Todos</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary w-100 fw-semibold">
                    <i class="bi bi-funnel-fill me-1"></i> Filtrar
                </button>
            </div>

        </form>

    </div>


    <div class="table-responsive">
        <table class="table table-hover tabla-historial shadow-sm align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Incidencia</th>
                    <th>Casa</th>
                    <th>Estado</th>
                    <th>Técnico</th>
                    <th>Fecha inicio</th>
                    <th>Fecha fin</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($historial)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            No hay incidencias en el historial.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($historial as $h): ?>
                        <tr>
                            <td><?= htmlspecialchars($h['titulo']) ?></td>
                            <td><?= htmlspecialchars($h['casa'] ?? 'Sin casa') ?></td>

                            <td>
                                <span class="badge bg-success">
                                    <?= htmlspecialchars($h['estado']) ?>
                                </span>
                            </td>

                            <td><?= htmlspecialchars($h['tecnico'] ?? '—') ?></td>

                            <td><?= date('Y-m-d H:i', strtotime($h['fecha_inicio'])) ?></td>
                            <td><?= $h['fecha_fin'] ? date('Y-m-d H:i', strtotime($h['fecha_fin'])) : '—' ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<?php include_once '../includes/footer.php'; ?>