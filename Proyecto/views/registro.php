<?php include __DIR__ . "/../_header.php"; ?>

<section>
    <h2>Crear cuenta</h2>

    <?php if (isset($error_registro)): ?>
        <p><?= $error_registro ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php?accion=registro">
        <label for="nombre">Nombre</label><br>
        <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required><br><br>

        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" placeholder="Tu email" required><br><br>

        <label for="password">Contraseña</label><br>
        <input type="password" id="password" name="password" placeholder="Tu contraseña" required><br><br>

        <label for="rol">Tipo de cuenta</label><br>
        <select name="rol" id="rol">
            <option value="usuario">Usuario</option>
            <option value="admin">Administrador</option>
        </select><br><br>

        <button type="submit">Registrarse</button>
    </form>

    <p>¿Ya tienes cuenta? <a href="index.php?accion=login">Inicia sesión</a></p>
</section>

<?php include __DIR__ . "/../_footer.php"; ?>