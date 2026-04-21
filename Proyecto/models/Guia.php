<?php
class Guia{
    protected $idGuias;
    protected $titulo;
    protected $comentario;
    protected $usuario_id;
    protected $destino_id;

    public  function __construct($idGuias,$titulo,$comentario,$usuario_id,$destino_id){
        $this->idGuias=$idGuias;
        $this->titulo=$titulo;
        $this->comentario=$comentario;
        $this->usuario_id=$usuario_id;
        $this->destino_id=$destino_id;
    }

/**
     * Get the value of idGuias
     */
    public function getIdGuias()
    {
        return $this->idGuias;
    }

    /**
     * Set the value of idGuias
     */
    public function setIdGuias($idGuias)
    {
        $this->idGuias = $idGuias;

       
    }

    /**
     * Get the value of titulo
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        
    }

    /**
     * Get the value of comentario
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set the value of comentario
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        
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
     * Get the value of destino_id
     */
    public function getDestinoId()
    {
        return $this->destino_id;
    }

    /**
     * Set the value of destino_id
     */
    public function setDestinoId($destino_id)
    {
        $this->destino_id = $destino_id;

        
    }
}