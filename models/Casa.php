<?php
class Casa {

    private $conn;
    private $table = "casas";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerTodas() {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id_casa) {
        $sql = "SELECT * FROM {$this->table} WHERE id_casa = :id_casa";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id_casa", $id_casa, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerHabitacionesConIncidencias($id_casa) {
        $sql = "SELECT h.id_habitacion, h.numero, h.descripcion,
                       COUNT(i.id_incidencia) AS total_incidencias
                FROM habitaciones h
                LEFT JOIN incidencias i ON h.id_habitacion = i.id_habitacion
                WHERE h.id_casa = :id_casa
                GROUP BY h.id_habitacion, h.numero, h.descripcion";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id_casa", $id_casa, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
