<?php

    include_once __DIR__.'./../db/conexion.php';
    include __DIR__.'./../model/Zone.php';
    include __DIR__.'./../service/LandService.php';

    class ZoneService extends Conexion {
        
        private $service_land;

        function __construct(){
            $this->service_land = new LandService();
        }
        
        function getAll(){
            try{
                $dataList = array();
                $conexion = $this->Connect();
                $query = "SELECT * FROM TB_ZONE";
                $result = $conexion->prepare($query);
                $result->execute();
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($data as $item){
                    $rol = new Zone(                        
                        $item["id_zone"],
                        $item["zone"],
                        $item["perimeter"],
                        $item["lands"],
                        null
                     );                     
                     $dataList[] = $rol->serialize();
                }
                return $dataList;
            }   
            catch(Exception $e){
                throw new Exception($e->getMessage());
            }            
        }

        function getAllWithLands($mask = false){
            try{
                $dataList = array();
                $conexion = $this->Connect();
                $query = "SELECT * FROM TB_ZONE ";
                if($mask){  
                    $query .= "ORDER BY mask_number ASC";
                }

                $result = $conexion->prepare($query);
                $result->execute();
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($data as $item){
                    $rol = new Zone(                        
                        $item["id_zone"],
                        $item["zone"],
                        $item["perimeter"],
                        $item["lands"],
                        $this->service_land->getByIdZone($item["id_zone"], $mask)
                     );  
                     
                     $dataList[] = $rol->serialize();
                }
                return $dataList;
            }   
            catch(Exception $e){
                throw new Exception($e->getMessage());
            }            
        }

        function getById($id_zone){
            try{
                $conexion = $this->Connect();
                $query = "SELECT * FROM TB_ZONE 
                WHERE id_zone = :id_zone";
                $result = $conexion->prepare($query);
                $result->execute([':id_zone'=>(int) $id_zone]);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);                

                if(count($data) == 1){
                    $zone = new Zone(                        
                                $data[0]["id_zone"],
                                $data[0]["zone"],
                                $data[0]["perimeter"],
                                $data[0]["lands"],
                                null
                             );                    
                        return $zone->serialize();                 
                }else{
                    throw new Exception("Zona no existe"); // empty object
                }        
            }   
            catch(Exception $e){                
                //throw new Exception("Error en el Sistema");
                throw new Exception($e->getMessage());
            }            
        }

        //trae la zona al que pertenece 1 terreno
        function getByIdLand($id_land){
            try{
                $conexion = $this->Connect();
                $query = "SELECT ZONE.* FROM TB_ZONE as ZONE
                INNER JOIN TB_LAND as  LAND ON ZONE.id_zone = LAND.id_zone                
                WHERE LAND.id_land = :id_land";
                $result = $conexion->prepare($query);
                $result->execute([':id_land'=>(int) $id_land]);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);                

                if(count($data) == 1){
                    $zone = new Zone(                        
                                $data[0]["id_zone"],
                                $data[0]["zone"],
                                $data[0]["perimeter"],
                                $data[0]["lands"],
                                null
                             );                    
                        return $zone->serialize();                 
                }else{
                    throw new Exception("Zona no existe"); // empty object
                }   

            }   
            catch(Exception $e){                
                //throw new Exception("Error en el Sistema");
                throw new Exception($e->getMessage());
            }            
        }

        

        function update(){}

        function delete(){}
        
    }

?>
