<?php include_once '../../includes/header.php'; ?>

<link rel="stylesheet" href="../../assets/css/historial.css">

<div class="container historial-container py-4">

    <!-- Título -->
    <div class="text-center mb-4">
        <h2 class="text-primary fw-bold">
            <i class="bi bi-clock-history me-2"></i> Historial de incidencias
        </h2>
        <p class="text-muted">Consulta las incidencias ya finalizadas o que cambiaron de estado.</p>
    </div>

    <!-- FILTROS -->
    <div class="card shadow-sm p-4 filtro-historial mb-4">

        <form class="row g-3">

            <div class="col-md-4">
                <label class="form-label fw-semibold">Año</label>
                <select class="form-select" name="year">
                    <option value="">Todos</option>
                    <option>2025</option>
                    <option>2024</option>
                    <option>2023</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">Mes</label>
                <select class="form-select" name="month">
                    <option value="">Todos</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary w-100 fw-semibold">
                    <i class="bi bi-funnel-fill me-1"></i> Filtrar
                </button>
            </div>

        </form>

    </div>


    <div class="table-responsive">
        <table class="table table-hover tabla-historial shadow-sm align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Incidencia</th>
                    <th>Casa</th>
                    <th>Estado nuevo</th>
                    <th>Estado previo</th>
                    <th>Técnico</th>
                    <th>Fecha cambio</th>
                </tr>
            </thead>

            <tbody>
                <!-- Estos casos son solo ejemplos para la visaulización, cuando haga la parte de back 
                 la tabla se cubrirá con datos de la base de datos. -->
                <tr>
                    <td>Cama eléctrica no sube</td>
                    <td>Seefeld</td>
                    <td><span class="badge bg-success">Completado</span></td>
                    <td><span class="badge bg-warning text-dark">En proceso</span></td>
                    <td>Jonas Keller</td>
                    <td>2025-01-12 14:33</td>
                </tr>

                <tr>
                    <td>Luz fundida baño 101</td>
                    <td>Kronenhof</td>
                    <td><span class="badge bg-warning text-dark">En proceso</span></td>
                    <td><span class="badge bg-secondary">No atendido</span></td>
                    <td>Lena Schmidt</td>
                    <td>2025-01-10 10:12</td>
                </tr>

            </tbody>
        </table>
    </div>

</div>

<?php include_once '../../includes/footer.php'; ?>
