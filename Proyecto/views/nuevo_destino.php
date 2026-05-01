<?php include __DIR__ . "/../_header.php"; ?>
<div>
    <h2>Añade a Que destinos has viajado</h2>
    <form action="index.php?accion=nuevoDestino" method="POST" enctype="multipart/form-data">
        <input type="text" name="nombre_destino" placeholder="Nombre de la ciudad" required><br>
        <input type="text" name="pais_destino" placeholder="País" required><br>
        <input type="text" name="continente" placeholder="Continente"><br>
        <textarea name="descripcion" placeholder="Descripción del destino"></textarea><br>

        <label>Imagen del destino:</label><br>
        <input type="file" name="imagen_destino" accept="image/*"><br><br>

        <button type="submit">Guardar Destino</button>
    </form>
    <a href="index.php?accion=crearGuia">Volver atrás</a>
</div>
<?php include __DIR__ . "/../_footer.php"; ?>
<?php include __DIR__ . "/../_footer.php"; ?>