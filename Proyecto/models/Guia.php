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


}