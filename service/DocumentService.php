<?php

    include_once __DIR__.'./../db/conexion.php';
    include __DIR__.'./../model/Document.php';
    
    class DocumentService extends Conexion {
        
        function __construct(){}
        
        function getAll(){
            try{
                $dataList = array();
                $conexion = $this->Connect();
                $query = "SELECT * FROM TB_DOCUMENT";
                $result = $conexion->prepare($query);
                $result->execute();
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($data as $item){
                    $object = new Document(                        
                        $item["id_document"],
                        $item["title"],
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
                $query = "SELECT * FROM TB_DOCUMENT WHERE id_document = :id_document";
                $result = $conexion->prepare($query);
                $result->execute([':id_document'=>(int) $id]);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                if(count($data) == 1){
                    $object = new Document(                        
                        $data[0]["id_document"],
                        $data[0]["title"],
                        $data[0]["description"],
                        $data[0]["state"],
                        null
                     );  
                        return $object->serialize();                 
                }else{
                    throw new Exception("Documento no encontrado"); // empty object
                }     
            } catch(Exception $e){               
                throw new Exception($e->getMessage());
            }  
        }

        function update(){}

        function delete(){}
        
    }

?>
