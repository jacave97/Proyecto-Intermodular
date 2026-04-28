<?php include __DIR__ . "/../_header.php"; ?>
 
<section>
    <h2 class="titulo">Crear cuenta</h2>
 
    <?php if (isset($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
 
    <div class="form-container">
        <form method="POST" action="/Proyecto/index.php?accion=registro">
 
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>
            </div>
 
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Tu email" required>
            </div>
 
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Tu contraseña" required>
            </div>
 
            <button type="submit" class="btn-primary">Registrarse</button>
 
        </form>
 
        <p class="form-link">¿Ya tienes cuenta? <a href="../index.php?accion=login">Inicia sesión</a></p>
    </div>
</section>
 
<?php include __DIR__ . "/../_footer.php"; ?>