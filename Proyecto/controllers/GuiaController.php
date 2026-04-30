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
        include "views/inicio.php";
    }

    public function crearGuia()
    {
        $tipo = $_POST['tipo_guia'] ?? null;
        $arrayDestinos = $this->gestor->listarDestinos();
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btGuardar'])) {

            $comunes = [
                'titulo' => $_POST['titulo'],
                'comentario' => $_POST['comentario_guia'],
                'u_id' => $_SESSION['usuario_id'],
                'd_id' => $_POST['destino_id']
            ];

            if ($tipo === 'gastro') {
                $guia = new GuiaGastronomica(null, $comunes['titulo'], $comunes['comentario'], $comunes['u_id'], $comunes['d_id'], $_POST['precio_medio'], $_POST['tipo_comida']);
            } else {
                $guia = new GuiaRuta(null, $comunes['titulo'], $comunes['comentario'], $comunes['u_id'], $comunes['d_id'], $_POST['distancia_km'], $_POST['dificultad']);
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
    public function nuevoDestino()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre_destino'];
            $pais = $_POST['pais_destino'];
            $continente = $_POST['continente'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';
            $nombreImagen = 'default.png';

            if (isset($_FILES['imagen_destino']) && $_FILES['imagen_destino']['error'] === UPLOAD_ERR_OK) {
                $rutaTemporal = $_FILES['imagen_destino']['tmp_name'];
                $nombreImagen = time() . "_" . basename($_FILES['imagen_destino']['name']);
                $rutaDestino = __DIR__ . "/../imagenes/" . $nombreImagen;

                if (!move_uploaded_file($rutaTemporal, $rutaDestino)) {
                    $nombreImagen = 'default.png';
                }
            }


            $exito = $this->gestor->insertarDestinoDirecto($nombre, $pais, $continente, $descripcion, $nombreImagen);

            if ($exito) {
                header("Location: index.php?accion=crearGuia&mensaje=destino_creado");
                exit;
            }
        }
        include __DIR__ . "/../views/nuevo_destino.php";
    }
}
