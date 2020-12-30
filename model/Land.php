<?php
// TB_LAND
Class Land{

    private $id_land;
    private $number;
    private $price;
    private $id_zone;
    private $zone_name;
    private $perimeter;
    private $peri_top;
    private $peri_right;
    private $peri_bottom;
    private $peri_left;
    private $id_land_state;
    private $land_state_name;

    function __construct($id_land, $number, $price, $id_zone, $zone_name,  $perimeter, $peri_top, $peri_right, $peri_left, $peri_bottom, $id_land_state, $land_state_name)
    {
        $this->id_land = $id_land;
        $this->number = $number;
        $this->price = $price;
        $this->id_zone = $id_zone;
        $this->zone_name = $zone_name;
        $this->perimeter = $perimeter;
        $this->peri_top = $peri_top;
        $this->peri_right = $peri_right;
        $this->peri_bottom = $peri_bottom;
        $this->peri_left = $peri_left;
        $this->id_land_state = $id_land_state;
        $this->land_state_name = $land_state_name;
    }

    function serialize(){
        return get_object_vars($this);
    }

   

    /**
     * Get the value of id_land
     */ 
    public function getId_land()
    {
        return $this->id_land;
    }

    /**
     * Set the value of id_land
     *
     * @return  self
     */ 
    public function setId_land($id_land)
    {
        $this->id_land = $id_land;

        return $this;
    }

    /**
     * Get the value of number
     */ 
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @return  self
     */ 
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
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
     * Get the value of zone_name
     */ 
    public function getZone_name()
    {
        return $this->zone_name;
    }

    /**
     * Set the value of zone_name
     *
     * @return  self
     */ 
    public function setZone_name($zone_name)
    {
        $this->zone_name = $zone_name;

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
     * Get the value of peri_top
     */ 
    public function getPeri_top()
    {
        return $this->peri_top;
    }

    /**
     * Set the value of peri_top
     *
     * @return  self
     */ 
    public function setPeri_top($peri_top)
    {
        $this->peri_top = $peri_top;

        return $this;
    }

    /**
     * Get the value of peri_right
     */ 
    public function getPeri_right()
    {
        return $this->peri_right;
    }

    /**
     * Set the value of peri_right
     *
     * @return  self
     */ 
    public function setPeri_right($peri_right)
    {
        $this->peri_right = $peri_right;

        return $this;
    }

    /**
     * Get the value of peri_bottom
     */ 
    public function getPeri_bottom()
    {
        return $this->peri_bottom;
    }

    /**
     * Set the value of peri_bottom
     *
     * @return  self
     */ 
    public function setPeri_bottom($peri_bottom)
    {
        $this->peri_bottom = $peri_bottom;

        return $this;
    }

    /**
     * Get the value of peri_left
     */ 
    public function getPeri_left()
    {
        return $this->peri_left;
    }

    /**
     * Set the value of peri_left
     *
     * @return  self
     */ 
    public function setPeri_left($peri_left)
    {
        $this->peri_left = $peri_left;

        return $this;
    }

    /**
     * Get the value of id_land_state
     */ 
    public function getId_land_state()
    {
        return $this->id_land_state;
    }

    /**
     * Set the value of id_land_state
     *
     * @return  self
     */ 
    public function setId_land_state($id_land_state)
    {
        $this->id_land_state = $id_land_state;

        return $this;
    }

    /**
     * Get the value of land_state_name
     */ 
    public function getLand_state_name()
    {
        return $this->land_state_name;
    }

    /**
     * Set the value of land_state_name
     *
     * @return  self
     */ 
    public function setLand_state_name($land_state_name)
    {
        $this->land_state_name = $land_state_name;

        return $this;
    }
}