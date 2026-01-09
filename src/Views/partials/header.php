<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProjectGest</title>

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- BOOTSTRAP ICONS (opcional pero recomendado) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .comentario-wrap {
            white-space: normal !important;
            word-wrap: break-word !important;
            max-width: 350px;
        }

        .comentario-corto {
            max-height: 60px;
            overflow: hidden;
        }

        .ver-mas {
            cursor: pointer;
            color: #0d6efd;
            font-size: 0.9rem;
        }
    </style>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">

            <a class="navbar-brand" href="<?= BASE_URL ?>/">ProjectGest</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/">Gestor</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/proyecto">Proyectos Personales</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/proyecto/create">Crear proyecto</a>
                    </li>

                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="<?= BASE_URL ?>/auth/logout">Cerrar sesión</a>
                    </li>
                </ul>

            </div>

        </div>
    </nav>