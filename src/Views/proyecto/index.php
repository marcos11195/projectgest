<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-4">

    <h2>Proyectos personales</h2>

    <!-- BOTÓN DE CREAR PROYECTO -->
    <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
        <h4 class="m-0">Mis proyectos</h4>
        <a href="<?= BASE_URL ?>/proyecto/create" class="btn btn-primary">
            Crear proyecto
        </a>
    </div>

    <!-- BLOQUE 1: PROYECTOS CREADOS POR EL USUARIO -->
    <h5 class="mt-4">Proyectos creados por mí</h5>

    <?php if ($proyectosCreados->isEmpty()): ?>
        <div class="alert alert-info">No has creado ningún proyecto.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Estado</th>
                    <th>Fecha inicio</th>
                    <th>Fecha fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proyectosCreados as $p): ?>
                    <tr>
                        <td><?= $p->titulo ?></td>

                        <td>
                            <?php if ($p->fecha_fin === null): ?>
                                <span class="badge bg-warning text-dark">En curso</span>
                            <?php else: ?>
                                <span class="badge bg-success">Finalizado</span>
                            <?php endif; ?>
                        </td>

                        <td><?= $p->fecha_inicio ?></td>
                        <td><?= $p->fecha_fin ?? '—' ?></td>

                        <td>
                            <a href="<?= BASE_URL ?>/tarea/index/<?= $p->proyecto_id ?>" class="btn btn-info btn-sm">
                                Ver tareas
                            </a>

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


    <!-- BLOQUE 2: PROYECTOS DONDE PARTICIPO -->
    <h5 class="mt-5">Proyectos en los que participo</h5>

    <?php if ($proyectosParticipa->isEmpty()): ?>
        <div class="alert alert-info">No participas en ningún proyecto.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Estado</th>
                    <th>Fecha inicio</th>
                    <th>Fecha fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proyectosParticipa as $p): ?>
                    <tr>
                        <td><?= $p->titulo ?></td>

                        <td>
                            <?php if ($p->fecha_fin === null): ?>
                                <span class="badge bg-warning text-dark">En curso</span>
                            <?php else: ?>
                                <span class="badge bg-success">Finalizado</span>
                            <?php endif; ?>
                        </td>

                        <td><?= $p->fecha_inicio ?></td>
                        <td><?= $p->fecha_fin ?? '—' ?></td>

                        <td>
                            <a href="<?= BASE_URL ?>/tarea/index/<?= $p->proyecto_id ?>" class="btn btn-info btn-sm">
                                Ver tareas
                            </a>
                            <!-- No editar ni eliminar -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>