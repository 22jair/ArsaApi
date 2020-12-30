<?php
// TB_SALE_STATE
Class SaleState{

    private $id_sale_state;
    private $name;
    private $description;
    private $state;


    function __construct($id_sale_state, $name, $description, $state)
    {
        $this->id_sale_state = $id_sale_state;
        $this->name = $name;
        $this->description = $description;
        $this->state = $state;
    }

    function serialize(){
        return get_object_vars($this);
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
     * Get the value of id_sale_state
     */ 
    public function getId_sale_state()
    {
        return $this->id_sale_state;
    }

    /**
     * Set the value of id_sale_state
     *
     * @return  self
     */ 
    public function setId_sale_state($id_sale_state)
    {
        $this->id_sale_state = $id_sale_state;

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