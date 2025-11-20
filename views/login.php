<!-- En funcionamiento -->
<?php include_once '../includes/header_login.php'; ?> 
<link rel="stylesheet" href="../assets/css/login.css">
<div class="contenedor ">
    <div class="card card-login shadow-lg p-5">
        <h3 class="text-center mb-4 text-primary fw-bold">Iniciar sesión</h3>

        <form action="../controller/UsuarioController.php?action=login" method="POST">

            <div class="mb-3">
                <!-- Si existe una cookie (Se ha seleccionado el campo recuerdam) rellenamos el campo email -->
                <label for="email" class="form-label">Correo electrónico:</label>
                <input type="email" name="email" class="form-control" id="email" value="<?php echo $_COOKIE['usuario_email'] ?? '' ?>">
                <div id="emailAviso" class="form-text">No compartiremos tus datos con externos.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="recuerdame" value="1" class="form-check-input" id="recuerdame">
                <label class="form-check-label" for="recuerdame">Recuérdame</label>
            </div>
            <button type="submit" class="btn btn-primary">Inicio</button>
        </form>

        <p class="mt-4 text-center fs-6">
            ¿No tienes cuenta?
            <a href="#" class="text-decoration-none fw-semibold">Contacta con el administrador</a>
        </p>
    </div>
</div>

<?php include_once '../includes/footer.php'; ?>