<?php
//llevamos el proyecto a internet
// https://aufgabepf.wuaze.com/Aufgabe/views/login.php
class Database {
    // private $host = "sql100.infinityfree.com";
    // private $dbname = "if0_40574917_aufgabe_db";
    // private $username = "if0_40574917";
    // private $password = "FWhG3PJ8lK1";
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
            echo "Conexión exitosa a la base de datos.";
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }

        return $this->conn;
    }
}
?>
