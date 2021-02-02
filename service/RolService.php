<?php

include_once __DIR__.'./../db/conexion.php';
    include __DIR__.'./../model/Rol.php';

    class RolService extends Conexion {
        
        function __construct(){}
        
        function getAll(){
            try{
                $dataList = array();
                $conexion = $this->Connect();
                $query = "SELECT * FROM TB_ROL";
                $result = $conexion->prepare($query);
                $result->execute();
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($data as $item){
                    $rol = new Rol(                        
                        $item["id_rol"],
                        $item["rol"],
                        $item["description"],
                        $item["state"]
                     );
                     
                     $dataList[] = $rol->serialize();
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

        function getByIdUser($id_user){
            try{

                $conexion = $this->Connect();
                $query = "SELECT ROL.* FROM TB_ROL as ROL
                INNER JOIN TB_USER_ROL as UR ON UR.id_rol = ROL.id_rol
                INNER JOIN TB_USER AS USER ON UR.id_user = USER.id_user
                WHERE USER.id_user = :id_user";
                $result = $conexion->prepare($query);
                $result->execute([':id_user'=>(int) $id_user]);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);

                $dataList = array();

                foreach($data as $item){
                    $rol = new Rol(                        
                        $item["id_rol"],
                        $item["rol"],
                        $item["description"],
                        $item["state"]
                     );
                     $dataList[] = $rol->serialize();
                }
                return $dataList;
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
