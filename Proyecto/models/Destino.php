<?php

class Destinos{

    protected $id_destino;
    protected $nombre;
    protected $pais;
    protected $continente;
    protected $descripcion;
    protected $imagen;
    protected $numero_visitas;

    public function __construct($id_destino,$nombre,$pais,$continente,$descripcion,$imagen,$numero_visitas){

        $this->id_destino=$id_destino;
        $this->nombre=$nombre;
        $this->pais=$pais;
        $this->continente=$continente;
        $this->descripcion=$descripcion;
        $this->imagen=$imagen;
        $this->numero_visitas=$numero_visitas;
    }
    
}