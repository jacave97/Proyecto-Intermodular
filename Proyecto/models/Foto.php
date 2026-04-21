<?php

class Foto{
    protected $id_foto;
    protected $reseña_id;
    protected $usuario_id;
    protected $url;
    protected $descripcion_foto;

    public function __construct($id_foto,$reseña_id,$usuario_id,$url,$descripcion_foto){
        $this->id_foto=$id_foto;
        $this->reseña_id=$reseña_id;
        $this->usuario_id=$usuario_id;
        $this->url=$url;
        $this->descripcion_foto=$descripcion_foto;
    }
    
}