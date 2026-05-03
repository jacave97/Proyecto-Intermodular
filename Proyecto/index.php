<?php

require_once "autoload.php";
session_start();

$gestor           = new GestorPDO();
$controller       = new Controller($gestor);
$usuarioController = new UsuarioController($gestor);

$accion = $_GET['accion'] ?? 'index';

// Acciones que requieren login
$accionesProtegidas = ['crearGuia', 'eliminarGuia'];

if (in_array($accion, $accionesProtegidas) && !isset($_SESSION['usuario_id'])) {
    header('Location: index.php?accion=login');
    exit;
}

switch ($accion) {

    //USUARIO
    case 'login':
        $controller->login();
        break;

    case 'registro':
        $controller->registro();
        break;

    case 'logout':
        $controller->logout();
        break;

    //GUIAS
    case 'crearGuia':
        $controller->crearGuia();
        break;

    case 'nuevoDestino':
        $controller->nuevoDestino();
        break;

    case 'eliminarGuia':
        $controller->eliminarGuia();
        break;
    case 'borrarGuia':
        $controller->borrarGuia();
        break;
    case 'editarGuia':
        $controller->editarGuia();
        break;

    // RESEÑAS
    case 'reseñas':
        $controller->mostrarReseñas();
        break;
    case 'guardarReseña':
        $controller->guardarReseña();
        break;
    case 'borrarReseña':
        $controller->borrarReseña();
        break;
    case 'editarReseña':
        $controller->editarReseña();
        break;
    // DESTINO

    case 'borrarDestino':
        $controller->borrarDestino();
        break;
    case 'editarDestino':
        $controller->editarDestino();
        break;

    // --- Página principal ---
    default:
        $controller->index();
        break;
}
