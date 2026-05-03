<?php include __DIR__ . "/../_header.php"; ?>

<h2>Editar Reseña (Admin)</h2>

<form action="index.php?accion=editarReseña" method="POST">
    <input type="hidden" name="id_reseña" value="<?= $reseña['Id_reseñas'] ?>">
    <label>Destino</label>
    <label>Comentario:</label><br>
    <textarea name="comentario" rows="4" required><?= $reseña['Comentarios'] ?></textarea><br><br>

    <label>Valoración (1-5):</label><br>
    <input type="number" name="valoracion" min="1" max="5" value="<?= $reseña['Valoración'] ?>" required><br><br>

    <button type="submit">Guardar Cambios</button>
</form>

<br>
<a href="index.php?accion=reseñas">Cancelar</a>

<?php include __DIR__ . "/../_footer.php"; ?>