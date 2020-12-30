<?php
// TB_SALE
Class Sale{

    private $id_sale;
    private $date_sale;
    private $id_payment_type;
    private $payment_type_name;
    private $comment;
    private $remaining_payment = 0.0;
    private $total_amount = 0.0;
    private $id_sale_state;
    private $sale_state_name;
    private $at_created;
    private $at_updated;

    function __construct($id_sale, $date_sale, $id_payment_type, $payment_type_name, $comment, $remaining_payment, $total_amount, $id_sale_state, $sale_state_name, $at_created, $at_updated)
    {
        $this->id_sale = $id_sale;
        $this->date_sale = $date_sale;
        $this->id_payment_type = $id_payment_type;
        $this->payment_type_name = $payment_type_name;
        $this->comment = $comment;
        $this->remaining_payment = $remaining_payment;
        $this->total_amount = $total_amount;
        $this->id_sale_state = $id_sale_state;
        $this->sale_state_name = $sale_state_name;
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
     * Get the value of remaining_payment
     */ 
    public function getRemaining_payment()
    {
        return $this->remaining_payment;
    }

    /**
     * Set the value of remaining_payment
     *
     * @return  self
     */ 
    public function setRemaining_payment($remaining_payment)
    {
        $this->remaining_payment = $remaining_payment;

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
     * Get the value of payment_type_name
     */ 
    public function getPayment_type_name()
    {
        return $this->payment_type_name;
    }

    /**
     * Set the value of payment_type_name
     *
     * @return  self
     */ 
    public function setPayment_type_name($payment_type_name)
    {
        $this->payment_type_name = $payment_type_name;

        return $this;
    }

    /**
     * Get the value of sale_state_name
     */ 
    public function getSale_state_name()
    {
        return $this->sale_state_name;
    }

    /**
     * Set the value of sale_state_name
     *
     * @return  self
     */ 
    public function setSale_state_name($sale_state_name)
    {
        $this->sale_state_name = $sale_state_name;

        return $this;
    }
}