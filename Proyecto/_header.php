<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ayuda al Viajero</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <header>
        <h1>🌍 Ayuda al Viajero</h1>
        <p>Descubre, planifica y vive tu mejor viaje</p>
    </header>

    <nav>
        <a href="index.php">Inicio</a> |
        <a href="index.php?accion=reseñas">Reseñas</a> |

        <?php if (isset($_SESSION['usuario_id'])): ?>
            <a href="index.php?accion=crearGuia">Añadir Guía</a> |
            

            <?php if ($_SESSION['rol'] === 'admin'): ?>
                <a href="index.php?accion=nuevoDestino">Añadir Destino</a> |
            <?php endif; ?>
            <a><?= $_SESSION['usuario_nombre'] ?? 'cliente' ?> (<?= $_SESSION['rol'] ?? 'usuario' ?>)</a>/
            <a href="index.php?accion=logout">Cerrar sesión</a>


        <?php else: ?>
            <a href="index.php?accion=login">Iniciar sesión / Registrarse</a>
        <?php endif; ?>
    </nav>