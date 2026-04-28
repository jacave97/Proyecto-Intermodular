<?php include __DIR__ . "/../_header.php"; ?>
 
<section>
    <h2 class="titulo">Crear Guía Gastronómica</h2>
 
    <?php if (isset($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
 
    <div class="form-container">
        <form method="POST" action="/Proyecto/index.php?accion=crearGuiaGastro">
 
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título de la guía" required>
            </div>
 
            <div class="form-group">
                <label for="comentario_guia">Descripción</label>
                <textarea id="comentario_guia" name="comentario_guia" rows="4" placeholder="Describe la guía gastronómica..." required></textarea>
            </div>
 
            <div class="form-group">
                <label for="destino_id">Destino</label>
                <select id="destino_id" name="destino_id" required>
                    <option value="">-- Selecciona un destino --</option>
                    <?php foreach ($arrayDestinos as $destino): ?>
                        <option value="<?= $destino->getIdDestinos() ?>">
                            <?= $destino->getNombre() ?> (<?= $destino->getPais() ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
 
            <div class="form-group">
                <label for="precio_medio">Precio medio (€)</label>
                <input type="number" id="precio_medio" name="precio_medio" placeholder="Ej: 25" min="0" required>
            </div>
 
            <div class="form-group">
                <label for="tipo_comida">Tipo de comida</label>
                <input type="text" id="tipo_comida" name="tipo_comida" placeholder="Ej: Italiana, Japonesa..." required>
            </div>
 
            <button type="submit" class="btn-primary">Crear guía</button>
 
        </form>
    </div>
</section>
 
<?php include __DIR__ . "/../_footer.php"; ?>