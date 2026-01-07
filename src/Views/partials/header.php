<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>ProjectGest</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?= BASE_URL ?>/proyectos">ProjectGest</a>

            <?php if (!empty($_SESSION['user_id'])): ?>
                <a href="<?= BASE_URL ?>/auth/logout" class="btn btn-danger btn-sm">Cerrar sesión</a>
            <?php endif; ?>
        </div>
    </nav>