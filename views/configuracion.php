<!-- Todavía no terminada -->
<?php
include_once '../includes/header.php';
include_once '../includes/auth.php'
?>

<link rel="stylesheet" href="../assets/css/configuracion.css">

<div class="container configuracion-container py-5">

    <h2 class="titulo-configuracion ">
        <i class="bi bi-gear-fill me-2"></i> Configuración de la cuenta
    </h2>

    <div class="card  p-4 mb-4">
        <h5 class="fw-bold mb-3">Información del usuario</h5>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" value="<?php echo $_SESSION['nombre'] ?? ''; ?>" disabled>
            </div>

            <div class="col-md-6">
                <label class="form-label">Rol</label>
                <input type="text" class="form-control" value="<?php echo $_SESSION['rol'] ?? ''; ?>" disabled>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" value="<?php echo $_SESSION['email'] ?? ''; ?>" disabled>
            </div>
        </div>

        <small class="text-muted">Estos datos no se pueden modificar desde la aplicación.</small>
    </div>

    <div class="card  p-4 mb-4">
        <h5 class="fw-bold mb-3">Cambiar contraseña</h5>

        <form>
            <div class="mb-3">
                <label class="form-label">Contraseña actual</label>
                <input type="password" class="form-control" placeholder="Introduce tu contraseña actual">
            </div>

            <div class="mb-3">
                <label class="form-label">Nueva contraseña</label>
                <input type="password" class="form-control" placeholder="Nueva contraseña">
            </div>

            <div class="mb-3">
                <label class="form-label">Repite la nueva contraseña</label>
                <input type="password" class="form-control" placeholder="Repite la contraseña">
            </div>

            <button type="submit" class="boton px-4">Guardar cambios</button>
        </form>
    </div>

    <div class="card preferencias p-4 mb-4">
        <h5 class="fw-bold mb-3">Preferencias</h5>

        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" id="notificaciones" checked>
            <label class="form-check-label" for="notificaciones">
                Recibir notificaciones de nuevas incidencias
            </label>
        </div>

        <div class="form-check ">
            <input class="form-check-input" type="checkbox" id="temaOscuro">
            <label class="form-check-label" for="temaOscuro">
                Activar modo oscuro (no implementado)
            </label>
        </div>

        <small class="text-muted">Estas preferencias se implementarán más tarde.</small>
    </div>

</div>

<?php include_once '../includes/footer.php'; ?>