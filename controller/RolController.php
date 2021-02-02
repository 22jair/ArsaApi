<?php
    
    include_once __DIR__.'./../service/RolService.php';

    class RolController{

        private $service;

        function __construct() {
            $this->service = new RolService();
        }

        function getAll(){
            try{                
                $data = $this->service->getAll();
                //var_dump($data);
                //echo $data;
                //echo $data."\n";
                //$json_encode = json_encode($data);
                //echo $json_encode;
                echo json_encode($data);                
            }   
            catch(Exception $e){
                http_response_code(404);
                echo json_encode(["message"=>$e->getMessage()]);
            }            
        }

        function getByIdUser($id_usuario){
            try{
                $data = $this->service->getByIdUser((int) $id_usuario);              
                echo json_encode($data);                
            }   
            catch(Exception $e){
                http_response_code(404);
                echo json_encode(["message"=>$e->getMessage()]);
            }            
        }

        function update(){}

        function delete(){}
        
    }

?>
