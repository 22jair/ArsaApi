<?php
// TB_USER
Class User  {

    private $id_user;
    private $name;
    private $father_name;
    private $mother_name;
    private $dni;
    private $dni_url;
    private $birthdate;
    private $phone_number;
    private $address_reference;
    private $email;
    private $username;
    private $password;
    private $state;
    private $roles;
    //private $id_rol;
    private $at_created;
    private $at_updated;    


    public function __construct($id_user, $name, $father_name, $mother_name, $dni, $dni_url, $birthdate, $phone_number, $address_reference, $email, $username, $password, $state, $roles ,$at_created, $at_updated){
        $this->id_user = $id_user;
        $this->name = $name;
        $this->father_name = $father_name;
        $this->mother_name = $mother_name;
        $this->dni = $dni;
        $this->dni_url = $dni_url;
        $this->birthdate = $birthdate;
        $this->phone_number = $phone_number;
        $this->address_reference = $address_reference;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->state = $state;
        $this->roles = $roles;
        //$this->id_rol = $id_rol;
        $this->at_created = $at_created;
        $this->at_updated = $at_updated;
    }

    function serialize(){
        return get_object_vars($this);
    }

    /**
     * Get the value of id_user
     */ 
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @return  self
     */ 
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of father_name
     */ 
    public function getFather_name()
    {
        return $this->father_name;
    }

    /**
     * Set the value of father_name
     *
     * @return  self
     */ 
    public function setFather_name($father_name)
    {
        $this->father_name = $father_name;

        return $this;
    }

    /**
     * Get the value of mother_name
     */ 
    public function getMother_name()
    {
        return $this->mother_name;
    }

    /**
     * Set the value of mother_name
     *
     * @return  self
     */ 
    public function setMother_name($mother_name)
    {
        $this->mother_name = $mother_name;

        return $this;
    }

    /**
     * Get the value of dni
     */ 
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set the value of dni
     *
     * @return  self
     */ 
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get the value of dni_url
     */ 
    public function getDni_url()
    {
        return $this->dni_url;
    }

    /**
     * Set the value of dni_url
     *
     * @return  self
     */ 
    public function setDni_url($dni_url)
    {
        $this->dni_url = $dni_url;

        return $this;
    }

    /**
     * Get the value of birthdate
     */ 
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set the value of birthdate
     *
     * @return  self
     */ 
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get the value of phone_number
     */ 
    public function getPhone_number()
    {
        return $this->phone_number;
    }

    /**
     * Set the value of phone_number
     *
     * @return  self
     */ 
    public function setPhone_number($phone_number)
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    /**
     * Get the value of address_reference
     */ 
    public function getAddress_reference()
    {
        return $this->address_reference;
    }

    /**
     * Set the value of address_reference
     *
     * @return  self
     */ 
    public function setAddress_reference($address_reference)
    {
        $this->address_reference = $address_reference;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }


    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of state
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @return  self
     */ 
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get the value of at_created
     */ 
    public function getAt_created()
    {
        return $this->at_created;
    }

    /**
     * Set the value of at_created
     *
     * @return  self
     */ 
    public function setAt_created($at_created)
    {
        $this->at_created = $at_created;

        return $this;
    }

    /**
     * Get the value of at_updated
     */ 
    public function getAt_updated()
    {
        return $this->at_updated;
    }

    /**
     * Set the value of at_updated
     *
     * @return  self
     */ 
    public function setAt_updated($at_updated)
    {
        $this->at_updated = $at_updated;

        return $this;
    }   

     /**
     * Get the value of roles
     */ 
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set the value of at_updated
     *
     * @return  self
     */ 
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    } 


}