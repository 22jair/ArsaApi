<?php
    
    include_once __DIR__.'./../service/LandService.php';

    class LandController{

        private $service;

        function __construct() {
            $this->service = new LandService();
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

        function getByIdZoneAndState($id_zone, $state){
            try{                
                $data = $this->service->getByIdZoneAndState($id_zone, $state);
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
