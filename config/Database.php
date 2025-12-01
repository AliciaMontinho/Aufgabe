<?php
//llevamos el proyecto a internet
class Database {
    // private $host = "aufgabe.kesug.com";
    // private $dbname = "aufgabe_db";
    // private $username = "if0_40542270";
    // private $password = "PFinalODAW2";
    // private $conn;

    private $host = "localhost";
    private $dbname = "aufgabe_db";
    private $username = "root";
    private $password = ""; 
    private $conn;

    public function conectar() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8",
                $this->username,
                $this->password
            );
            //Excepción para controlar errores si es que la conexión falla
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }

        return $this->conn;
    }
}
?>
