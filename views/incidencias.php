<?php
include_once '../includes/header.php';
require_once '../config/Database.php';
require_once '../includes/auth.php';

$database = new Database();
$db = $database->conectar();

$filtroCasa       = $_GET['casa']       ?? '';
$filtroEstado     = $_GET['estado']     ?? '';
$filtroRelevancia = $_GET['relevancia'] ?? '';

//solo incidencias no atendidas o en proceso
$sql = "
    SELECT i.id_incidencia, i.titulo, i.relevancia, i.estado, i.fecha_inicio,
           h.numero AS habitacion_numero,
           c.nombre AS casa_nombre
    FROM incidencias i
    LEFT JOIN habitaciones h ON i.id_habitacion = h.id_habitacion
    LEFT JOIN casas c ON h.id_casa = c.id_casa
    WHERE i.estado != 'completado'
";

$parametros = [];
if ($filtroCasa !== '') {
    $sql .= " AND c.id_casa = :casa";
    $parametros[':casa'] = $filtroCasa;
}

if ($filtroEstado !== '') {
    $sql .= " AND i.estado = :estado";
    $parametros[':estado'] = $filtroEstado;
}

if ($filtroRelevancia !== '') {
    $sql .= " AND i.relevancia = :relevancia";
    $parametros[':relevancia'] = $filtroRelevancia;
}

$sql .= " ORDER BY i.fecha_inicio DESC";

$stmt = $db->prepare($sql);
foreach ($parametros as $clave => $valor) {
    $stmt->bindValue($clave, $valor);
}
$stmt->execute();
$incidencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../assets/css/incidencias.css">

<div class="container incidencias-container py-4">

    <div class="contenedor-boton">
        <h2 class="text-primary fw-bold">
            <i class="bi bi-exclamation-octagon-fill me-2"></i> Incidencias
        </h2>
        <a href="nueva_incidencia.php" class="btn btn-nueva-incidencia">
            <i class="bi bi-plus-circle me-1"></i> Nueva incidencia
        </a>
    </div>

    <div class="card shadow-sm p-3 mb-4 filtro-incidencias">
        <form class="row g-3" method="GET" action="">

            <div class="col-md-3">
                <label class="form-label fw-semibold">Casa</label>
                <select name="casa" class="form-select">
                    <option value="">Todas</option>
                    <option value="1">Kronenhof</option>
                    <option value="2">Seefeld</option>
                    <option value="3">Seeheim</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Estado</label>
                <select name="estado" class="form-select">
                    <option value="">Todos</option>
                    <option value="no_atendido">No atendido</option>
                    <option value="en_proceso">En proceso</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Relevancia</label>
                <select name="relevancia" class="form-select">
                    <option value="">Todas</option>
                    <option value="alto">Alta</option>
                    <option value="medio">Media</option>
                    <option value="bajo">Baja</option>
                </select>
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-outline-primary w-100">
                    <i class="bi bi-funnel-fill me-1"></i> Filtrar
                </button>
            </div>

        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hover tabla-incidencias align-middle shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Casa</th>
                    <th>Habitación</th>
                    <th>Relevancia</th>
                    <th>Estado</th>
                    <th>Fecha inicio</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($incidencias)): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            No hay incidencias registradas.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($incidencias as $i): ?>
                        <tr>
                            <td><?= $i['id_incidencia'] ?></td>
                            <td><?= htmlspecialchars($i['titulo']) ?></td>
                            <td><?= $i['casa_nombre'] ?? 'Sin casa' ?></td>
                            <td><?= $i['habitacion_numero'] ?? '—' ?></td>

                            <td>
                                <?php
                                $badgeClass = match ($i['relevancia']) {
                                    'alto' => 'bg-danger',
                                    'medio' => 'bg-warning text-dark',
                                    'bajo' => 'bg-success',
                                    default => 'bg-secondary'
                                };
                                ?>
                                <span class="badge <?= $badgeClass ?>">
                                    <?= ucfirst($i['relevancia'] ?? '—') ?>
                                </span>
                            </td>

                            <td>
                                <?php
                                $estadoClass = match ($i['estado']) {
                                    'no_atendido' => 'bg-secondary',
                                    'en_proceso' => 'bg-warning text-dark',
                                    'completado' => 'bg-success',
                                    default => 'bg-light text-dark'
                                };
                                ?>
                                <span class="badge <?= $estadoClass ?>">
                                    <?= str_replace('_', ' ', ucfirst($i['estado'])) ?>
                                </span>
                            </td>

                            <td><?= date('Y-m-d', strtotime($i['fecha_inicio'])) ?></td>

                            <td class="text-center">
                                <a href="detalle_incidencia.php?id=<?= $i['id_incidencia'] ?>" class="btn btn-sm btn-info text-white me-1">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <!-- Monstrar el botón de editar incidencia solo si el rol del ususario en sesióin es técnico -->
                                <?php if ($_SESSION['rol'] === 'tecnico'): ?>
                                    <a href="editar_incidencia.php?id=<?= $i['id_incidencia'] ?>" class="btn btn-sm btn-warning text-white">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once '../includes/footer.php'; ?>