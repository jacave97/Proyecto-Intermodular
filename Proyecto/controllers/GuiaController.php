<?php
 
class GuiaController {
 
    protected $gestor;
 
    public function __construct($gestor) {
        $this->gestor = $gestor;
    }
 
    public function index() {
        $arrayDestinos = $this->gestor->listarDestinos();
        include "views/inicio.php";
    }
 
    public function crearGuiaGastro() {
 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $titulo          = $_POST['titulo'];
            $comentario_guia = $_POST['comentario_guia'];
            $usuario_id      = $_SESSION['usuario_id'];
            $destino_id      = $_POST['destino_id'];

            $precio_medio = $_POST['precio_medio'];
            $tipo_comida = $_POST['tipo_comida'];
 
            $guia = new GuiaGastronomica(null, $titulo, $comentario_guia, $usuario_id, $destino_id, $precio_medio, $tipo_comida);
 
            $exito = $this->gestor->crearGuia($guia);
 
            if ($exito) {
                header("Location: index.php?mensaje=guia_creada");
                exit;
            } else {
                $error = "Error al guardar la guía.";
            }
        }
 
        $arrayDestinos = $this->gestor->listarDestinos();
        include "views/crear_guia_gastro.php";
    }
 
    public function crearGuiaRuta() {
 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $titulo          = $_POST['titulo'];
            $comentario_guia = $_POST['comentario_guia'];
            $usuario_id      = $_SESSION['usuario_id'];
            $destino_id      = $_POST['destino_id'];

            $distancia_km = $_POST['distancia_km'];
            $dificultad = $_POST['dificultad'];
 
            $guia = new GuiaRuta(null, $titulo, $comentario_guia, $usuario_id, $destino_id, $distancia_km, $dificultad );
 
            $exito = $this->gestor->crearGuia($guia);
 
            if ($exito) {
                header("Location: index.php?mensaje=guia_creada");
                exit;
            } else {
                $error = "Error al guardar la guía.";
            }
        }
 
        $arrayDestinos = $this->gestor->listarDestinos();
        include "views/crear_guia_ruta.php";
    }
 
    public function eliminarGuia() {
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
}