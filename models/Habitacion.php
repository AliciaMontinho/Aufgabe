<?php
require_once __DIR__ . '/../config/Database.php';

class Habitacion {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerPorCasa($id_casa) {
        $sql = "SELECT * FROM habitaciones WHERE id_casa = :id_casa ORDER BY numero ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_casa', $id_casa);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
