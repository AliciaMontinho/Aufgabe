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

    // Verificar usuario en login
    public function verificarUsuario($email, $password) {
        $usuario = $this->obtenerPorEmail($email);

        if (!$usuario) {
            return false;
        }

        // Contraseñas en tu BD NO están en hash, así que temporalmente:
        if ($password === $usuario['password']) {
            return $usuario;
        }

        // Si luego actualizas, deja esto:
        // if (password_verify($password, $usuario['password'])) { return $usuario; }

        return false;
    }
}
