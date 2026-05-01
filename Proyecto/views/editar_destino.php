<?php include __DIR__ . "/../_header.php"; ?>
<h2>Editar Destino</h2>
<form action="index.php?accion=editarDestino" method="POST">
    <input type="hidden" name="id_destino" value="<?= $destino['Id_Destinos'] ?>">
    <label>Nombre:</label><br><input type="text" name="nombre" value="<?= $destino['nombre'] ?>" required><br><br>
    <label>País:</label><br><input type="text" name="pais" value="<?= $destino['país'] ?>" required><br><br>
    <label>Continente:</label><br><input type="text" name="continente" value="<?= $destino['continente'] ?>" required><br><br>
    <label>Descripción:</label><br><textarea name="descripcion" rows="4" required><?= $destino['descripción'] ?></textarea><br><br>
    <button type="submit">Guardar Cambios</button>
</form>
<a href="index.php">Cancelar</a>
<?php include __DIR__ . "/../_footer.php"; ?>