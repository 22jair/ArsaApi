<?php
    
    include_once __DIR__.'./../service/PaymentMethodService.php';

    class PaymentMethodController{

        private $service;

        function __construct() {
            $this->service = new PaymentMethodService();
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

        function getById($id){
            try{
                $data = $this->service->getById((int) $id);              
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
