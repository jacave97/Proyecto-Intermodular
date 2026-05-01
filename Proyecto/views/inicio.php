<?php include __DIR__ . "/../_header.php"; ?>

<section>
    <h2>Destinos disponibles</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>País</th>
                <th>Continente</th>
                <th>Descripción</th>
                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?><th>Acciones</th><?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($arrayDestinos)): ?>
                <tr><td colspan="5">No hay destinos registrados.</td></tr>
            <?php else: ?>
                <?php foreach ($arrayDestinos as $destino): ?>
                    <tr>
                        <td><strong><?= $destino->getNombre() ?></strong></td>
                        <td><?= $destino->getPais() ?></td>
                        <td><?= $destino->getContinente() ?></td>
                        <td><?= $destino->getDescripcion() ?></td>
                        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                            <td>
                                <a href="index.php?accion=editarDestino&id=<?= $destino->getIdDestino() ?>">Editar</a> | 
                                <a href="index.php?accion=borrarDestino&id=<?= $destino->getIdDestino() ?>">Borrar</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<hr>

<section>
    <h2>Guías Gastronómicas</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Título</th>
                <th>Destino</th>
                <th>Comentario</th>
                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?><th>Acciones</th><?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($guiasGastro)): ?>
                <tr><td colspan="4">No hay guías gastronómicas todavía.</td></tr>
            <?php else: ?>
                <?php foreach ($guiasGastro as $guia): ?>
                    <tr>
                        <td><?= $guia['Titulo'] ?></td>
                        <td><?= $guia['nombre_destino'] ?></td>
                        <td><?= $guia['Comentario'] ?></td>
                        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                            <td>
                                <a href="index.php?accion=editarGuia&id=<?= $guia['Id_guias'] ?>">Editar</a> | 
                                <a href="index.php?accion=borrarGuia&id=<?= $guia['Id_guias'] ?>">Borrar</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>Guías de Ruta</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Título</th>
                <th>Destino</th>
                <th>Comentario</th>
                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?><th>Acciones</th><?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($guiasRutas)): ?>
                <tr><td colspan="4">No hay guías de ruta todavía.</td></tr>
            <?php else: ?>
                <?php foreach ($guiasRutas as $guia): ?>
                    <tr>
                        <td><?= $guia['Titulo'] ?></td>
                        <td><?= $guia['nombre_destino'] ?></td>
                        <td><?= $guia['Comentario'] ?></td>
                        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                            <td>
                                <a href="index.php?accion=editarGuia&id=<?= $guia['Id_guias'] ?>">Editar</a> | 
                                <a href="index.php?accion=borrarGuia&id=<?= $guia['Id_guias'] ?>">Borrar</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<?php include __DIR__ . "/../_footer.php"; ?>