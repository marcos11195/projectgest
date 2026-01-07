<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-4">

    <h2>Crear proyecto</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/proyecto/store" method="POST" class="mt-3">

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="<?= BASE_URL ?>/proyecto" class="btn btn-secondary">Cancelar</a>

    </form>

</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>