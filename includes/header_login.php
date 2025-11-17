<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aufgabe - Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/header_login.css">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm3">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        
        <a class="navbar-brand logo_login d-flex align-items-center" href="../views/login.php">
            <img src="../assets/img/logo.svg" alt="Logo Aufgabe" 
                 class="img-fluid">
        </a>

        <!-- Menú desplegable -->
        <div class="dropdown">
            <button class="btn btn-link text-white p-0" id="menuDropdown" 
                    data-bs-toggle="dropdown" aria-expanded="false" 
                    style="border:0; background:transparent;">
                
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" 
                     class="bi bi-list menu-icon" viewBox="0 0 16 16"
                     width="36" height="36">
                    <path fill-rule="evenodd" 
                          d="M2.5 12a.5.5 0 010-1h11a.5.5 0 010 1h-11zm0-4a.5.5 0 010-1h11a.5.5 0 010 1h-11zm0-4a.5.5 0 010-1h11a.5.5 0 010 1h-11z"/>
                </svg>
            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="menuDropdown">
                <li><a class="dropdown-item" href="../views/politicas.php">Políticas</a></li>
                <li><a class="dropdown-item" href="../views/contacto.php">Contacto</a></li>
            </ul>
        </div>
    </div>
</nav>
