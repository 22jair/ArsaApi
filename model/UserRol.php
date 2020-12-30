<?php
// TB_USER_ROL
Class UserRol{

    private $id_user;
    private $id_rol;
    
    function __construct($id_user, $id_rol)
    {
        $this->id_user = $id_user;
        $this->id_rol = $id_rol;
    }

    function serialize(){
        return get_object_vars($this);
    }

}