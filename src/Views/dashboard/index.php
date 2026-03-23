<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-4">

    <h2>Dashboard</h2>

    <!-- BLOQUE 1: TAREAS ASIGNADAS -->
    <h4 class="mt-4">Mis tareas asignadas</h4>

    <?php if ($tareasAsignadas->isEmpty()): ?>
        <div class="alert alert-info">No tienes tareas asignadas.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>Tarea</th>
                    <th>Proyecto</th>
                    <th>Estado</th>
                    <th>Comentarios</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tareasAsignadas as $t): ?>
                    <tr>
                        <td><?= $t->titulo ?></td>
                        <td><?= $t->proyecto->titulo ?></td>

                        <td>
                            <?php if ($t->estado_id == 1): ?>
                                <span class="badge bg-secondary">Pendiente</span>
                            <?php elseif ($t->estado_id == 2): ?>
                                <span class="badge bg-warning text-dark">En progreso</span>
                            <?php else: ?>
                                <span class="badge bg-success">Completada</span>
                            <?php endif; ?>
                        </td>

                   
                        <td class="comentario-wrap">
                            <div class="comentario-corto" id="comentario-<?= $t->tarea_id ?>">
                                <?= nl2br(htmlspecialchars($t->comentarios)) ?>
                            </div>

                            <?php if (strlen($t->comentarios) > 120): ?>
                                <span class="ver-mas" id="vermas-<?= $t->tarea_id ?>"
                                    onclick="toggleComentario(<?= $t->tarea_id ?>)">
                                    Ver más
                                </span>
                            <?php endif; ?>
                        </td>
                       

                        <td>
                            <a href="<?= BASE_URL ?>/tarea/edit/<?= $t->tarea_id ?>" class="btn btn-primary btn-sm">
                                Actualizar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>


    <!-- BLOQUE 2: PROYECTOS DONDE PARTICIPO -->
    <h4 class="mt-5">Proyectos en los que participo</h4>

    <?php if ($proyectosParticipa->isEmpty()): ?>
        <div class="alert alert-info">No participas en ningún proyecto.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>Proyecto</th>
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

                            <?php if ($p->usuario_id == $_SESSION['user_id']): ?>
                                <a href="<?= BASE_URL ?>/proyecto/edit/<?= $p->proyecto_id ?>" class="btn btn-warning btn-sm">
                                    Editar
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
