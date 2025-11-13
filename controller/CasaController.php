<?php
require_once '../config/Database.php';
require_once '../models/Casa.php';

class CasaController {
    private $db;
    private $casaModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->conectar();
        $this->casaModel = new Casa($this->db);
    }

    public function listarCasas() {
        return $this->casaModel->obtenerTodas();
    }

    public function verCasa($id_casa) {
        $casa = $this->casaModel->obtenerPorId($id_casa);
        $habitaciones = $this->casaModel->obtenerHabitacionesConIncidencias($id_casa);
        return ['casa' => $casa, 'habitaciones' => $habitaciones];
    }
}
