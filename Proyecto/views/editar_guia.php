<?php include __DIR__ . "/../_header.php"; ?>
<h2>Editar Guía</h2>
<form action="index.php?accion=editarGuia" method="POST">
    <input type="hidden" name="id_guia" value="<?= $guia['Id_guias'] ?>">
    <label>Título:</label><br><input type="text" name="titulo" value="<?= $guia['Titulo'] ?>" required><br><br>
    <label>Comentario:</label><br><textarea name="comentario" rows="4" required><?= $guia['Comentario'] ?></textarea><br><br>
    <button type="submit">Guardar Cambios</button>
</form>
<a href="index.php">Cancelar</a>
<?php include __DIR__ . "/../_footer.php"; ?>