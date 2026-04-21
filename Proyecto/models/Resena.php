<?php

class resena{
    protected $id_resena;
    protected $destino_id;
    protected $usuario_id;
    protected $comentario_resena;
    protected $valoracion;

    public function __construct($id_resena,$destino_id,$usuario_id,$comentario_resena,$valoracion){
        $this->id_resena=$id_resena;
        $this->destino_id=$destino_id;
        $this->usuario_id=$usuario_id;
        $this->comentario_resena=$comentario_resena;
        $this->valoracion=$valoracion;
       
    }

    /**
     * Get the value of id_resena
     */
    public function getIdResena()
    {
        return $this->id_resena;
    }

    /**
     * Set the value of id_resena
     */
    public function setIdResena($id_resena)
    {
        $this->id_resena = $id_resena;

       
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
     * Get the value of comentario_resena
     */
    public function getComentarioResena()
    {
        return $this->comentario_resena;
    }

    /**
     * Set the value of comentario_resena
     */
    public function setComentarioResena($comentario_resena)
    {
        $this->comentario_resena = $comentario_resena;

        
    }

    /**
     * Get the value of valoracion
     */
    public function getValoracion()
    {
        return $this->valoracion;
    }

    /**
     * Set the value of valoracion
     */
    public function setValoracion($valoracion)
    {
        $this->valoracion = $valoracion;

        
    }
}
