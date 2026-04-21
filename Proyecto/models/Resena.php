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
}
