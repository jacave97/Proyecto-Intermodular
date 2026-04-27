<?php

class Connection{
    protected $conn;
    private $archivoConf ="conf.json";//credenciales de conexion para la  db

    public function __construct()
    {
        $this->enlazarConexion();
    }

    private function enlazarConexion(){

        $confiData = file_get_contents($this->archivoConf);
        $array=json_decode($confiData, true);
        $dsn ="mysql:host=".$array['host']. ";dbname=".$array['db'];
        $this->conn = new PDO($dsn, $array["userName"], $array["password"]);
    }
    

    public function getConn()
    {
        return $this->conn;
    }

    public function __destruct()
    {
        $this->conn=null;
    }
}