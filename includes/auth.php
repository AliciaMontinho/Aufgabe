<?php
// Iniciar sesión solo si no hay una sesión activa (evita warnings por reiniciar)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
?>

