<?php
// TB_ZONE
Class Zone{

    private $id_zone;
    private $zone;
    private $perimeter;
    private $lands;
    private $listLands;

    function __construct($id_zone, $zone, $perimeter, $lands, $listLands)
    {
        $this->id_zone = $id_zone;
        $this->zone = $zone;
        $this->perimeter = $perimeter;
        $this->lands = $lands;
        $this->listLands = $listLands;
    }

    function serialize(){
        return get_object_vars($this);
    }

    /**
     * Get the value of id_zone
     */ 
    public function getId_zone()
    {
        return $this->id_zone;
    }

    /**
     * Set the value of id_zone
     *
     * @return  self
     */ 
    public function setId_zone($id_zone)
    {
        $this->id_zone = $id_zone;

        return $this;
    }

    /**
     * Get the value of zone
     */ 
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * Set the value of zone
     *
     * @return  self
     */ 
    public function setZone($zone)
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * Get the value of perimeter
     */ 
    public function getPerimeter()
    {
        return $this->perimeter;
    }

    /**
     * Set the value of perimeter
     *
     * @return  self
     */ 
    public function setPerimeter($perimeter)
    {
        $this->perimeter = $perimeter;

        return $this;
    }

    /**
     * Get the value of lands
     */ 
    public function getLands()
    {
        return $this->lands;
    }

    /**
     * Set the value of lands
     *
     * @return  self
     */ 
    public function setLands($lands)
    {
        $this->lands = $lands;

        return $this;
    }

    /**
     * Get the value of listLands
     */ 
    public function getListLands()
    {
        return $this->listLands;
    }

    /**
     * Set the value of listLands
     *
     * @return  self
     */ 
    public function setListLands($listLands)
    {
        $this->listLands = $listLands;

        return $this;
    }
}