<?php
// TB_PAYMENT_METHOD
Class Document{

    private $id_document;
    private $title;
    private $description;
    private $state;


    function __construct($id_document, $title, $description, $state)
    {
        $this->id_document = $id_document;
        $this->title = $title;
        $this->description = $description;
        $this->state = $state;
    }

    function serialize(){
        return get_object_vars($this);
    }
    
    

    /**
     * Get the value of id_document
     */ 
    public function getId_document()
    {
        return $this->id_document;
    }

    /**
     * Set the value of id_document
     *
     * @return  self
     */ 
    public function setId_document($id_document)
    {
        $this->id_document = $id_document;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

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