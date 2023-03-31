<?php

class Receipt
{
    protected $firstName;
    protected $lastName;
    protected $paymentMode;
    protected $items = [];
    protected $tax;
    protected $total;

    public function __construct(
        $firstName,
        $lastName,
        $paymentMode,
        $items,
        $tax,
        $total
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->paymentMode = $paymentMode;
        $this->items = $items;
        $this->tax = $tax;
        $this->total = $total;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }
    public function getLastName()
    {
        return $this->lastName;
    }
    public function getPaymentMode()
    {
        return $this->paymentMode;
    }
    public function getitems()
    {
        return $this->items;
    }
    public function getTax()
    {
        return $this->tax;
    }
    public function getTotal()
    {
        return $this->total;
    }
}
