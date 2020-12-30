<?php
    
    include_once __DIR__.'./../service/SaleService.php';
    include_once __DIR__.'./../model/Sale.php';

    class SaleController{

        private $service;

        function __construct() {
            $this->service = new SaleService();
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

        function add($data){

            try{
                if(isset($data["date_sale"]) && isset($data["id_payment_type"]) && isset($data["remaining_payment"]) && isset($data["total_amount"]) && isset($data["id_sale_state"])){
                    if(strlen($data["date_sale"]) <= 0) throw new Exception("Ingrese una fecha");
                    if((int)$data["id_payment_type"] <= 0) throw new Exception("Ingrese un tipo de pago");
                    if((double)$data["total_amount"] <= 0) throw new Exception("Ingrese un monto total");
                    if((int)$data["id_sale_state"] <= 0) throw new Exception("Ingrese un estado de venta");
                                                            
                    $sale = new Sale(                        
                            null,
                            $data["date_sale"],
                            $data["id_payment_type"],
                            null,
                            $data["comment"],
                            $data["remaining_payment"],
                            $data["total_amount"],
                            $data["id_sale_state"],
                            null,
                            null,
                            null
                         ); 

                    //echo json_encode($data);                
                    if($this->service->add($sale)) 
                        echo  json_encode(["message"=>"Venta registrada correctamente"]); 
                    else  
                        throw new Exception("Error en el registro de datos");
                }else{
                    throw new Exception("Ingrese los campos correctos");
                }
               
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
