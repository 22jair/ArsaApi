<?php
// TB_PAYMENT_TYPE
Class PaymentType{

    private $id_payment_type;
    private $name;
    private $description;
    private $state;


    function __construct($id_payment_type, $name, $description, $state)
    {
        $this->id_payment_type = $id_payment_type;
        $this->name = $name;
        $this->description = $description;
        $this->state = $state;
    }

    function serialize(){
        return get_object_vars($this);
    }
    
    

    /**
     * Get the value of id_payment_type
     */ 
    public function getId_payment_type()
    {
        return $this->id_payment_type;
    }

    /**
     * Set the value of id_payment_type
     *
     * @return  self
     */ 
    public function setId_payment_type($id_payment_type)
    {
        $this->id_payment_type = $id_payment_type;

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
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

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
}