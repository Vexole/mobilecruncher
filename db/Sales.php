<?php
require_once("Database.php");
require_once("Queries.php");

class Sales
{
    protected $cartId;
    protected $total;
    protected $paymentMethodId;
    protected $billingAddressId;
    protected $errors = [];
    protected $pdo;

    public function __construct($cartId, $total, $paymentMethodId, $billingAddressId)
    {
        $this->setCartId($cartId);
        $this->setTotal($total);
        $this->setPaymentMethodId($paymentMethodId);
        $this->setBillingAddressId($billingAddressId);
        $this->pdo = Database::getConnection();
    }

    public function setCartId($cartId)
    {
        if (!is_numeric($cartId) || $cartId <= 0) {
            $this->errors['cartId'] = "Cart ID must be a positive integer.";
        } else {
            $this->cartId = $cartId;
        }
    }

    public function getCartId()
    {
        return $this->cartId;
    }

    public function setTotal($total)
    {
        if (!is_numeric($total) || $total <= 0) {
            $this->errors['total'] = "Total must be a positive number.";
        } else {
            $this->total = $total;
        }
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setPaymentMethodId($paymentMethodId)
    {
        if (!is_numeric($paymentMethodId) || $paymentMethodId <= 0) {
            $this->errors['paymentMethodId'] = "Payment method ID must be a positive integer.";
        } else {
            $this->paymentMethodId = $paymentMethodId;
        }
    }

    public function getPaymentMethodId()
    {
        return $this->paymentMethodId;
    }

    public function setBillingAddressId($billingAddressId)
    {
        if (!is_numeric($billingAddressId) || $billingAddressId <= 0) {
            $this->errors['billingAddressId'] = "Billing address ID must be a positive integer.";
        } else {
            $this->billingAddressId = $billingAddressId;
        }
    }

    public function getBillingAddressId()
    {
        return $this->billingAddressId;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }

    public function saveSalesDetail()
    {
        $stmt = $this->pdo->prepare(Queries::$saveSaleDetails);
        $stmt->execute([
            "cartId" => $this->cartId,
            "total" => $this->total,
            "paymentMethodId" => $this->paymentMethodId,
            "billingAddressId" => $this->billingAddressId
        ]);
    }
}
