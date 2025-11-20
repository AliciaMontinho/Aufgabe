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
        // Consulta si el estado es completado yaque tenemos que guardar la fecha del fin
        //Se guarda siempre el último técnico que editó la incidencia
        if ($datos['estado'] === 'completado') {
            $sql = "UPDATE incidencias SET 
                titulo = :titulo,
                descripcion = :descripcion,
                relevancia = :relevancia,
                estado = :estado,
                id_habitacion = :id_habitacion,
                fecha_fin = NOW(),
                id_tecnico = :id_tecnico 
                WHERE id_incidencia = :id_incidencia";
        } else {
            $sql = "UPDATE incidencias SET 
                titulo = :titulo,
                descripcion = :descripcion,
                relevancia = :relevancia,
                estado = :estado,
                id_habitacion = :id_habitacion,
                id_tecnico = :id_tecnico
                WHERE id_incidencia = :id_incidencia";
        }

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':titulo', $datos['titulo']);
        $stmt->bindParam(':descripcion', $datos['descripcion']);
        $stmt->bindParam(':relevancia', $datos['relevancia']);
        $stmt->bindParam(':estado', $datos['estado']);
        $stmt->bindParam(':id_habitacion', $datos['id_habitacion'], PDO::PARAM_INT);
        $stmt->bindParam(':id_tecnico', $_SESSION['usuario_id'], PDO::PARAM_INT);

        $stmt->bindParam(':id_incidencia', $datos['id_incidencia'], PDO::PARAM_INT);

        return $stmt->execute();


        // $sql = "UPDATE incidencias 
        //     SET titulo = :titulo, 
        //         descripcion = :descripcion, 
        //         relevancia = :relevancia, 
        //         estado = :estado, 
        //         id_habitacion = :id_habitacion 
        //     WHERE id_incidencia = :id_incidencia";

        // $stmt = $this->conn->prepare($sql);
        // $stmt->bindParam(':titulo', $datos['titulo']);
        // $stmt->bindParam(':descripcion', $datos['descripcion']);
        // $stmt->bindParam(':relevancia', $datos['relevancia']);
        // $stmt->bindParam(':estado', $datos['estado']);
        // $stmt->bindParam(':id_habitacion', $datos['id_habitacion']);
        // $stmt->bindParam(':id_incidencia', $datos['id_incidencia']);

        // return $stmt->execute();
    }
}
