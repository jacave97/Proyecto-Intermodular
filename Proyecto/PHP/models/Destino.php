<?php

class Destinos{

    protected $id_destino;
    protected $nombre;
    protected $pais;
    protected $continente;
    protected $descripcion_destino;
    protected $imagen;
    protected $numero_visitas;

    public function __construct($id_destino,$nombre,$pais,$continente,$descripcion_destino,$imagen,$numero_visitas){

        $this->id_destino=$id_destino;
        $this->nombre=$nombre;
        $this->pais=$pais;
        $this->continente=$continente;
        $this->descripcion_destino=$descripcion_destino;
        $this->imagen=$imagen;
        $this->numero_visitas=$numero_visitas;
    }
    

    /**
     * Get the value of id_destino
     */
    public function getIdDestino()
    {
        return $this->id_destino;
    }

    /**
     * Set the value of id_destino
     */
    public function setIdDestino($id_destino)
    {
        $this->id_destino = $id_destino;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

       
    }

    /**
     * Get the value of pais
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set the value of pais
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        
    }

    /**
     * Get the value of continente
     */
    public function getContinente()
    {
        return $this->continente;
    }

    /**
     * Set the value of continente
     */
    public function setContinente($continente)
    {
        $this->continente = $continente;

        
    }

    /**
     * Get the value of descripcion_destino
     */
    public function getDescripcionDestino()
    {
        return $this->descripcion_destino;
    }

    /**
     * Set the value of descripcion_destino
     */
    public function setDescripcionDestino($descripcion_destino)
    {
        $this->descripcion_destino = $descripcion_destino;

    }

    /**
     * Get the value of imagen
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        
    }

    /**
     * Get the value of numero_visitas
     */
    public function getNumeroVisitas()
    {
        return $this->numero_visitas;
    }

    /**
     * Set the value of numero_visitas
     */
    public function setNumeroVisitas($numero_visitas)
    {
        $this->numero_visitas = $numero_visitas;

        
    }
}