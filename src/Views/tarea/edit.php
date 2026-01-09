<?php require __DIR__ . '/../partials/header.php'; ?>

<?php
$esDueno = ($proyecto->usuario_id == $_SESSION['user_id']);
$esAsignado = ($tarea->usuario_id == $_SESSION['user_id']);
?>

<div class="container mt-4">

    <h2>Editar tarea del proyecto: <?= $proyecto->titulo ?></h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/tarea/update/<?= $tarea->tarea_id ?>" method="POST" class="mt-3">

        <?php if ($esDueno): ?>
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" value="<?= $tarea->titulo ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control"><?= $tarea->descripcion ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Asignar a usuario</label>
                <select name="usuario_id" class="form-select">
                    <?php foreach ($usuarios as $u): ?>
                        <option value="<?= $u->usuario_id ?>" <?= $u->usuario_id == $tarea->usuario_id ? 'selected' : '' ?>>
                            <?= $u->nombre ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="estado_id" class="form-select">
                <?php foreach ($estados as $estado): ?>
                    <option value="<?= $estado->estado_id ?>" <?= $estado->estado_id == $tarea->estado_id ? 'selected' : '' ?>>
                        <?= $estado->nombre ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <?php if ($esAsignado): ?>
            <div class="mb-3">
                <label class="form-label">Comentarios</label>
                <textarea name="comentarios" class="form-control"><?= $tarea->comentarios ?></textarea>
            </div>
        <?php endif; ?>

        <button class="btn btn-primary">Guardar cambios</button>
        <a href="<?= BASE_URL ?>/tarea/index/<?= $proyecto->proyecto_id ?>" class="btn btn-secondary">Cancelar</a>

    </form>

</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>