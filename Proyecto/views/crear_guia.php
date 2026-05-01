<?php include __DIR__ . "/../_header.php"; ?>

<div>
    <h2>Crear Nueva Guía</h2>

    <form action="index.php?accion=crearGuia" method="POST">
        
        <label>Tipo de Guía:</label>
        <select name="tipo_guia" required>
            <option value="gastro">Gastronómica</option>
            <option value="ruta">Guía de Ruta</option>
        </select><br><br>
        
        <input type="text" name="titulo" required placeholder="Título de la Guía"><br>

        <label>Destino:</label><br>
        <select name="destino_id" required>
            <option value="">-- Selecciona un destino --</option>
            <?php foreach ($arrayDestinos as $destino): ?>
                <option value="<?= $destino->getIdDestino() ?>">
                    <?= $destino->getNombre() ?> (<?= $destino->getPais() ?>)
                </option>
            <?php endforeach; ?>
        </select><br>
        <p><small>¿No encuentras el destino? <a href="index.php?accion=nuevoDestino">Añádelo aquí</a></small></p>

        <textarea name="comentario_guia" required placeholder="Descripción de la guía..."></textarea><br>

        <br>
        <label>Información Gastronómica:</label><br>
        <input type="number" name="precio_medio" placeholder="Precio Medio (€)"><br>
        <input type="text" name="tipo_comida" placeholder="Tipo de Comida"><br>
        
        <br>
        <label>Información de Ruta:</label><br>
        <input type="number" name="distancia_km" placeholder="Distancia (km)"><br>
        <select name="dificultad">
            <option value="">Selecciona Dificultad</option>
            <option value="baja">Baja</option>
            <option value="media">Media</option>
            <option value="alta">Alta</option>
        </select><br>

        <br>
        <button type="submit" name="botonGuardar" >Registrar Guía</button>
    </form>
</div>

<?php include __DIR__ . "/../_footer.php"; ?>