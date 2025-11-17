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

    public function obtenerHabitacionesPorCasa($id_casa)
    {
        $sql = "SELECT id_habitacion, numero AS numero
            FROM habitaciones
            WHERE id_casa = :id_casa
            ORDER BY numero";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_casa', $id_casa);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    //funciones para usar en editar_incidencia.php

    public function obtenerPorId($id)
    {
        $sql = "SELECT * FROM incidencias WHERE id_incidencia = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarIncidencia($datos)
    {
        $sql = "UPDATE incidencias 
            SET titulo = :titulo, 
                descripcion = :descripcion, 
                relevancia = :relevancia, 
                estado = :estado, 
                id_habitacion = :id_habitacion 
            WHERE id_incidencia = :id_incidencia";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':titulo', $datos['titulo']);
        $stmt->bindParam(':descripcion', $datos['descripcion']);
        $stmt->bindParam(':relevancia', $datos['relevancia']);
        $stmt->bindParam(':estado', $datos['estado']);
        $stmt->bindParam(':id_habitacion', $datos['id_habitacion']);
        $stmt->bindParam(':id_incidencia', $datos['id_incidencia']);

        return $stmt->execute();
    }
}
