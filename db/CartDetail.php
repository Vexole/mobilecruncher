<?php

class CartDetail {
    protected $cartId;
    protected $productId;
    protected $quantity;
    protected $name;
    protected $price;
    protected $imagePath;

    public function __construct($cartId = null, $productId, $quantity, $name, $price, $imagePath) {
        $this->cartId = $cartId;
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->name = $name;
        $this->price = $price;
        $this->imagePath = $imagePath;
    }
    
    public function getCartId() {
        return $this->cartId;
    }
    
    public function setCartId($cartId) {
        $this->cartId = $cartId;
    }
    
    public function getProductId() {
        return $this->productId;
    }
    
    public function setProductId($productId) {
        $this->productId = $productId;
    }
    
    public function getQuantity() {
        return $this->quantity;
    }
    
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }

    public function getPrice() {
        return $this->price;
    }
    
    public function setPrice($price) {
        $this->price = $price;
    }

    public function getImagePath() {
        return $this->imagePath;
    }
    
    public function setImagePath($imagePath) {
        $this->imagePath = $imagePath;
    }
}