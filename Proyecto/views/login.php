<?php include __DIR__ . "/../_header.php"; ?>

<section>
    <?php if (isset($error_login)): ?>
        <p style="color: red;"><?= $error_login ?></p>
    <?php endif; ?>

    <form action="index.php?accion=login" method="POST">
        <!-- Campo oculto para saber qué formulario se envió -->
        <input type="hidden" name="accion_form" value="login">

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Entrar</button>
    </form>

    <p class="form-link">¿No tienes cuenta? <a href="index.php?accion=registro">Regístrate</a></p>

</section>

<?php include __DIR__ . "/../_footer.php"; ?>