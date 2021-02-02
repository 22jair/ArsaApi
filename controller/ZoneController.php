<?php
    
    include_once __DIR__.'./../service/ZoneService.php';

    class ZoneController{

        private $service;

        function __construct() {
            $this->service = new ZoneService();
        }

        function getAll(){
            try{                
                $data = $this->service->getAll();
                echo json_encode($data);                
            }   
            catch(Exception $e){
                http_response_code(404);
                echo json_encode(["message"=>$e->getMessage()]);
            }            
        }
          
        function getAllWithLands($mask = false){
            try{                                
                $data = $this->service->getAllWithLands($mask);
                echo json_encode($data);                
            }   
            catch(Exception $e){
                http_response_code(404);
                echo json_encode(["message"=>$e->getMessage()]);
            }            
        }
           
        

        function getById($id_zone){
            try{
                $data = $this->service->getById((int) $id_zone);              
                echo json_encode($data);                
            }   
            catch(Exception $e){
                http_response_code(404);
                echo json_encode(["message"=>$e->getMessage()]);
            }                     
        }

        function getByIdLand($id_land){
            try{
                $data = $this->service->getByIdLand((int) $id_land);              
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
