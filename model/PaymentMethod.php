<?php
// TB_PAYMENT_METHOD
Class PaymentMethod{

    private $id_payment_method;
    private $name;
    private $description;
    private $state;


    function __construct($id_payment_method, $name, $description, $state)
    {
        $this->id_payment_method = $id_payment_method;
        $this->name = $name;
        $this->description = $description;
        $this->state = $state;
    }

    function serialize(){
        return get_object_vars($this);
    }
    
    

    /**
     * Get the value of id_payment_method
     */ 
    public function getId_payment_method()
    {
        return $this->id_payment_method;
    }

    /**
     * Set the value of id_payment_method
     *
     * @return  self
     */ 
    public function setId_payment_method($id_payment_method)
    {
        $this->id_payment_method = $id_payment_method;

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