<?php

    include_once __DIR__.'./../db/conexion.php';
    include __DIR__.'./../model/Sale.php';
    include __DIR__.'./../model/SaleState.php';
    include __DIR__.'./../model/PaymentType.php';

    class SaleService extends Conexion {
        
        function __construct(){}
        
        function getAll(){
            try{
                $dataList = array();
                $conexion = $this->Connect();
                $query = "SELECT SALE.*, PT.id_payment_type AS payment_type_id, PT.name AS payment_type_name, SS.id_sale_state as sale_state_id, SS.name AS sale_state_name FROM TB_SALE AS SALE INNER JOIN TB_PAYMENT_TYPE AS PT ON PT.id_payment_type = SALE.id_payment_type INNER JOIN TB_SALE_STATE AS SS ON SS.id_sale_state = SALE.id_sale_state";
                $result = $conexion->prepare($query);
                $result->execute();
                $data = $result->fetchAll(PDO::FETCH_ASSOC);            

                foreach($data as $item){
                    //empty object new stdClass()
                    $payment_type = new PaymentType("payment_type_id", "payment_type_name", null, null);            
                    $sale_state = new SaleState("sale_state_id", "sale_state_name", null, null);                
                    
                    $object = new Sale(                        
                        $item["id_sale"],
                        $item["date_sale"],
                        $item["comment"],
                        $item["net_amount"],
                        $item["total_commission"],
                        $item["total_amount"],
                        $payment_type->serialize(),
                        $sale_state->serialize(),
                        $item["at_created"],
                        $item["at_updated"]                    
                     );                     
                     $dataList[] = $object->serialize();
                }

                return $dataList;
            }   
            catch(Exception $e){
                //NO RETORNAMOS EL MENSAJE POR QUE EL USUARIO NO DEBE SABER Q ERROR TIENE LA BD
                //return $e->getMessage();
                //throw new Exception("Error en el Sistema");
                throw new Exception($e->getMessage());
            }            
        }

        function getById($id){
            try{

                $conexion = $this->Connect();
                $query = "SELECT SALE.*, PT.id_payment_type AS payment_type_id, PT.name AS payment_type_name, SS.id_sale_state as sale_state_id, SS.name AS sale_state_name FROM TB_SALE AS SALE INNER JOIN TB_PAYMENT_TYPE AS PT ON PT.id_payment_type = SALE.id_payment_type INNER JOIN TB_SALE_STATE AS SS ON SS.id_sale_state = SALE.id_sale_state
                WHERE SALE.id_sale = :id_sale";
                $result = $conexion->prepare($query);
                $result->execute([':id_sale'=>(int) $id]);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);

                $dataList = array();

                foreach($data as $item){
                   //empty object new stdClass()
                   $payment_type = new PaymentType("payment_type_id", "payment_type_name", null, null);            
                   $sale_state = new SaleState("sale_state_id", "sale_state_name", null, null);                
                   
                   $object = new Sale(                        
                        $item["id_sale"],
                        $item["date_sale"],
                        $item["comment"],
                        $item["net_amount"],
                        $item["total_commission"],
                        $item["total_amount"],
                        $payment_type->serialize(),
                        $sale_state->serialize(),
                        $item["at_created"],
                        $item["at_updated"]                         
                    );
                    
                    $dataList[] = $object->serialize();
                }
                return $dataList;
            }   
            catch(Exception $e){                
                //throw new Exception("Error en el Sistema");
                throw new Exception($e->getMessage());
            }            
        }

        function add(Sale $sale, $users_buyers, $lands, $users_referred){
            try{            
                $payment_type = $sale->getPayment_type();
                $sale_state = $sale->getSale_state();
                
                $conexion = $this->Connect();                
                $conexion->beginTransaction();

                //INSERT TB_SALE
                $query = "INSERT INTO TB_SALE VALUES (:id_sale, :date_sale, :id_payment_type, :comment, :net_amount, :total_commission, :total_amount, :id_sale_state, :at_created, :at_updated);";
                $result = $conexion->prepare($query);
                $result->execute(
                    [
                        ":id_sale" => NULL,
                        ":date_sale" => $sale->getDate_sale(), //ej: '2020-12-28'
                        ":id_payment_type" => $payment_type["id_payment_type"],
                        ":comment" => $sale->getComment(),
                        ":net_amount" => $sale->getNet_amount(),
                        ":total_commission" => $sale->getTotal_commission(),
                        ":total_amount" => $sale->getTotal_amount(),
                        ":id_sale_state" => $sale_state["id_sale_state"],
                        ":at_created" => NULL,
                        ":at_updated" => NULL 
                    ]
                );
                 //ultimo ID insertado
                $lastId = $conexion->lastInsertId();
                
                if($this->land_availability($conexion,$lands)){
                     //INSERT TB_SALE_LANDS                
                    $this->insert_sale_lands($conexion, $lastId ,$lands);
                    //INSERT TB_SALE_USER : LOS COMPRADORES               
                    $this->insert_sale_user($conexion, $lastId ,$users_buyers);                       
                    //INSERT TB_SALE_REFERRED : LOS Referidos quienes traeron al comprador y se les paga una comisión
                    $this->insert_sale_referred($conexion, $lastId ,$users_referred);
                }else{
                    throw new Exception("Lote asignado en uso");
                }
                            
                $conexion->commit();
                return true;
            }   
            catch(Exception $e){   
                $conexion->rollBack();         
               throw new Exception($e->getMessage());
            }                                 
        }

        function update(){}

        function delete(){}
        
        // ############ INSERTS ABOUT SALE
        private function land_availability($conexion ,$lands){
            $resp = true;
            foreach($lands as $item){  
                $query = "SELECT * FROM TB_SALE_LAND WHERE id_land = :id_land AND state = :state;";
                $result = $conexion->prepare($query);
                $result->execute([
                    ":id_land" => $item["id_land"],
                    ":state" => 1,
                    ]);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);                
                if(count($data) > 0){                   
                    $resp = false;                   
                    break;
                }
            }
            return $resp;
        }

        private function insert_sale_lands($conexion, $lastId ,$lands){
            foreach($lands as $item){  
                $query = "INSERT INTO TB_SALE_LAND VALUES (:id_sale, :id_land, :initial_payment, :total_interest, :id_payment_method, :state, :at_created, :at_updated);";
                $result = $conexion->prepare($query);
                $result->execute(
                    [
                        ":id_sale" => $lastId,
                        ":id_land" => $item["id_land"],
                        ":initial_payment"=>$item["initial_payment"],
                        ":total_interest"=>$item["total_interest"],
                        ":id_payment_method"=>$item["id_payment_method"],                          
                        ":state"=>'1',
                        ":at_created" => NULL,
                        ":at_updated" => NULL 
                    ]
                );
            }
        }

        private function insert_sale_user($conexion, $lastId ,$users_buyers){
            foreach($users_buyers as $item){                
                $query = "INSERT INTO TB_SALE_USER VALUES (:id_sale, :id_user, :state, :at_created, :at_updated);";
                $result = $conexion->prepare($query);
                $result->execute(
                    [
                        ":id_sale" => $lastId,
                        ":id_user" => $item["id_user"], //ej: '2020-12-28'
                        ":state"=>'1',
                        ":at_created" => NULL,
                        ":at_updated" => NULL 
                    ]
                );
            }
        }

        private function insert_sale_referred($conexion, $lastId ,$users_referred){
            foreach($users_referred as $item){                
                $query = "INSERT INTO TB_SALE_REFERRED VALUES (:id_sale, :id_user_referred, :commission ,:state, :at_created, :at_updated);";
                $result = $conexion->prepare($query);
                $result->execute(
                    [
                        ":id_sale" => $lastId,
                        ":id_user_referred" => $item["id_user_referred"],
                        ":commission" => $item["commission"],                            
                        ":state"=>'1',
                        ":at_created" => NULL,
                        ":at_updated" => NULL 
                    ]
                );
            }

        }
        
    }

?>
