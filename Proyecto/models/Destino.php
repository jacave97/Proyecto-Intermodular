<?php

class Destino{

    protected $id_destino;
    protected $nombre;
    protected $pais;
    protected $continente;
    protected $descripcion;


    public function __construct($id_destino,$nombre,$pais,$continente,$descripcion){

        $this->id_destino=$id_destino;
        $this->nombre=$nombre;
        $this->pais=$pais;
        $this->continente=$continente;
        $this->descripcion=$descripcion;

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
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion_destino
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

    }

}