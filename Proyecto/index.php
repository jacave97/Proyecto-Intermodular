<?php

require_once "autoload.php";
session_start();
 
$gestor           = new GestorPDO();
$controller       = new GuiaController($gestor);
$usuarioController = new UsuarioController($gestor);
 
$accion = $_GET['accion'] ?? 'index';
 
// Acciones que requieren login
$accionesProtegidas = ['crearGuiaGastro', 'crearGuiaRuta', 'eliminarGuia'];
 
if (in_array($accion, $accionesProtegidas) && !isset($_SESSION['usuario_id'])) {
    header('Location: index.php?accion=login');
    exit;
}
 
switch ($accion) {
 
    // --- Usuario ---
    case 'login':
        $usuarioController->login();
        break;
 
    case 'registro':
        $usuarioController->registro();
        break;
 
    case 'logout':
        $usuarioController->logout();
        break;
 
    // --- Guías ---
    case 'crearGuiaGastro':
        $controller->crearGuiaGastro();
        break;
 
    case 'crearGuiaRuta':
        $controller->crearGuiaRuta();
        break;
 
    case 'eliminarGuia':
        $controller->eliminarGuia();
        break;
 
    // --- Página principal ---
    default:
        $controller->index();
        break;
}