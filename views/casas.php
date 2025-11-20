<?php
include_once '../includes/header.php';
include_once '../includes/auth.php';
require_once '../config/Database.php';

$database = new Database();
$db = $database->conectar();

$queryCasas = $db->query("SELECT * FROM casas");
$casas = $queryCasas->fetchAll(PDO::FETCH_ASSOC);

$idCasaSeleccionada = $_GET['id_casa'] ?? null;
$habitaciones = [];

if ($idCasaSeleccionada) {
    $stmt = $db->prepare("
    SELECT h.id_habitacion, h.numero, h.descripcion,
           IFNULL(COUNT(i.id_incidencia), 0) AS total_incidencias
    FROM habitaciones h
    LEFT JOIN incidencias i 
        ON h.id_habitacion = i.id_habitacion
    WHERE h.id_casa = :id_casa
    GROUP BY h.id_habitacion
    ORDER BY h.numero ASC");
    $stmt->bindParam(':id_casa', $idCasaSeleccionada, PDO::PARAM_INT);
    $stmt->execute();
    $habitaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $nombreCasa = $db->query("SELECT nombre FROM casas WHERE id_casa = $idCasaSeleccionada")->fetchColumn();
}
?>

<link rel="stylesheet" href="../assets/css/casas.css">

<div class="container py-4">
    <h1 class="fw-bold text-primary mb-4">Gestión de casas</h1>

    <div class="row g-4 mb-5">
        <?php foreach ($casas as $casa): ?>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5 class="fw-bold"><?= htmlspecialchars($casa['nombre']) ?></h5>
                        <p class="text-muted mb-1"><?= htmlspecialchars($casa['direccion']) ?></p>
                        <p class="mb-3"><i class="bi bi-telephone"></i> <?= htmlspecialchars($casa['telefono']) ?></p>
                        <a href="casas.php?id_casa=<?= $casa['id_casa'] ?>" class="btn btn-primary w-100">
                            Ver habitaciones
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if ($idCasaSeleccionada): ?>
        <h3 class="mb-3 text-secondary">Habitaciones en <?= htmlspecialchars($nombreCasa) ?></h3>

        <?php if (!empty($habitaciones)): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Número</th>
                            <th>Descripción</th>
                            <th>Incidencias</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($habitaciones as $h): ?>
                            <tr>
                                <td><?= htmlspecialchars($h['numero']) ?></td>
                                <td><?= htmlspecialchars($h['descripcion']) ?></td>
                                <td><?= $h['total_incidencias'] ?></td>
                                <td>
                                    <!-- El botón ver incidencias nos redirige al historial de incidencias -->
                                    <a href="historial.php?id_habitacion=<?= $h['id_habitacion'] ?>"
                                        class="btn btn-sm btn-outline-primary">
                                        Ver incidencias
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-muted">Esta casa no tiene habitaciones registradas.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php include_once '../includes/footer.php'; ?>