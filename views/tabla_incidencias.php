<?php
require_once '../config/Database.php';

$database = new Database();
$db = $database->conectar();

$filtroCasa       = $_GET['casa']       ?? '';
$filtroEstado     = $_GET['estado']     ?? '';
$filtroRelevancia = $_GET['relevancia'] ?? '';

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
if ($filtroCasa !== '')       { $sql .= " AND c.id_casa = :casa";          $parametros[':casa'] = $filtroCasa; }
if ($filtroEstado !== '')     { $sql .= " AND i.estado = :estado";        $parametros[':estado'] = $filtroEstado; }
if ($filtroRelevancia !== '') { $sql .= " AND i.relevancia = :relevancia";$parametros[':relevancia'] = $filtroRelevancia; }

$sql .= " ORDER BY i.fecha_inicio DESC";

$stmt = $db->prepare($sql);
foreach ($parametros as $k => $v) { $stmt->bindValue($k, $v); }
$stmt->execute();
$incidencias = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($incidencias)) {
    echo '<tr><td colspan="8" class="text-center text-muted py-4">No hay incidencias registradas.</td></tr>';
    exit;
}

foreach ($incidencias as $i) {
    echo "<tr>
        <td>{$i['id_incidencia']}</td>
        <td>".htmlspecialchars($i['titulo'])."</td>
        <td>".($i['casa_nombre'] ?? 'Sin casa')."</td>
        <td>".($i['habitacion_numero'] ?? '—')."</td>
        
        <td><span class='badge bg-".match ($i['relevancia']) {
            'alto'  => 'danger',
            'medio' => 'warning text-dark',
            'bajo'  => 'success',
            default => 'secondary'
        }."'>".ucfirst($i['relevancia'] ?? '—')."</span></td>
        
        <td><span class='badge bg-".match ($i['estado']) {
            'no_atendido' => 'secondary',
            'en_proceso'  => 'warning text-dark',
            'completado'  => 'success',
            default       => 'light text-dark'
        }."'>".str_replace('_', ' ', ucfirst($i['estado']))."</span></td>
        
        <td>".date('Y-m-d', strtotime($i['fecha_inicio']))."</td>
        <td class='text-center'>
            <a href='detalle_incidencia.php?id={$i['id_incidencia']}' class='btn btn-sm btn-info text-white me-1'>
                <i class='bi bi-eye'></i>
            </a>
        </td>
    </tr>";
}
