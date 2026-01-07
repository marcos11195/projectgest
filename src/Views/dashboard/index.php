<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-4">

    <h2>Mi Panel de Control</h2>

    <?php if ($proyectos->isEmpty()): ?>
        <div class="alert alert-info">No tienes proyectos creados.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>Proyecto</th>
                    <th>Tareas</th>
                    <th>Completadas</th>
                    <th>Pendientes</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proyectos as $p): ?>
                    <tr>
                        <td><?= $p->titulo ?></td>
                        <td><?= $p->total_tareas ?></td>
                        <td><?= $p->tareas_completadas ?></td>
                        <td><?= $p->tareas_pendientes ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>/proyecto/edit/<?= $p->proyecto_id ?>"
                                class="btn btn-warning btn-sm">Editar</a>
                            <a href="<?= BASE_URL ?>/tarea/index/<?= $p->proyecto_id ?>" class="btn btn-info btn-sm">Ver
                                tareas</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>