<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Mis proyectos</h2>
        <a href="<?= BASE_URL ?>/proyecto/create" class="btn btn-primary">Nuevo proyecto</a>
    </div>

    <?php if ($proyectos->isEmpty()): ?>
        <div class="alert alert-info">No tienes proyectos creados.</div>
    <?php else: ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Fecha inicio</th>
                    <th>Fecha fin</th>
                    <th>Tareas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proyectos as $p): ?>
                    <tr>
                        <td>
                            <?= $p->titulo ?>
                        </td>

                        <td>
                            <?= $p->descripcion ?>
                        </td>

                        <td>
                            <?php if ($p->fecha_fin === null): ?>
                                <span class="badge bg-warning text-dark">En curso</span>
                            <?php else: ?>
                                <span class="badge bg-success">Finalizado</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <?= $p->fecha_inicio ?>
                        </td>

                        <td>
                            <?= $p->fecha_fin ?? '—' ?>
                        </td>

                        <td>
                            <a href="<?= BASE_URL ?>/tarea/index/<?= $p->proyecto_id ?>" class="btn btn-info btn-sm">
                                Ver tareas
                            </a>
                        </td>

                        <td>
                            <a href="<?= BASE_URL ?>/proyecto/edit/<?= $p->proyecto_id ?>" class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <a href="<?= BASE_URL ?>/proyecto/delete/<?= $p->proyecto_id ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Seguro que quieres eliminar este proyecto?')">
                                Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>