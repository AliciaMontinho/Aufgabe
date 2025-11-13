<?php
require_once '../config/Database.php';
require_once '../models/Incidencia.php';
require_once '../includes/auth.php';

class IncidenciaController {
    private $db;
    private $incidenciaModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->conectar();
        $this->incidenciaModel = new Incidencia($this->db);
    }

    public function nueva() {
        include '../views/nueva_incidencia.php';
    }

public function guardar($datos) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    //verificamos si hay un usuario logeado
    if (isset($_SESSION['usuario_id'])) {
        $datos['id_creador'] = $_SESSION['usuario_id'];
    } else {
        //si no lo hay nos devuelve al login
        header("Location: ../views/login.php");
        exit;
    }

    if (empty($datos['estado'])) $datos['estado'] = 'no_atendido';
    if (empty($datos['relevancia'])) $datos['relevancia'] = 'media';

    $ok = $this->incidenciaModel->crearIncidencia($datos);

   if ($ok) {
        header("Location: ../views/nueva_incidencia.php?exito=1");
        exit;
    } else {
        echo "<div class='alert alert-danger text-center mt-3'>Error al crear la incidencia.</div>";
    }
}

    public function exito() {
        echo "<div class='container mt-5'>
                <div class='alert alert-success text-center'>
                     Incidencia creada correctamente.
                </div>
              </div>";
    }

    public function habitacionesPorCasa($id_casa) {
        header('Content-Type: application/json');
        $habitaciones = $this->incidenciaModel->obtenerHabitacionesPorCasa($id_casa);
        echo json_encode($habitaciones);
    }
}

$controller = new IncidenciaController();
$action = $_GET['action'] ?? 'nueva';

switch ($action) {
    case 'nueva':
        $controller->nueva();
        break;
    case 'guardar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->guardar($_POST);
        }
        break;
    case 'habitaciones':
        if (isset($_GET['id_casa'])) {
            $controller->habitacionesPorCasa($_GET['id_casa']);
        }
        break;
    case 'exito':
        $controller->exito();
        break;
    default:
        $controller->nueva();
        break;
}
?>
