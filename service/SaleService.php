<?php

include_once __DIR__.'./../db/conexion.php';
    include __DIR__.'./../model/Sale.php';

    class SaleService extends Conexion {
        
        function __construct(){}
        
        function getAll(){
            try{
                $dataList = array();
                $conexion = $this->Connect();
                $query = "SELECT SALE.*, PT.name AS payment_type_name, SS.name AS sale_state_name FROM TB_SALE AS SALE
                INNER JOIN TB_PAYMENT_TYPE AS PT ON PT.id_payment_type = SALE.id_payment_type
                INNER JOIN TB_SALE_STATE AS SS ON SS.id_sale_state = SALE.id_sale_state";
                $result = $conexion->prepare($query);
                $result->execute();
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($data as $item){
                    $object = new Sale(                        
                        $item["id_sale"],
                        $item["date_sale"],
                        $item["id_payment_type"],
                        $item["payment_type_name"],
                        $item["comment"],
                        $item["remaining_payment"],
                        $item["total_amount"],
                        $item["id_sale_state"],
                        $item["sale_state_name"],
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
                $query = "SELECT SALE.*, PT.name AS payment_type_name, SS.name AS sale_state_name FROM TB_SALE AS SALE
                INNER JOIN TB_PAYMENT_TYPE AS PT ON PT.id_payment_type = SALE.id_payment_type
                INNER JOIN TB_SALE_STATE AS SS ON SS.id_sale_state = SALE.id_sale_state
                WHERE SALE.id_sale = :id_sale";
                $result = $conexion->prepare($query);
                $result->execute([':id_sale'=>(int) $id]);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);

                $dataList = array();

                foreach($data as $item){
                    $object = new Sale(                        
                        $item["id_sale"],
                        $item["date_sale"],
                        $item["id_payment_type"],
                        $item["payment_type_name"],
                        $item["comment"],
                        $item["remaining_payment"],
                        $item["total_amount"],
                        $item["id_sale_state"],
                        $item["sale_state_name"],
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

        function add(Sale $sale){
            try{            
                $conexion = $this->Connect();
                
                $conexion->beginTransaction();
                $query = "INSERT INTO TB_SALE VALUES (:id_sale, :date_sale, :id_payment_type, :comment, :remaining_payment, :total_amount, :id_sale_state, :at_created, :at_updated);";
                //echo $query;
                $result = $conexion->prepare($query);
                $result->execute(
                    [
                        ":id_sale" => NULL,
                        ":date_sale" => $sale->getDate_sale(), //ej: '2020-12-28'
                        ":id_payment_type" => $sale->getId_payment_type(),
                        ":comment" => $sale->getComment(),
                        ":remaining_payment" => $sale->getRemaining_payment(),
                        ":total_amount" => $sale->getTotal_amount(),
                        ":id_sale_state" => $sale->getId_sale_state(),
                        ":at_created" => NULL,
                        ":at_updated" => NULL 
                    ]
                );

                $lastId = $conexion->lastInsertId();
                
                $query = "INSERT INTO TB_SALE_USER VALUES (:id_sale, :id_user, :state, :at_created, :at_updated);";
                $result = $conexion->prepare($query);
                $result->execute(
                    [
                        ":id_sale" => $lastId,
                        ":id_user" => '1', //ej: '2020-12-28'
                        ":state"=>'1',
                        ":at_created" => NULL,
                        ":at_updated" => NULL 
                    ]
                );

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
        
    }

?>
