<?php include __DIR__ . "/../_header.php"; ?>

<section>
    <h2>Añadir Nuevo Destino</h2>

    <!-- Formulario limpio y normal, solo texto -->
    <form action="index.php?accion=nuevoDestino" method="POST">
        
        <label for="nombre_destino">Nombre del Destino:</label><br>
        <input type="text" id="nombre_destino" name="nombre_destino" required><br><br>

        <label for="pais_destino">País:</label><br>
        <input type="text" id="pais_destino" name="pais_destino" required><br><br>

        <label for="continente">Continente:</label><br>
        <input type="text" id="continente" name="continente" required><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" rows="4" required></textarea><br><br>

        <button type="submit">Guardar Destino</button>
    </form>
</section>

<?php include __DIR__ . "/../_footer.php"; ?>