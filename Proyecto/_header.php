<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ayuda al Viajero</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
</head>
 
<body>
 
<header>
    <h1>🌍 Ayuda al Viajero</h1>
    <p>Descubre, planifica y vive tu mejor viaje</p>
</header>
 
<nav>
    <a href="index.php">Inicio</a>
    <a href="index.php?accion=crearGuiaGastro">Guía Gastronómica</a>
    <a href="index.php?accion=crearGuiaRuta">Guía de Ruta</a>
    <a href="index.php?accion=reseñas">Reseñas</a>
    <?php if (isset($_SESSION['usuario_nombre'])): ?>
        <span style="color:white; margin: 10px;">Hola, <?= $_SESSION['usuario_nombre'] ?></span>
        <a href="index.php?accion=logout">Cerrar sesión</a>
    <?php else: ?>
        <a href="index.php?accion=login">Iniciar sesión</a>
        <a href="index.php?accion=registro">Registrarse</a>
    <?php endif; ?>
</nav>