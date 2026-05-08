<?php include __DIR__ . "/../_header.php"; ?>

<section>
    <h2>Reseñas de la comunidad</h2>

    <?php if (isset($_SESSION['usuario_id'])): ?>
        <div>
            <form action="index.php?accion=guardarReseña" method="POST">

                <label>Destino:</label><br>
                <select name="destino_id" required>
                    <option value="">-- Selecciona un destino --</option>
                    <?php if (!empty($arrayDestinos)): ?>
                        <?php foreach ($arrayDestinos as $destino): ?>
                            <option value="<?= $destino->getIdDestino() ?>">
                                <?= $destino->getNombre() ?> (<?= $destino->getPais() ?>)
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select><br><br>

                <label>Tu comentario:</label><br>
                <textarea name="comentario" rows="3" required placeholder="¿Qué te pareció este viaje?"></textarea><br><br>

                <label>Valoración:</label><br>
                <select name="valoracion" required>
                    <option value="5">5/5</option>
                    <option value="4">4/5</option>
                    <option value="3">3/5</option>
                    <option value="2">2/5</option>
                    <option value="1">1/5</option>
                </select><br><br>

                <button type="submit">Publicar Reseña</button>
            </form>
        </div>
    <?php else: ?>
        <p>
            Inicia sesión para compartir tu experiencia con la comunidad.
        </p>
    <?php endif; ?>
    <!-- FIN DEL FORMULARIO -->

        <br>
    <!-- TABLA DE RESEÑAS -->
    <?php if (empty($listaReseñas)): ?>
        <p>Parece que aún no hay reseñas publicadas.</p>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Viajero</th>
                    <th>Destino</th>
                    <th>Comentario</th>
                    <th>Valoración</th>
                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                        <th>Acciones</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($listaReseñas)): ?>
                    <tr>
                        <td colspan="5">No hay reseñas publicadas todavía.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($listaReseñas as $r): ?>
                        <tr>
                            <td><strong><?= $r['autor_nombre'] ?></strong></td>
                            <td><?= $r['nombre_destino'] ?></td>
                            <td><?= $r['Comentarios'] ?></td>
                            <td><?= $r['Valoración'] ?> / 5</td>

                            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                                <td>
                                    <a href="index.php?accion=editarReseña&id=<?= $r['Id_reseñas'] ?>">Editar</a> |
                                    <a href="index.php?accion=borrarReseña&id=<?= $r['Id_reseñas'] ?>">Borrar</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>

</section>

<p><a href="index.php">Volver al inicio</a></p>

<?php include __DIR__ . "/../_footer.php"; ?>