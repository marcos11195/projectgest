<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Tareas del proyecto: <?= $proyecto->titulo ?></h2>
        <a href="<?= BASE_URL ?>/tarea/create/<?= $proyecto->proyecto_id ?>" class="btn btn-primary">
            Nueva tarea
        </a>
    </div>

    <?php if ($tareas->isEmpty()): ?>
        <div class="alert alert-info">Este proyecto no tiene tareas.</div>
    <?php else: ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Estado</th>
                    <th>Comentarios</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tareas as $t): ?>
                    <tr>
                        <td><?= $t->titulo ?></td>

                        <td>
                            <?php if ($t->estado_id == 1): ?>
                                <span class="badge bg-secondary">Pendiente</span>
                            <?php elseif ($t->estado_id == 2): ?>
                                <span class="badge bg-warning text-dark">En progreso</span>
                            <?php else: ?>
                                <span class="badge bg-success">Completada</span>
                            <?php endif; ?>
                        </td>

                        <td><?= $t->comentarios ?></td>

                        <td>
                            <a href="<?= BASE_URL ?>/tarea/edit/<?= $t->tarea_id ?>" class="btn btn-warning btn-sm">Editar</a>

                            <a href="<?= BASE_URL ?>/tarea/delete/<?= $t->tarea_id ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Seguro que quieres eliminar esta tarea?')">
                                Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="<?= BASE_URL ?>/proyecto" class="btn btn-secondary mt-3">Volver a proyectos</a>

</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>