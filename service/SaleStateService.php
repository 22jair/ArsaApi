<?php

    include_once __DIR__.'./../db/conexion.php';
    include __DIR__.'./../model/SaleState.php';
    
    class SaleStateService extends Conexion {
        
        function __construct(){}
        
        function getAll(){
            try{
                $dataList = array();
                $conexion = $this->Connect();
                $query = "SELECT * FROM TB_SALE_STATE";
                $result = $conexion->prepare($query);
                $result->execute();
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($data as $item){
                    $object = new SaleState(                        
                        $item["id_sale_state"],
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
                $query = "SELECT * FROM TB_SALE_STATE WHERE id_sale_state = :id_sale_state";
                $result = $conexion->prepare($query);
                $result->execute([':id_sale_state'=>(int) $id]);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                if(count($data) == 1){
                    $object = new SaleState(                        
                        $data[0]["id_sale_state"],
                        $data[0]["name"],
                        $data[0]["description"],
                        $data[0]["state"],
                        null
                     );  
                        return $object->serialize();                 
                }else{
                    throw new Exception("Sale State no encontrado"); // empty object
                }     
            } catch(Exception $e){               
                throw new Exception($e->getMessage());
            }  
        }

        function update(){}

        function delete(){}
        
    }

?>
