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

    /**
     * Get the value of id_usuario
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * Set the value of id_usuario
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;

        
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
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email)
    {
        $this->email = $email;

        
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password)
    {
        $this->password = $password;

        
    }

    /**
     * Get the value of rol
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set the value of rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

     
    }
}