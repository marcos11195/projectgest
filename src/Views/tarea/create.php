<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-4">

    <h2>Nueva tarea para el proyecto:
        <?= $proyecto->titulo ?>
    </h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/tarea/store/<?= $proyecto->proyecto_id ?>" method="POST" class="mt-3">

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="estado_id" class="form-select" required>
                <?php foreach ($estados as $estado): ?>
                    <option value="<?= $estado->estado_id ?>">
                        <?= $estado->nombre ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Asignar a usuario</label>
            <select name="usuario_id" class="form-select">
                <?php foreach ($usuarios as $u): ?>
                    <option value="<?= $u->usuario_id ?>">
                        <?= $u->nombre ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button class="btn btn-success">Guardar tarea</button>
        <a href="<?= BASE_URL ?>/tarea/index/<?= $proyecto->proyecto_id ?>" class="btn btn-secondary">Cancelar</a>

    </form>

</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>