<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-4">

    <h2>Editar proyecto</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/proyecto/update/<?= $proyecto->proyecto_id ?>" method="POST" class="mt-3">

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="<?= $proyecto->titulo ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control"><?= $proyecto->descripcion ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha inicio</label>
            <input type="text" class="form-control" value="<?= $proyecto->fecha_inicio ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha fin</label>
            <input type="text" class="form-control" value="<?= $proyecto->fecha_fin ?? '—' ?>" readonly>
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="<?= BASE_URL ?>/proyecto" class="btn btn-secondary">Cancelar</a>

    </form>

</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>