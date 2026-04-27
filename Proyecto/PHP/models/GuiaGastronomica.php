<?php
 
class GuiaGastronomica extends Guia {
 
    private $precio_medio;
    private $tipo_comida;
 
    public function __construct($idGuias, $titulo, $comentario_guia, $usuario_id, $destino_id, $precio_medio, $tipo_comida) {
        parent::__construct($idGuias, $titulo, $comentario_guia, $usuario_id, $destino_id);
        $this->precio_medio = $precio_medio;
        $this->tipo_comida  = $tipo_comida;
    }
 
    /**
     * Get the value of precio_medio
     */
    public function getPrecioMedio() {
        return $this->precio_medio;
    }
 
    /**
     * Set the value of precio_medio
     */
    public function setPrecioMedio($precio_medio) {
        $this->precio_medio = $precio_medio;
    }
 
    /**
     * Get the value of tipo_comida
     */
    public function getTipoComida() {
        return $this->tipo_comida;
    }
 
    /**
     * Set the value of tipo_comida
     */
    public function setTipoComida($tipo_comida) {
        $this->tipo_comida = $tipo_comida;
    }
}