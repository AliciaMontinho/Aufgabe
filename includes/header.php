<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aufgabe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <?php include_once '../includes/auth.php'; ?>
    <script>
    (function () {
        //lLeer cookie si existe
        const cookieDark = document.cookie.split("; ").find(row => row.startsWith("modoOscuro="));
        const cookieValue = cookieDark ? cookieDark.split("=")[1] : null;

        //Si hay cookiesincronizamos con localStorage
        if (cookieValue === "true") {
            localStorage.setItem("temaOscuro", "true");
        }

        //Aplicar dark-mode si está activado
        if (localStorage.getItem("temaOscuro") === "true") {
            document.documentElement.classList.add("dark-mode");
        }
    })();
</script>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container-fluid">


            <a class="navbar-brand logo_general d-flex align-items-center" href="../views/dashboard.php">
                <img src="../assets/img/logo.svg" alt="Logo" class="me-2">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../views/dashboard.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="../views/incidencias.php">Incidencias</a></li>
                    <li class="nav-item"><a class="nav-link" href="../views/historial.php">Historial</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-4"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li class="dropdown-header">
                                <strong><?php echo $_SESSION['nombre'] ?? 'Usuario'; echo $_SESSION['apellido'] ?? 'Apellido';  ?></strong><br>
                                <small class="text-muted"><?php echo $_SESSION['rol'] ?? 'rol'; ?></small>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li><a class="dropdown-item" href="../views/configuracion.php">
                                    <i class="bi bi-gear me-2"></i> Configuración de cuenta
                                </a></li>

                            <li><a class="dropdown-item" href="../views/politicas.php">
                                    <i class="bi bi-shield-check me-2"></i> Políticas
                                </a></li>

                            <li><a class="dropdown-item" href="../views/contacto.php">
                                    <i class="bi bi-envelope me-2"></i> Contacto
                                </a></li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item text-danger fw-bold"
                                    href="../views/logout.php">
                                    <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>