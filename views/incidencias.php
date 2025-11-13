<!-- Codificado pero no todavía en funcionamiento -->
<?php include_once '../includes/header.php'; ?>
<link rel="stylesheet" href="../assets/css/incidencias.css">


<div class="container incidencias-container py-4">

    <div class="contenedor-boton">
        <h2 class="text-primary fw-bold">
            <i class="bi bi-exclamation-octagon-fill me-2"></i> Incidencias
        </h2>
        <a href="nueva_incidencia.php" class="btn btn-nueva-incidencia">
            <i class="bi bi-plus-circle me-1"></i>Nueva incidencia
        </a>
    </div>

    <!-- FILTROS -->
    <div class="card shadow-sm p-3 mb-4 filtro-incidencias">
        <form class="row g-3">

            <div class="col-md-3">
                <label class="form-label fw-semibold">Casa</label>
                <select class="form-select">
                    <option value="">Todas</option>
                    <option value="1">Kronenhof</option>
                    <option value="2">Seefeld</option>
                    <option value="3">Seeheim</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Estado</label>
                <select class="form-select">
                    <option value="">Todos</option>
                    <option value="no_atendido">No atendido</option>
                    <option value="en_proceso">En proceso</option>
                    <option value="completado">Completado</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Relevancia</label>
                <select class="form-select">
                    <option value="">Todas</option>
                    <option value="alto">Alta</option>
                    <option value="medio">Media</option>
                    <option value="bajo">Baja</option>
                </select>
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-outline-primary w-100">
                    <i class="bi bi-funnel-fill me-1"></i> Filtrar
                </button>
            </div>

        </form>
    </div>

    <!-- LISTADO -->
    <div class="table-responsive">
        <table class="table table-hover tabla-incidencias align-middle shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Casa</th>
                    <th>Habitación</th>
                    <th>Relevancia</th>
                    <th>Estado</th>
                    <th>Fecha inicio</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                <!-- EJEMPLO — Cuando conectes backend esto se generará dinámico -->
                <tr>
                    <td>1</td>
                    <td>Cama eléctrica no sube</td>
                    <td>Seefeld</td>
                    <td>201</td>
                    <td><span class="badge bg-danger">Alta</span></td>
                    <td><span class="badge bg-warning text-dark">En proceso</span></td>
                    <td>2025-01-12</td>
                    <td class="text-center">
                        <a href="detalle_incidencia.php?id=1" class="btn btn-sm btn-info text-white me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="editar_incidencia.php?id=1" class="btn btn-sm btn-warning text-white">
                            <i class="bi bi-pencil"></i>
                        </a>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>Luz fundida en baño</td>
                    <td>Kronenhof</td>
                    <td>101</td>
                    <td><span class="badge bg-warning text-dark">Media</span></td>
                    <td><span class="badge bg-secondary">No atendido</span></td>
                    <td>2025-01-10</td>
                    <td class="text-center">
                        <a href="#" class="btn btn-sm btn-info text-white me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-warning text-white">
                            <i class="bi bi-pencil"></i>
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

</div>

<?php include_once '../includes/footer.php'; ?>
