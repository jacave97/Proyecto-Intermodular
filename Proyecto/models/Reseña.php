<?php

class reseña{
    protected $id_resena;
    protected $destino_id;
    protected $usuario_id;
    protected $comentario_reseña;
    protected $valoracion;

    public function __construct($id_resena,$destino_id,$usuario_id,$comentario_reseña,$valoracion){
        $this->id_reseña=$id_reseña;
        $this->destino_id=$destino_id;
        $this->usuario_id=$usuario_id;
        $this->comentario_reseña=$comentario_resena;
        $this->valoracion=$valoracion;
       
    }

    /**
     * Get the value of id_resena
     */
    public function getIdReseña()
    {
        return $this->id_reseña;
    }

    /**
     * Set the value of id_resena
     */
    public function setIdResena($id_reseña)
    {
        $this->id_reseña = $id_reseña;

       
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
     * Get the value of comentario_reseña
     */
    public function getComentarioReseña()
    {
        return $this->comentario_reseña;
    }

    /**
     * Set the value of comentario_reseña
     */
    public function setComentarioReseña($comentario_reseña)
    {
        $this->comentario_reseña = $comentario_reseña;

        
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
