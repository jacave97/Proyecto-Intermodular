<?php

class Foto{
    protected $id_foto;
    protected $resena_id;
    protected $usuario_id;
    protected $url;
    protected $descripcion_foto;

    public function __construct($id_foto,$resena_id,$usuario_id,$url,$descripcion_foto){
        $this->id_foto=$id_foto;
        $this->resena_id=$resena_id;
        $this->usuario_id=$usuario_id;
        $this->url=$url;
        $this->descripcion_foto=$descripcion_foto;
    }
    


    /**
     * Get the value of id_foto
     */
    public function getIdFoto()
    {
        return $this->id_foto;
    }

    /**
     * Set the value of id_foto
     */
    public function setIdFoto($id_foto)
    {
        $this->id_foto = $id_foto;

        
    }

    /**
     * Get the value of resena_id
     */
    public function getResenaId()
    {
        return $this->resena_id;
    }

    /**
     * Set the value of resena_id
     */
    public function setResenaId($resena_id)
    {
        $this->resena_id = $resena_id;

        
    }

    /**
     * Get the value of usuario_id
     */
    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    /**
     * Set the value of usuario_id
     */
    public function setUsuarioId($usuario_id)
    {
        $this->usuario_id = $usuario_id;

        
    }

    /**
     * Get the value of url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of url
     */
    public function setUrl($url)
    {
        $this->url = $url;

        
    }

    /**
     * Get the value of descripcion_foto
     */
    public function getDescripcionFoto()
    {
        return $this->descripcion_foto;
    }

    /**
     * Set the value of descripcion_foto
     */
    public function setDescripcionFoto($descripcion_foto)
    {
        $this->descripcion_foto = $descripcion_foto;

        
    }
}