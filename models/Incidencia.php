<?php
class Incidencia
{
    private $conn;
    private $table = "incidencias";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Crear nueva incidencia (sin técnico todavía)
    public function crearIncidencia($datos)
    {
        $sql = "INSERT INTO " . $this->table . " 
                (titulo, descripcion, relevancia, estado, fecha_inicio, id_habitacion, id_creador)
                VALUES (:titulo, :descripcion, :relevancia, :estado, NOW(), :id_habitacion, :id_creador)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':titulo', $datos['titulo']);
        $stmt->bindParam(':descripcion', $datos['descripcion']);
        $stmt->bindParam(':relevancia', $datos['relevancia']);
        $stmt->bindParam(':estado', $datos['estado']);
        $stmt->bindParam(':id_habitacion', $datos['id_habitacion']);
        $stmt->bindParam(':id_creador', $datos['id_creador']);

        return $stmt->execute();
    }

    //Obtener habitaciones según la casa seleccionada
    public function obtenerHabitacionesPorCasa($id_casa)
    {
        $sql = "SELECT id_habitacion, numero AS etiqueta
            FROM habitaciones
            WHERE id_casa = :id_casa
            ORDER BY numero";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_casa', $id_casa);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
