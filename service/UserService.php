<?php

    include_once __DIR__.'./../db/conexion.php';
    include_once __DIR__.'./../model/User.php';
    include_once __DIR__.'./../service/RolService.php';
    include_once __DIR__.'./../service/UserRolService.php';

    class UserService extends Conexion {
        
        private $service_rol;
        private $service_user_rol;

        function __construct(){
            $this->service_rol = new RolService();
            $this->service_user_rol = new UserRolService();            
        }
        
        function getAll(){
            try{            
                $conexion = $this->Connect();
                $query = "SELECT * FROM TB_USER";
                $result = $conexion->prepare($query);
                $result->execute();
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                
                $dataList = array();
                foreach($data as $item){
                    $user = new User(                        
                        $item["id_user"],
                        $item["name"],
                        $item["father_name"],
                        $item["mother_name"],
                        $item["dni"],
                        $item["dni_url"],
                        $item["birthdate"],
                        $item["phone_number"],
                        $item["address_reference"],
                        $item["email"],
                        $item["username"],
                        null,
                        $item["state"],
                        //$this->service_rol->getByIdUser($item["id_user"]),
                        $this->service_rol->getByIdUser($item["id_user"]),
                        null,
                        null
                     );                    
                    $dataList[] = $user->serialize();                 
                }                
                return $dataList;
            }   
            catch(Exception $e){
                //NO RETORNAMOS EL MENSAJE POR QUE EL USUARIO NO DEBE SABER Q ERROR TIENE LA BD
                //return $e->getMessage();
               // throw new Exception("Error en el Sistema");
               throw new Exception($e->getMessage());
            }            
        }

        function getById($id_user){
            try{
                $conexion = $this->Connect();
                $query = "SELECT * FROM TB_USER WHERE id_user = :id_user";
                $result = $conexion->prepare($query);
                $result->execute([':id_user'=>(int) $id_user]);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                if(count($data) == 1){
                    $user = new User(                        
                        $data[0]["id_user"],
                        $data[0]["name"],
                        $data[0]["father_name"],
                        $data[0]["mother_name"],
                        $data[0]["dni"],
                        $data[0]["dni_url"],
                        $data[0]["birthdate"],
                        $data[0]["phone_number"],
                        $data[0]["address_reference"],
                        $data[0]["email"],
                        $data[0]["username"],
                        null,
                        $data[0]["state"],                        
                        $this->service_rol->getByIdUser($data[0]["id_user"]),
                        $data[0]["at_created"],                        
                        null
                        );                    
                        return $user->serialize();                 
                }else{
                    throw new Exception("Usuario no encontrado"); // empty object
                }                                 
            }   
            catch(Exception $e){
                //return $e->getMessage();
                //throw new Exception("Error en el Sistema");
                throw new Exception($e->getMessage());
            }            
        }
        // si no encuentra retorna una clase vacia
        function getByDNI($dni){
            try{
                $conexion = $this->Connect();
                $query = "SELECT * FROM TB_USER WHERE dni = :dni";
                $result = $conexion->prepare($query);
                $result->execute([':dni'=>(int) $dni]);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                if(count($data) == 1){
                    $user = new User(                        
                        $data[0]["id_user"],
                        $data[0]["name"],
                        $data[0]["father_name"],
                        $data[0]["mother_name"],
                        $data[0]["dni"],
                        $data[0]["dni_url"],
                        $data[0]["birthdate"],
                        $data[0]["phone_number"],
                        $data[0]["address_reference"],
                        $data[0]["email"],
                        $data[0]["username"],
                        null,
                        $data[0]["state"],
                        //$this->service_rol->getByIdUser($data[0]["id_user"]),
                        null,
                        null,
                        null
                        );                    
                        return $user->serialize();                 
                }else{
                    return new stdClass(); // empty object
                }       
             
            }   
            catch(Exception $e){
                //return $e->getMessage();
                //throw new Exception("Error en el Sistema");
                throw new Exception($e->getMessage());
            }            
        }

        function add(User $user){

            try{            
                $conexion = $this->Connect();
                $conexion->beginTransaction();
                
                $query = "INSERT INTO TB_USER VALUES (NULL, :name, :father_name, :mother_name, :dni, :dni_url, :birthdate, :phone_number, :address_reference, :email, :username, :password, :state, NULL, NULL);";
                //echo $query;
                $result = $conexion->prepare($query);
                $result->execute(
                    [
                        ":name"=>$user->getName(),
                        ":father_name"=>$user->getFather_name(),
                        ":mother_name"=>$user->getMother_name(),
                        ":dni"=>(int)$user->getDni(),
                        ":dni_url"=>$user->getDni_url(),
                        ":birthdate"=>$user->getBirthdate(),
                        ":phone_number"=>$user->getPhone_number(),
                        ":address_reference"=>$user->getAddress_reference(),
                        ":email"=>$user->getEmail(),           
                        ":username"=>$user->getUsername(),                                          
                        ":password"=>$user->getPassword(),
                        ":state"=>$user->getState()
                    ]
                ); 

                $lastId = $conexion->lastInsertId();
                
                foreach($user->getRoles() as $item){

                    $query = "INSERT INTO TB_USER_ROL VALUES (:id_user, :id_rol);";    
                    $result = $conexion->prepare($query);
                    $result->execute(
                        [
                            ":id_user"=>(int) $lastId,
                            ":id_rol"=>(int) $item->id_rol                          
                        ]
                    );  
                }
                
            
                $conexion->commit();
                return true;
            }   
            catch(Exception $e){     
                $conexion->rollBack();                
               throw new Exception($e->getMessage());
            }                                 
        }

        function update(User $user){
            try{
                
                $current_user_by_dni = $this->getByDNI($user->getDni());
                $current_user = $this->getById($user->getId_user());
                //validamos si el DNI esta en uso
                if( is_array($current_user_by_dni) && $current_user_by_dni["dni"] != $current_user["dni"]) throw new Exception("DNI en uso");

                $data_update = [
                    ":name"=>$user->getName(),
                    ":father_name"=>$user->getFather_name(),
                    ":mother_name"=>$user->getMother_name(),
                   //dni ,
                    ":dni_url" => $user->getDni_url(),
                    ":birthdate"=>$user->getBirthdate(),
                    ":phone_number"=>$user->getPhone_number(),
                    ":address_reference"=>$user->getAddress_reference(),
                    ":email"=>$user->getEmail(),           
                 //username                     
                    ":password"=>$user->getPassword(),
                    ":state"=>$user->getState(),
                    ":id_user"=>$user->getId_user(),                    
                ];
                
                $conexion = $this->Connect();
                
                $query = "UPDATE TB_USER SET 
                                            name = :name,
                                            father_name = :father_name,
                                            mother_name = :mother_name, 
                                            dni_url = :dni_url,                                         
                                            birthdate = :birthdate,
                                            phone_number = :phone_number,
                                            address_reference = :address_reference,
                                            email = :email,
                                            password = :password,
                                            state = :state";  

                if($current_user["dni"] !== $user->getDni()){
                    $query .=  ", dni = :dni, username = :username";
                    $data_update[":dni"] = (int) $user->getDni();                    
                    $data_update[":username"] = $user->getUsername();
                }; 

                $query .= " WHERE id_user = :id_user;";                   
              
                $result = $conexion->prepare($query);
                $result->execute($data_update);   
                

                //limpiamos roles y seteamos
                $query = "delete from tb_user_rol where id_user= :id_user;";  
                $result = $conexion->prepare($query);
                $result->execute([":id_user"=>$user->getId_user()]);

                foreach($user->getRoles() as $item){
                    $query = "INSERT INTO TB_USER_ROL VALUES (:id_user, :id_rol);";    
                    $result = $conexion->prepare($query);
                    $result->execute(
                        [
                            ":id_user"=>$user->getId_user(),
                            ":id_rol"=>(int) $item->id_rol                          
                        ]
                    );  
                }




                 return true;
            }   
            catch(Exception $e){            
               throw new Exception($e->getMessage());
            }        
        }

        function delete($id_user, $id_admin){
            try{            
                if( !$this->isAdmin($id_admin)) throw new Exception("No tiene parmisos");
                
                $conexion = $this->Connect();
                $query = "UPDATE TB_USER SET state = :state WHERE id_user = :id_user";
                $result = $conexion->prepare($query);
                $result->execute([
                    ":state"=>'0',
                    ":id_user"=>(int)$id_user
                    ]);
               
                return true;
            }   
            catch(Exception $e){
                //NO RETORNAMOS EL MENSAJE POR QUE EL USUARIO NO DEBE SABER Q ERROR TIENE LA BD
                //return $e->getMessage();
               // throw new Exception("Error en el Sistema");
               throw new Exception($e->getMessage());
            }            
        }

        private function isAdmin($id_user){
            $user = $this->getById($id_user);
            if($user["id_rol"] == '1'){
                return true;
            }else{
                return false;
            }
        }
        

    }

?>
