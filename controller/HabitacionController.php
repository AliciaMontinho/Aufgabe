<?php
require_once '../config/Database.php';
require_once '../models/Habitacion.php';

$db = (new Database())->conectar();
$habitacionModel = new Habitacion($db);

if (!isset($_GET['id_casa'])) {
    echo json_encode([]);
    exit;
}

$id_casa = intval($_GET['id_casa']);
$habitaciones = $habitacionModel->obtenerPorCasa($id_casa);

header('Content-Type: application/json');
echo json_encode($habitaciones);
