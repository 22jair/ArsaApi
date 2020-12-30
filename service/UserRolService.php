<?php

include_once __DIR__.'./../db/conexion.php';
    include __DIR__.'./../model/UserRol.php';

    class UserRolService extends Conexion {
        
        function __construct(){}
             
       function add(array $roles){
    
        var_dump($roles);
        // foreach($roles as $item){
        //     $query = "INSERT INTO TB_USER_ROL VALUES (:id_user, :id_rol);";
        //     $result = $conexion->prepare($query);
        //     $result->execute(
        //         [
        //             ":id_user"=>$user->getId_user(),
        //             ":id_rol"=>$item["id_rol"]
        //         ]
        //     );  
        // }
       }

     
    }

?>
