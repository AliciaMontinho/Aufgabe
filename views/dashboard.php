<!-- En funcionamiento sin algunas opciones -->

<!-- Incluyo header.php general para todas las páginas excepto login -->
<?php include_once '../includes/header.php'; ?>
<!-- Se incluye hoja de estilos propia a cada página -->
<link rel="stylesheet" href="../assets/css/dashboard.css">
<!-- Incluimos la sesión -->
<?php include_once '../includes/auth.php'; ?>

<?php
require_once '../config/Database.php';

$database = new Database();
$db = $database->conectar();

// Consultas que uso para recoger datos de la  base y los situo en el epartado de resumen
$totalUrgentes = $db->query("SELECT COUNT(*) FROM incidencias WHERE relevancia = 'alto'")->fetchColumn();
$totalProceso = $db->query("SELECT COUNT(*) FROM incidencias WHERE estado = 'en_proceso'")->fetchColumn();
$totalNoAtendidas = $db->query("SELECT COUNT(*) FROM incidencias WHERE estado = 'no_atendido'")->fetchColumn();
$totalCompletadas = $db->query("SELECT COUNT(*) FROM incidencias WHERE estado = 'completado'")->fetchColumn();
//me interesa sacar la cuenta que tenbemos de las casa, es decir 3 por si en algún momento (hipoteticamente) se añade otra.
$totalCasas = $db->query("SELECT COUNT(*) FROM casas ")->fetchColumn();
?>


<div class="container-fluid bg-light min-vh-100">

    <div class="container-dashboard py-4">
        <h1 class="fw-bold text-primary">
            <!-- En la sesión guardamos el nombre que se recoge de la base de datos. -->
            Hola, <?= $_SESSION['nombre'] ?>.
        </h1>
        <p class="text-muted fs-5">
            Gestiona incidencias, consulta el historial y administra las casas.
        </p>

        <p class="text-muted fs-5">
            Tu rol es: <?= $_SESSION['rol'] ?>.
            <!-- Recordamos el rol ya que el rol va a hacer que los permisos en la app sean diferentes
            para el técnico y el trabajador, lo implementaré para la próxima entrega -->
        </p>
    </div>

    <!-- Diseño con Bootstrap, algunas clases dan estilos propios de Bootstrap a los elementos. -->
    <!-- Podemos personalizar nuestras clases para que mediante un archivo CSS podamos modificar los estilos a nuestro gusto -->
    <div class="container">
        <div class="row g-4">

            <?php if ($_SESSION['rol'] === 'trabajador'): ?>
                <!--Lo que verán los trabajadores -->
                <div class="col-md-4">
                    <div class="card card-incidencia shadow-sm border-0 dashboard-card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-plus-circle icono-incidencia text-warning" style="font-size:3rem;"></i>
                            <h4 class="mt-3 fw-semibold">Nueva incidencia</h4>
                            <p class="text-muted">Registra un nuevo problema rápidamente.</p>
                            <a href="nueva_incidencia.php" class="btn btn-warning boton-incidencia text-white w-100">Crear incidencia</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!--Lo que verán los técnicos -->
            <?php if ($_SESSION['rol'] === 'tecnico'): ?>
                <div class="col-md-4">
                    <div class="card card-incidencia shadow-sm border-0 dashboard-card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-eye-fill icono-incidencia text-warning" style="font-size:3rem;"></i>
                            <h4 class="mt-3 fw-semibold">Ver incidencias</h4>
                            <p class="text-muted">Gestiona las incidencias registradas.</p>
                            <a href="incidencias.php" class="btn  btn-warning boton-incidencia  text-white w-100">Ver incidencias</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            
            <div class="col-md-4">
                <div class="card shadow-sm border-0 dashboard-card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-journal-text text-primary" style="font-size:3rem;"></i>
                        <h4 class="mt-3 fw-semibold">Historial</h4>
                        <p class="text-muted">Consulta el registro completo de incidencias.</p>
                        <a href="historial.php" class="btn btn-primary w-100">Ver historial</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 dashboard-card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-building text-success" style="font-size:3rem;"></i>
                        <h4 class="mt-3 fw-semibold">Gestión de casas</h4>
                        <p class="text-muted">Administra las casas y sus habitaciones.</p>
                        <a href="casas.php" class="btn btn-success w-100">Ver casas</a>
                    </div>
                </div>
            </div>

        </div>
        <!-- Utilización de consultas anteriores para el resumen general -->
        <div class="mt-5">
            <h3 class="texto-secundario mb-3">Resumen general</h3>

            <div class="row g-4">

                <div class="col-md-3">
                    <div class="caja-resumen">
                        <i class="bi bi-exclamation-circle text-danger"></i>
                        <h4><?php echo $totalUrgentes ?></h4>
                        <p>Incidencias urgentes</p>
                    </div>
                </div>
                <?php if ($_SESSION['rol'] === 'trabajador'): ?>
                    <div class="col-md-3">
                        <div class="caja-resumen shadow-sm">
                            <i class="bi bi-hourglass-split text-warning"></i>
                            <h4><?php echo $totalProceso ?></h4>
                            <p>En proceso</p>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($_SESSION['rol'] === 'tecnico'): ?>
                    <div class="col-md-3">
                        <div class="caja-resumen shadow-sm">
                            <i class="bi bi-hourglass-split text-warning"></i>
                            <h4><?php echo $totalNoAtendidas ?></h4>
                            <p>No atendido</p>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-md-3">
                    <div class="caja-resumen shadow-sm">
                        <i class="bi bi-check-circle text-success"></i>
                        <h4><?php echo $totalCompletadas ?></h4>
                        <p>Completadas</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="caja-resumen shadow-sm">
                        <i class="bi bi-house text-primary"></i>
                        <h4><?php echo $totalCasas ?></h4>
                        <p>Casas activas</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<!--Mejoras dinámicas de la página principal con js :) -->

<?php if ($totalUrgentes > 0): ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Reutilizo toast.js
            mostrarToast("¡Hay <?= $totalUrgentes ?> incidencias URGENTES!", "warning");
        });
    </script>
<?php endif; ?>
<!-- Reutilizo toast.js -->
<script src="../assets/js/toast.js"></script>
<script src="../assets/js/dashboard.js"></script>
<?php include_once '../includes/footer.php'; ?>