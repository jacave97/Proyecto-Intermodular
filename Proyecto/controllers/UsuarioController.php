<?php
 
class UsuarioController {
 
    protected $gestor;
 
    public function __construct($gestor) {
        $this->gestor = $gestor;
    }
 
    public function registro() {
 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre       = $_POST['nombre'];
            $email        = $_POST['email'];
            $passwordPlana = $_POST['password'];
 
            $passwordHash = password_hash($passwordPlana, PASSWORD_DEFAULT);
 
            $nuevoUsuario = new Usuario(null, $nombre, $email, $passwordHash, 'usuario');
 
            $this->gestor->registrarUsuario($nuevoUsuario);
 
            header("Location: index.php?accion=login");
            exit;
        }
 
        include "views/registro.php";
    }
 
    public function login() {
 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email        = $_POST['email'];
            $passwordPlana = $_POST['password'];
 
            $usuario = $this->gestor->buscarUsuarioPorEmail($email);
 
            if ($usuario && password_verify($passwordPlana, $usuario->getPassword())) {
 
                $_SESSION['usuario_id']  = $usuario->getIdUsuario();
                $_SESSION['usuario_nombre'] = $usuario->getNombre();
                $_SESSION['usuario_email']  = $usuario->getEmail();
                $_SESSION['usuario_rol']    = $usuario->getRol();
 
                header("Location: index.php");
                exit;
 
            } else {
                $error = "Email o contraseña incorrectos.";
                include "views/login.php";
                return;
            }
        }
 
        include "views/login.php";
    }
 
    public function logout() {
        session_destroy();
        header("Location: index.php?accion=login");
        exit;
    }
}