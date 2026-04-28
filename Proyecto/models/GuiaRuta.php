<?php
 
class GuiaRuta extends Guia {
 
    private $distancia_km;
    private $dificultad; // 'baja', 'media', 'alta'
 
    public function __construct($idGuias, $titulo, $comentario_guia, $usuario_id, $destino_id, $distancia_km, $dificultad) {
        parent::__construct($idGuias, $titulo, $comentario_guia, $usuario_id, $destino_id);
        $this->distancia_km = $distancia_km;
        $this->dificultad   = $dificultad;
    }
 
    /**
     * Get the value of distancia_km
     */
    public function getDistanciaKm() {
        return $this->distancia_km;
    }
 
    /**
     * Set the value of distancia_km
     */
    public function setDistanciaKm($distancia_km) {
        $this->distancia_km = $distancia_km;
    }
 
    /**
     * Get the value of dificultad
     */
    public function getDificultad() {
        return $this->dificultad;
    }
 
    /**
     * Set the value of dificultad
     */
    public function setDificultad($dificultad) {
        $this->dificultad = $dificultad;
    }
}