<?php
require_once '../config/Database.php';

$database = new Database();
$db = $database->conectar();

$casa = $_GET['casa'] ?? '';
$ano  = $_GET['ano']  ?? '';
$mes  = $_GET['mes']  ?? '';

$sql = "
    SELECT i.titulo, i.fecha_inicio, i.fecha_fin, i.estado,
           h.numero AS habitacion,
           u.nombre AS tecnico,
           c.nombre AS casa
    FROM incidencias i
    LEFT JOIN habitaciones h ON i.id_habitacion = h.id_habitacion
    LEFT JOIN casas c ON h.id_casa = c.id_casa
    LEFT JOIN usuarios u ON i.id_tecnico = u.id_usuario
    WHERE i.estado = 'completado'
";

$parametros = [];
if ($casa !== '') { $sql .= " AND c.id_casa = :casa"; $parametros[':casa'] = $casa; }
if ($ano !== '')  { $sql .= " AND YEAR(i.fecha_fin) = :ano"; $parametros[':ano'] = $ano; }
if ($mes !== '')  { $sql .= " AND MONTH(i.fecha_fin) = :mes"; $parametros[':mes'] = $mes; }

$sql .= " ORDER BY i.fecha_fin DESC";

$stmt = $db->prepare($sql);
foreach ($parametros as $key => $value) {
    $stmt->bindValue($key, $value);
}
$stmt->execute();
$historial = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($historial)) {
    echo "<tr><td colspan='7' class='text-center py-4 text-muted'>No hay incidencias finalizadas.</td></tr>";
    exit;
}

foreach ($historial as $h) {
    echo "
        <tr>
            <td>".htmlspecialchars($h['titulo'])."</td>
            <td>".htmlspecialchars($h['casa'] ?? '—')."</td>
            <td>".htmlspecialchars($h['habitacion'] ?? '—')."</td>
            <td><span class='badge bg-success'>".htmlspecialchars($h['estado'])."</span></td>
            <td>".htmlspecialchars($h['tecnico'] ?? '—')."</td>
            <td>".date('Y-m-d H:i', strtotime($h['fecha_inicio']))."</td>
            <td>".($h['fecha_fin'] ? date('Y-m-d H:i', strtotime($h['fecha_fin'])) : '—')."</td>
        </tr>
    ";
}
