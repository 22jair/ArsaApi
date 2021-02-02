<?php
    
    include_once __DIR__.'./../service/UserService.php';
    include_once __DIR__.'./../model/User.php';

    class UserController{

        private $service;

        function __construct() {
            $this->service = new UserService();
        }

        function getAll(){
            try{                
                $data = $this->service->getAll();
                //var_dump($data);
                echo json_encode($data);                
            }   
            catch(Exception $e){
                http_response_code(404);
                echo json_encode(["message"=>$e->getMessage()]);
            }            
        }

        function getById($id_usuario){
            try{
                $data = $this->service->getById((int) $id_usuario);              
                echo json_encode($data);                
            }   
            catch(Exception $e){
                http_response_code(404);
                echo json_encode(["message"=>$e->getMessage()]);
            }            
        }

        function getByDNI($dni){
            try{
                $data = $this->service->getByDNI($dni);              
                echo json_encode($data);                
            }   
            catch(Exception $e){
                http_response_code(404);
                echo json_encode(["message"=>$e->getMessage()]);
            }            
        }

        function add($data, $file){                   
            try{ 
                // isset($data["mother_name"]) NO TODOS TIENEN 2 APELLIDOS
                if(isset($data["name"]) && isset($data["father_name"]) && isset($data["dni"]) && isset($data["birthdate"]) && isset($data["roles"]) ){
                    if(strlen($data["name"]) <= 0) throw new Exception("Ingrese un nombre");
                    if(strlen($data["father_name"]) <= 0) throw new Exception("Ingrese apellido paterno");
                    // if(strlen($data["mother_name"]) <= 0) throw new Exception("Ingrese apellido materno");
                    if(strlen($data["dni"]) <= 0) throw new Exception("Ingrese el DNI");
                    if(strlen($data["birthdate"]) <= 0) throw new Exception("Ingrese fecha de nacimiento");
                    if( count($data["roles"]) == 0 ) throw new Exception("Ingrese un rol correcto");                    
                    $data["username"] = $data["dni"];   
                    $data["dni_url"] = '';
                    if($file !== null) $data["dni_url"] = $data["dni"].".jpg";
                    
                    $user = new User(                        
                            null,
                            $data["name"],
                            $data["father_name"],
                            $data["mother_name"],
                            $data["dni"],
                            $data["dni_url"],
                            $data["birthdate"],
                            $data["phone_number"],
                            $data["address_reference"],
                            $data["email"],
                            $data["username"],
                            "123",//null,
                            '1',
                            $data["roles"],
                            null,
                            null
                         );                     

                    if($this->service->add($user)){  
                        if($file !== null) $this->saveDniImg($file, $data["dni_url"]);
                        echo  json_encode(["message"=>"Usuario registrado correctamente"]); 
                    }else{ throw new Exception("Error en el registro de datos"); }  
                        
                }else{
                    throw new Exception("Ingrese los campos correctos");
                }
               
            }   
            catch(Exception $e){    
                http_response_code(404);
                echo json_encode(["message"=>$e->getMessage()]);                
            }  

        }

        function update($data, $file){
             try{
                if(isset($data["id_user"]) && isset($data["name"]) && isset($data["father_name"]) && isset($data["dni"]) && isset($data["birthdate"]) && isset($data["roles"]) ){
                    if(strlen($data["name"]) <= 0) throw new Exception("Ingrese un nombre");
                    if(strlen($data["father_name"]) <= 0) throw new Exception("Ingrese apellido paterno");
                    //if(strlen($data["mother_name"]) <= 0) throw new Exception("Ingrese apellido materno");
                    if(strlen($data["dni"]) <= 0) throw new Exception("Ingrese el DNI");
                    if(strlen($data["birthdate"]) <= 0) throw new Exception("Ingrese fecha de nacimiento");
                    //if(strlen($data["username"]) <= 0) throw new Exception("Ingrese un nombre de usuario");
                    //if(count($data["id_rol"]) <= 0) throw new Exception("Ingrese un rol al usuario");
                    if( count($data["roles"]) == 0 ) throw new Exception("Ingrese un rol correcto");                    
                    
                    $data["username"] = $data["dni"];  
                    if($file !== null) $data["dni_url"] = $data["dni"].".jpg";

                    $user = new User(                        
                            $data["id_user"],
                            $data["name"],
                            $data["father_name"],
                            $data["mother_name"],
                            $data["dni"],
                            $data["dni_url"],
                            $data["birthdate"],
                            $data["phone_number"],
                            $data["address_reference"],
                            $data["email"],
                            $data["username"],
                            "123",                            
                            $data["state"],                            
                            $data["roles"],
                            null,
                            null
                         ); 

                    //echo json_encode($data);                
                    if($this->service->update($user)){
                        if($file !== null) $this->saveDniImg($file, $data["dni_url"]);
                        echo json_encode(["message"=>"Usuario actualizado correctamente"]); 
                    } else{ throw new Exception("Error en el registro de datos"); }  
                        
                }else{
                    throw new Exception("Ingrese los campos correctos");
                }
               
            }   
            catch(Exception $e){
                http_response_code(404);
                echo json_encode(["message"=>$e->getMessage()]);
            }  
        }

        function delete($id_usuario, $id_admin){            
            try{
                if($this->service->delete($id_usuario, $id_admin)) 
                    echo  json_encode(["message"=>"Usuario desactivado correctamente"]); 
                else  
                    throw new Exception("Error en el proceso de desactivación");
            }   
            catch(Exception $e){
                http_response_code(404);
                echo json_encode(["message"=>$e->getMessage()]);
            }  
        }

        private function saveDniImg($file, $name){
            move_uploaded_file($file['tmp_name'], 'storage/user/'.$name);
        }
        
    }

?>
