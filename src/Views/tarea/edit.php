<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-4">

    <h2>Editar tarea del proyecto: <?= $proyecto->titulo ?></h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/tarea/update/<?= $tarea->tarea_id ?>" method="POST" class="mt-3">

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="<?= $tarea->titulo ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control"><?= $tarea->descripcion ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Comentarios</label>
            <textarea name="comentarios" class="form-control"><?= $tarea->comentarios ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="estado_id" class="form-select" required>
                <?php foreach ($estados as $estado): ?>
                    <option value="<?= $estado->estado_id ?>" <?= $estado->estado_id == $tarea->estado_id ? 'selected' : '' ?>>
                        <?= $estado->nombre ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <small class="text-muted">Cambiar el estado actualizará automáticamente el estado del proyecto.</small>
        </div>

        <button class="btn btn-primary">Actualizar tarea</button>
        <a href="<?= BASE_URL ?>/tarea/index/<?= $proyecto->proyecto_id ?>" class="btn btn-secondary">Cancelar</a>

    </form>

</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>