<?php

    include_once __DIR__.'./../db/conexion.php';
    include __DIR__.'./../model/PaymentType.php';
    
    class PaymentTypeService extends Conexion {
        
        function __construct(){}
        
        function getAll(){
            try{
                $dataList = array();
                $conexion = $this->Connect();
                $query = "SELECT * FROM TB_PAYMENT_TYPE";
                $result = $conexion->prepare($query);
                $result->execute();
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($data as $item){
                    $object = new PaymentType(                        
                        $item["id_payment_type"],
                        $item["name"],
                        $item["description"],
                        $item["state"],
                        null
                     );                     
                     $dataList[] = $object->serialize();
                }
                return $dataList;
            }   
            catch(Exception $e){
                throw new Exception($e->getMessage());
            }            
        }

        function getById($id){
            try{
                $conexion = $this->Connect();
                $query = "SELECT * FROM TB_PAYMENT_TYPE WHERE id_payment_type = :id_payment_type";
                $result = $conexion->prepare($query);
                $result->execute([':id_payment_type'=>(int) $id]);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                if(count($data) == 1){
                    $object = new PaymentType(                        
                        $data[0]["id_payment_type"],
                        $data[0]["name"],
                        $data[0]["description"],
                        $data[0]["state"],
                        null
                     );  
                        return $object->serialize();                 
                }else{
                    throw new Exception("Payment Type no encontrado"); // empty object
                }     
            } catch(Exception $e){               
                throw new Exception($e->getMessage());
            }  
        }

        function update(){}

        function delete(){}
        
    }

?>
