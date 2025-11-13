<?php include_once '../includes/header.php'; ?>
<link rel="stylesheet" href="../assets/css/dashboard.css">

<div class="container py-5">

    <h1 class="fw-bold text-primary mb-4">Gestión de Casas</h1>
    <p class="text-muted fs-5 mb-5">Consulta las casas disponibles y sus habitaciones.</p>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="fw-bold">Kronenhof</h5>
                    <p class="text-muted mb-1">Calle Hauptstrasse 12, Zürich</p>
                    <p class="mb-3"><i class="bi bi-telephone"></i> +41 44 123 4567</p>
                    <a href="#" class="btn btn-primary w-100">Ver habitaciones</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="fw-bold">Seefeld</h5>
                    <p class="text-muted mb-1">Avenida Zürichsee 45, Zürich</p>
                    <p class="mb-3"><i class="bi bi-telephone"></i> +41 44 987 6543</p>
                    <a href="#" class="btn btn-primary w-100">Ver habitaciones</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="fw-bold">Seeheim</h5>
                    <p class="text-muted mb-1">Bahnhofstrasse 78, Zürich</p>
                    <p class="mb-3"><i class="bi bi-telephone"></i> +41 44 654 3210</p>
                    <a href="#" class="btn btn-primary w-100">Ver habitaciones</a>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h3 class="text-secondary mb-3">Habitaciones en Kronenhof</h3>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Número</th>
                        <th>Descripción</th>
                        <th>Incidencias</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>101</td>
                        <td>Habitación doble con cama eléctrica</td>
                        <td>3</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-outline-primary">Ver incidencias</a>
                        </td>
                    </tr>
                    <tr>
                        <td>102</td>
                        <td>Habitación individual</td>
                        <td>1</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-outline-primary">Ver incidencias</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php include_once '../includes/footer.php'; ?>
