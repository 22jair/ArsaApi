<?php

include_once __DIR__.'./../db/conexion.php';
    include __DIR__.'./../model/Land.php';

    class LandService extends Conexion {
        
        function __construct(){}
        
        function getAll(){
            try{
                $dataList = array();
                $conexion = $this->Connect();
                $query = "SELECT LAND.*, ZONE.id_zone as id_zone, ZONE.zone as zone_name, STATE.id_land_state, STATE.name AS land_state_name FROM TB_LAND AS LAND INNER JOIN TB_ZONE AS ZONE ON LAND.id_zone = ZONE.id_zone INNER JOIN TB_LAND_STATE AS STATE ON LAND.id_land_state = STATE.id_land_state";
                $result = $conexion->prepare($query);
                $result->execute();
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($data as $item){
                    $rol = new Land(                        
                        $item["id_land"],
                        $item["number"],
                        $item["price"],
                        $item["id_zone"],
                        $item["zone_name"],
                        $item["perimeter"],
                        $item["peri_top"],
                        $item["peri_right"],
                        $item["peri_bottom"],
                        $item["peri_left"],
                        $item["id_land_state"],
                        $item["land_state_name"],
                     );                     
                     $dataList[] = $rol->serialize();
                }
                return $dataList;
            }   
            catch(Exception $e){
                throw new Exception($e->getMessage());
            }            
        }

        function getByIdZone($id_zone){
            try{
                $dataList = array();
                $conexion = $this->Connect();
                $query = "SELECT LAND.*, ZONE.id_zone as id_zone, ZONE.zone as zone_name, STATE.id_land_state, STATE.name AS land_state_name FROM TB_LAND AS LAND INNER JOIN TB_ZONE AS ZONE ON LAND.id_zone = ZONE.id_zone INNER JOIN TB_LAND_STATE AS STATE ON LAND.id_land_state = STATE.id_land_state WHERE ZONE.id_zone = :id_zone";
                $result = $conexion->prepare($query);
                $result->execute([":id_zone"=>$id_zone]);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($data as $item){
                    $rol = new Land(                        
                        $item["id_land"],
                        $item["number"],
                        $item["price"],
                        $item["id_zone"],
                        $item["zone_name"],
                        $item["perimeter"],
                        $item["peri_top"],
                        $item["peri_right"],
                        $item["peri_bottom"],
                        $item["peri_left"],
                        $item["id_land_state"],
                        $item["land_state_name"],
                     );                     
                     $dataList[] = $rol->serialize();
                }
                return $dataList;
            }   
            catch(Exception $e){
                throw new Exception($e->getMessage());
            }            
        }
        
        function update(){}

        function delete(){}
        
    }

?>
