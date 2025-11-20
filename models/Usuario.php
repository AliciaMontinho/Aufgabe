<?php

class Usuario {

    private $conn;
    private $table = "usuarios";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener usuario por email
    public function obtenerPorEmail($email) {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function actualizarPasswordHash($email, $nuevoHash) {
        $sql = "UPDATE {$this->table} SET password = :password WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":password", $nuevoHash);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
    }

  
    public function verificarUsuario($email, $password) {
        $usuario = $this->obtenerPorEmail($email);

        if (!$usuario) return false;

        $passBD = $usuario['password'];

        if (!password_get_info($passBD)['algo']) {
            if ($password === $passBD) {
                $nuevoHash = password_hash($password, PASSWORD_DEFAULT);
                $this->actualizarPasswordHash($email, $nuevoHash);  
                return $usuario;
            } else {
                return false; 
            }
        }

        if (password_verify($password, $passBD)) {
            return $usuario;
        }

        return false;
    }

    public function cambiarPassword($email, $nuevaPassword) {
        $nuevoHash = password_hash($nuevaPassword, PASSWORD_DEFAULT);
        $this->actualizarPasswordHash($email, $nuevoHash);
        return true;
    }
}
