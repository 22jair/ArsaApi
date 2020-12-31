<?php
    
    include_once __DIR__.'./../service/SaleService.php';
    include_once __DIR__.'./../service/LandService.php';
    include_once __DIR__.'./../model/Sale.php';

    class SaleController{

        private $service;

        function __construct() {
            $this->service = new SaleService();
            $this->serviceLand = new LandService();
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
            // EL MONTO TOTAL DE LA VENTA ES EL PAGO:
                // DEL PRECIO DE CADA TERRENO + SU INTERES GENERADO
            try{
                if(isset($data["date_sale"]) && isset($data["payment_type"]) && isset($data["sale_state"])
                    && isset($data["users_buyers"])
                    && isset($data["lands"])  
                ){
                    if(strlen($data["date_sale"]) <= 0) throw new Exception("Ingrese una fecha");
                    if((int)$data["payment_type"]["id_payment_type"] <= 0) throw new Exception("Ingrese un tipo de pago");
                    //if((double)$data["total_amount"] <= 0) throw new Exception("Ingrese un monto total");
                    if((int)$data["sale_state"]["id_sale_state"] <= 0) throw new Exception("Ingrese un estado de venta");
                    if(count($data["users_buyers"]) <= 0) throw new Exception("Agrege al menos un comprador");
                    if(count($data["lands"]) <= 0) throw new Exception("Agrege al menos un Lote");
                                                                                
                    //OBTENIENDO MONTO TOTAL - el precio del terreno más su interes x año
                    $totalAmount = 0;
                    foreach($data["lands"] as $item){                             
                        $current_land = $this->serviceLand->getById((int) $item["id_land"]);
                        $totalAmount += $item["total_interest"] + $current_land["price"];                        
                    }

                    //OBTENIENDO MONTO TOTAL COMISSION
                    $totalCommission = 0;
                    if(count($data["users_referred"]) > 0){
                        foreach($data["users_referred"] as $item){                                                         
                            $totalCommission += $item["commission"];                        
                        }
                    }else{
                        $data["users_referred"] = [];
                    }                    

                    $sale = new Sale(                        
                            null,
                            $data["date_sale"],                            
                            $data["comment"],
                            $totalAmount - $totalCommission,
                            $totalCommission,                            
                            $totalAmount,
                            $data["payment_type"],
                            $data["sale_state"],
                            null,
                            null
                         ); 
                    $users_buyers = $data["users_buyers"];
                    $lands = $data["lands"];
                    $users_referred = $data["users_referred"];
                    //echo json_encode($data);                
                    if($this->service->add($sale, $users_buyers, $lands, $users_referred)) 
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
