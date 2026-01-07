<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php foreach ($usuarios as $usuario): ?>
        <p>Usuario: <?= htmlspecialchars($usuario->nombre) ?> - Email: <?= htmlspecialchars($usuario->email) ?></p>
    <?php endforeach; ?>
    <?php if (!empty($_SESSION['user_id'])): ?>
        <a href="<?= BASE_URL ?>/auth/logout" class="btn btn-danger">Cerrar sesión</a>
    <?php endif; ?>

</body>

</html>