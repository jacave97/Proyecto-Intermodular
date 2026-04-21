<?php

class Usuario{

    protected $id_usuario;
    protected $nombre;
    protected $email;
    protected $password;
    protected $rol;

    public function __construct($id_usuario,$nombre,$email,$password,$rol){

        $this->id_usuario=$id_usuario;
        $this->nombre=$nombre;
        $this->email=$email;
        $this->password=$password;
        $this->rol=$rol;
      
    }
}