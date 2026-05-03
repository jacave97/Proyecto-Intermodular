<?php

class GuiaController
{

    protected $gestor;

    public function __construct($gestor)
    {
        $this->gestor = $gestor;
    }

    public function index()
    {
        $arrayDestinos = $this->gestor->listarDestinos();
        $arrayGuias = $this->gestor->listarGuias();
        $guiasGastro = $this->gestor->listarGuiasGastronomicas();
        $guiasRutas = $this->gestor->listarGuiasRutas();
        include "views/inicio.php";
    }

    //GUIA

    public function crearGuia()
    {
        $tipo = $_POST['tipo_guia'] ?? null;
        $arrayDestinos = $this->gestor->listarDestinos();

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['botonGuardar'])) {

            $comunes = [
                'titulo' => $_POST['titulo'],
                'comentario' => $_POST['comentario_guia'],
                'u_id' => $_SESSION['usuario_id'],
                'd_id' => $_POST['destino_id']
            ];

            if ($tipo === 'gastro') {
                $precio = !empty($_POST['precio_medio']) ? $_POST['precio_medio'] : null;
                $tipoComida = !empty($_POST['tipo_comida']) ? $_POST['tipo_comida'] : 'No especificado';

                $guia = new GuiaGastronomica(null, $comunes['titulo'], $comunes['comentario'], $comunes['u_id'], $comunes['d_id'], $precio, $tipoComida);
            } else {
                $distancia = !empty($_POST['distancia_km']) ? $_POST['distancia_km'] : null;
                $dificultad = !empty($_POST['dificultad']) ? $_POST['dificultad'] : 'media';

                $guia = new GuiaRuta(null, $comunes['titulo'], $comunes['comentario'], $comunes['u_id'], $comunes['d_id'], $distancia, $dificultad);
            }

            if ($this->gestor->crearGuia($guia)) {
                header("Location: index.php?mensaje=guia_creada");
                exit;
            } else {
                $error = "Error al guardar la guía.";
            }
        }

        include "views/crear_guia.php";
    }
    public function eliminarGuia()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $exito = $this->gestor->eliminarGuia($id);

            if ($exito) {
                header("Location: index.php?mensaje=guia_eliminada");
                exit;
            } else {
                echo "Error al intentar eliminar la guía.";
            }
        } else {
            echo "No se proporcionó un ID válido.";
        }
    }

    // DESTINO

    public function nuevoDestino()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre_destino'];
            $pais = $_POST['pais_destino'];
            $continente = $_POST['continente'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';

            $exito = $this->gestor->insertarDestinoDirecto($nombre, $pais, $continente, $descripcion);

            if ($exito) {
                header("Location: index.php");
                exit;
            }
        }
        include __DIR__ . "/../views/nuevo_destino.php";
    }
    public function mostrarReseñas()
    {
        $listaReseñas = $this->gestor->listarReseñas();

        $arrayDestinos = $this->gestor->listarDestinos();

        include "views/reseñas.php";
    }
    public function guardarReseña()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dest_id = $_POST['destino_id'];
            $user_id = $_SESSION['usuario_id'];
            $comen   = $_POST['comentario'];
            $val     = $_POST['valoracion'];

            if ($this->gestor->insertarReseña($dest_id, $user_id, $comen, $val)) {
                header("Location: index.php?accion=reseñas");
                exit;
            }
        }
    }

    //USUARIO LOGIN REGISTRO LOGOUT

    public function login()
    {
        if (isset($_SESSION['usuario_id'])) {
            header("Location: index.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $usuario = $this->gestor->buscarUsuarioPorEmail($email);

            if ($usuario && $password === $usuario->getPassword()) {
                $_SESSION['usuario_id'] = $usuario->getIdUsuario();
                $_SESSION['usuario_nombre'] = $usuario->getNombre();
                $_SESSION['rol'] = $usuario->getRol();

                header("Location: index.php");
                exit;
            } else {
                $error_login = "Email o contraseña incorrectos.";
            }
        }
        include "views/login.php";
    }
    public function registro()
    {
        if (isset($_SESSION['usuario_id'])) {
            header("Location: index.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $rol = $_POST['rol'];

            $nuevoUsuario = new Usuario(null, $nombre, $email, $password, $rol);

            if ($this->gestor->registrarUsuario($nuevoUsuario)) {

                header("Location: index.php?accion=login");
                exit;
            } else {
                $error_registro = "Error al registrar. Tal vez el email ya existe.";
            }
        }
        include "views/registro.php";
    }

    public function logout()
    {
        session_destroy();
        header("Location: index.php");
        exit;
    }
    //Destinos
    public function borrarDestino()
    {
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $this->gestor->eliminarDestino($id);
            }
        }
        header("Location: index.php");
        exit;
    }

    public function editarDestino()
    {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id_destino'];
            $this->gestor->modificarDestino($id, $_POST['nombre'], $_POST['pais'], $_POST['continente'], $_POST['descripcion']);
            header("Location: index.php");
            exit;
        }

        $id = $_GET['id'] ?? null;
        if ($id) {
            $destino = $this->gestor->obtenerDestinoPorId($id);
            include "views/editar_destino.php";
        }
    }

    // Guias
    public function borrarGuia()
    {
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $this->gestor->eliminarGuia($id);
            }
        }
        header("Location: index.php");
        exit;
    }

    public function editarGuia()
    {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id_guia'];
            $this->gestor->modificarGuia($id, $_POST['titulo'], $_POST['comentario']);
            header("Location: index.php");
            exit;
        }

        $id = $_GET['id'] ?? null;
        if ($id) {
            $guia = $this->gestor->obtenerGuiaPorId($id);
            include "views/editar_guia.php";
        }
    }

    //Reseñas 
    public function borrarReseña()
    {
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $this->gestor->eliminarReseña($id);
            }
        }
        header("Location: index.php?accion=reseñas");
        exit;
    }

public function editarReseña()
    {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php?accion=reseñas");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id_reseña'];
            $comentario = $_POST['comentario'];
            $valoracion = $_POST['valoracion'];

            $this->gestor->modificarReseña($id, $comentario, $valoracion);
            header("Location: index.php?accion=reseñas");
            exit;
        }

        $id = $_GET['id'] ?? null;
        if ($id) {
            $reseña = $this->gestor->obtenerReseñaPorId($id);
            include "views/editar_reseña.php";
        }
    }
}
