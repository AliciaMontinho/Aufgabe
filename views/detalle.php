<?php include_once '../../includes/header.php'; ?>

<link rel="stylesheet" href="../../assets/css/historial_detalle.css">

<div class="container mt-5 detalle-incidencia">
    
    <!-- Botón volver -->
    <a href="historial.php" class="btn btn-outline-primary mb-3">
        <i class="bi bi-arrow-left"></i> Volver al historial
    </a>

    <!-- Título -->
    <h2 class="fw-bold text-primary mb-4">
        <i class="bi bi-file-earmark-text me-2"></i>
        Detalle de la incidencia
    </h2>

    <!-- Tarjeta principal -->
    <div class="card shadow-sm p-4 mb-4">

        <h4 class="fw-bold mb-3">Información de la incidencia</h4>

        <div class="row mb-3">
            <div class="col-md-6">
                <p class="text-muted mb-1">Título</p>
                <p class="fs-5">Cama eléctrica no sube</p>
            </div>

            <div class="col-md-6">
                <p class="text-muted mb-1">Casa</p>
                <p class="fs-5">Seefeld</p>
            </div>
        </div>

        <div class="mb-3">
            <p class="text-muted mb-1">Descripción</p>
            <p class="fs-6">
                El motor no responde al intentar subir la cama.
            </p>
        </div>

        <div class="row">
            <div class="col-md-4">
                <p class="text-muted mb-1">Prioridad</p>
                <span class="badge bg-danger">Alta</span>
            </div>

            <div class="col-md-4">
                <p class="text-muted mb-1">Estado actual</p>
                <span class="badge bg-warning text-dark">En proceso</span>
            </div>

            <div class="col-md-4">
                <p class="text-muted mb-1">Técnico asignado</p>
                <p class="fs-6">Jonas Keller</p>
            </div>
        </div>
    </div>

    <!-- HISTORIAL DE CAMBIOS -->
    <div class="card shadow-sm p-4 mb-5">

        <h4 class="fw-bold mb-3">Historial de cambios</h4>

        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>Estado previo</th>
                    <th>Estado nuevo</th>
                    <th>Fecha cambio</th>
                    <th>Técnico</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><span class="badge bg-secondary">No atendido</span></td>
                    <td><span class="badge bg-warning text-dark">En proceso</span></td>
                    <td>2025-01-10 10:12</td>
                    <td>Lena Schmidt</td>
                </tr>

                <tr>
                    <td><span class="badge bg-warning text-dark">En proceso</span></td>
                    <td><span class="badge bg-success">Completado</span></td>
                    <td>2025-01-12 14:33</td>
                    <td>Jonas Keller</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<?php include_once '../../includes/footer.php'; ?>
