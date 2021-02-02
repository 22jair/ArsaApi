<?php
// TB_SALE
Class Sale{

    private $id_sale;
    private $date_sale;
    private $payment_type;    
    private $comment;
    private $net_amount = 0.0;
    private $total_commission = 0.0;
    private $total_amount = 0.0;    
    private $sale_state;
    private $at_created;
    private $at_updated;

    function __construct($id_sale, $date_sale, $comment, $net_amount, $total_commission, $total_amount, $payment_type, $sale_state, $at_created, $at_updated)
    {
        $this->id_sale = $id_sale;
        $this->date_sale = $date_sale;
        $this->comment = $comment;
        $this->net_amount = $net_amount;
        $this->total_commission = $total_commission;
        $this->total_amount = $total_amount;
        $this->payment_type = $payment_type;
        $this->sale_state = $sale_state;
        $this->at_created = $at_created;
        $this->at_updated = $at_updated;
    }

    function serialize(){
        return get_object_vars($this);
    }    

    /**
     * Get the value of id_sale
     */ 
    public function getId_sale()
    {
        return $this->id_sale;
    }

    /**
     * Set the value of id_sale
     *
     * @return  self
     */ 
    public function setId_sale($id_sale)
    {
        $this->id_sale = $id_sale;

        return $this;
    }

    /**
     * Get the value of date_sale
     */ 
    public function getDate_sale()
    {
        return $this->date_sale;
    }

    /**
     * Set the value of date_sale
     *
     * @return  self
     */ 
    public function setDate_sale($date_sale)
    {
        $this->date_sale = $date_sale;

        return $this;
    }

    /**
     * Get the value of comment
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of net_amount
     */ 
    public function getNet_amount()
    {
        return $this->net_amount;
    }

    /**
     * Set the value of net_amount
     *
     * @return  self
     */ 
    public function setNet_amount($net_amount)
    {
        $this->net_amount = $net_amount;

        return $this;
    }

    /**
     * Get the value of total_amount
     */ 
    public function getTotal_amount()
    {
        return $this->total_amount;
    }

    /**
     * Set the value of total_amount
     *
     * @return  self
     */ 
    public function setTotal_amount($total_amount)
    {
        $this->total_amount = $total_amount;

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
     * Get the value of payment_type
     */ 
    public function getPayment_type()
    {
        return $this->payment_type;
    }

    /**
     * Set the value of payment_type
     *
     * @return  self
     */ 
    public function setPayment_type($payment_type)
    {
        $this->payment_type = $payment_type;

        return $this;
    }

    /**
     * Get the value of sale_state
     */ 
    public function getSale_state()
    {
        return $this->sale_state;
    }

    /**
     * Set the value of sale_state
     *
     * @return  self
     */ 
    public function setSale_state($sale_state)
    {
        $this->sale_state = $sale_state;

        return $this;
    }

    /**
     * Get the value of total_commission
     */ 
    public function getTotal_commission()
    {
        return $this->total_commission;
    }

    /**
     * Set the value of total_commission
     *
     * @return  self
     */ 
    public function setTotal_commission($total_commission)
    {
        $this->total_commission = $total_commission;

        return $this;
    }
}