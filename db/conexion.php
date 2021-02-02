<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, PUT, GET, OPTIONS'); 
 
include __DIR__.'./../config.php';

class Conexion{

    private $server = COSNT_SERVER;
    private $dbname = CONST_DBNAME;
    private $user = CONST_USER;
    private $password = CONST_PASSWORD;    
    
    public function __construct(){}

    function Connect(){
        try{
            $conexion = new PDO(
                            "mysql:host=".$this->server."; dbname=".
                                $this->dbname,
                                $this->user,
                                $this->password
                            );
            //echo "Conectado exitosamente";            
            return $conexion;
        }
        catch(Exception $error){
            die("El error de conexión es: ".$error->getMessage());
        }
    }

}

//-test
//$ok = new Conexion();
//$ok->Connect();