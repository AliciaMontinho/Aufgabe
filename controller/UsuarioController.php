<?php
require_once '../config/Database.php';
require_once '../models/Usuario.php';

class UsuarioController
{

    private $db;
    private $usuarioModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->conectar();
        $this->usuarioModel = new Usuario($this->db);
    }

    // Procesar login
    public function login($email, $password)
    {
        $usuario = $this->usuarioModel->verificarUsuario($email, $password);

        if ($usuario) {
            session_start();
            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['rol'] = $usuario['rol'];
            $_SESSION['email'] = $usuario['email'];

            //Guardar datos
            if (!empty($_POST['recuerdame'])) {
                setcookie("usuario_email", $email, time() + (86400 * 30), "/");
            } else {
                setcookie("usuario_email", "", time() - 3600, "/");
            }

            header("Location: ../views/dashboard.php");
            exit;
        } else {
            header("Location: ../views/login.php?error=1");
            exit;
        }
    }


     public function cambiarPassword()
    {
        session_start();
        $email = $_SESSION['email'];

        $actual = $_POST['password_actual'] ?? '';
        $nueva = $_POST['password_nueva'] ?? '';
        $repetir = $_POST['password_repetir'] ?? '';

    
        if (empty($actual) || empty($nueva) || empty($repetir)) {
            header("Location: ../views/configuracion.php?error=campos_vacios");
            exit;
        }

        if ($nueva !== $repetir) {
            header("Location: ../views/configuracion.php?error=no_coinciden");
            exit;
        }

       
        $usuario = $this->usuarioModel->obtenerPorEmail($email);
        if (!$usuario || !password_verify($actual, $usuario['password'])) {
            header("Location: ../views/configuracion.php?error=incorrecta");
            exit;
        }

        $ok = $this->usuarioModel->cambiarPassword($email, $nueva);
        if ($ok) {
            header("Location: ../views/configuracion.php?ok=1");
        } else {
            header("Location: ../views/configuracion.php?error=bd");
        }
        exit;
    }

    // Cerrar sesión
    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: ../views/login.php");
        exit;
    }
}

// Router sencillo
$action = $_GET['action'] ?? '';

$controller = new UsuarioController();

if ($action === 'login') {
    $controller->login($_POST['email'], $_POST['password']);
} elseif ($action === 'logout') {
    $controller->logout();
} elseif ($action === 'cambiarPassword') {
    $controller->cambiarPassword();
}
