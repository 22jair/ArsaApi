<?php

include_once __DIR__.'./../db/conexion.php';
    include __DIR__.'./../model/Land.php';

    class LandService extends Conexion {
        
        function __construct(){}
        
        function getAll(){
            try{
                $dataList = array();
                $conexion = $this->Connect();
                $query = "SELECT LAND.*, ZONE.id_zone as id_zone, ZONE.zone as zone_name, STATE.id_land_state, STATE.name AS land_state_name FROM TB_LAND AS LAND INNER JOIN TB_ZONE AS ZONE ON LAND.id_zone = ZONE.id_zone INNER JOIN TB_LAND_STATE AS STATE ON LAND.id_land_state = STATE.id_land_state
                        WHERE LAND.id_land_state != '4'
                        ORDER BY LAND.id_land
                        ";
                $result = $conexion->prepare($query);
                $result->execute();
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($data as $item){
                    $object = new Land(                        
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
                     $dataList[] = $object->serialize();
                }
                return $dataList;
            }   
            catch(Exception $e){
                throw new Exception($e->getMessage());
            }            
        }

        function getByIdZone($id_zone, $mask){
            try{
                $dataList = array();
                $conexion = $this->Connect();
                $query = "SELECT LAND.*, ZONE.id_zone as id_zone, ZONE.zone as zone_name, STATE.id_land_state, STATE.name AS land_state_name FROM TB_LAND AS LAND INNER JOIN TB_ZONE AS ZONE ON LAND.id_zone = ZONE.id_zone INNER JOIN TB_LAND_STATE AS STATE ON LAND.id_land_state = STATE.id_land_state
                            WHERE ZONE.id_zone = :id_zone ";                    

                if($mask){
                    $query .= "ORDER BY LAND.mask_number ASC; ";
                }else { $query .= "ORDER BY LAND.number ASC;"; }

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

        function getByIdZoneAndState($id_zone, $state){
            try{
                $dataList = array();
                $conexion = $this->Connect();
                $query = "SELECT LAND.*, ZONE.id_zone as id_zone, ZONE.zone as zone_name, STATE.id_land_state, STATE.name AS land_state_name FROM TB_LAND AS LAND INNER JOIN TB_ZONE AS ZONE ON LAND.id_zone = ZONE.id_zone INNER JOIN TB_LAND_STATE AS STATE ON LAND.id_land_state = STATE.id_land_state 
                WHERE ZONE.id_zone = :id_zone and LAND.id_land_state = :id_land_state
                order by Land.id_land";


                $result = $conexion->prepare($query);
                $result->execute([":id_zone"=>$id_zone, ":id_land_state"=>$state]);
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
        
        function getById($id){

            try{
                $conexion = $this->Connect();
                $query = "SELECT LAND.*, ZONE.id_zone as id_zone, ZONE.zone as zone_name, STATE.id_land_state, STATE.name AS land_state_name FROM TB_LAND AS LAND INNER JOIN TB_ZONE AS ZONE ON LAND.id_zone = ZONE.id_zone INNER JOIN TB_LAND_STATE AS STATE ON LAND.id_land_state = STATE.id_land_state WHERE LAND.id_land = :id_land";
                $result = $conexion->prepare($query);
                $result->execute([':id_land'=>(int) $id]);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                if(count($data) == 1){
                    $object = new Land(                        
                        $data[0]["id_land"],
                        $data[0]["number"],
                        $data[0]["price"],
                        $data[0]["id_zone"],
                        $data[0]["zone_name"],
                        $data[0]["perimeter"],
                        $data[0]["peri_top"],
                        $data[0]["peri_right"],
                        $data[0]["peri_bottom"],
                        $data[0]["peri_left"],
                        $data[0]["id_land_state"],
                        $data[0]["land_state_name"],
                     );                     
                        return $object->serialize();                 
                }else{
                    throw new Exception("Sale State no encontrado"); // empty object
                }     
            } catch(Exception $e){               
                throw new Exception($e->getMessage());
            }  
        }

        function land_availability($lands){            
            $conexion = $this->Connect();
            $resp = true;
            foreach($lands as $item){  
                //buscamos si tiene el estado 1 : EN VENTA                
                $query = "SELECT * FROM TB_LAND WHERE id_land = :id_land AND id_land_state = :id_land_state;";
                $result = $conexion->prepare($query);
                $result->execute([
                    ":id_land" => $item["id_land"],
                    ":id_land_state" => 1,
                    ]);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);                
                if(count($data) == 0){                   
                    $resp = false;                   
                    break;
                }
            }
            return $resp;
        }

        function update_lands_state($lands){
            try{                                
                $conexion = $this->Connect();
                foreach($lands as $item){                      
                    $execute = [":id_land"=> (int) $item["id_land"]];
                    $query = "UPDATE TB_LAND SET id_land_state = :id_land_state WHERE id_land = :id_land;";                                                                                        
                    $result = $conexion->prepare($query);    
                    // 1 = al contado / 2 en partes
                    if((int)$item["id_payment_method"] == 1){                        
                        // vendido : ya tiene dueño
                        $execute["id_land_state"] = 2;
                    }else{
                        //separado : tiene dueño pero sigue pagando
                        $execute["id_land_state"] = 3;
                    }                    
                    var_dump($execute);
                    //$result->execute($execute);                                            
                }                                      
                 return true;
            }   
            catch(Exception $e){            
               throw new Exception($e->getMessage());
            }        
        }

        function update(){}

        function delete(){}
        
    }

?>
