<?php
require_once("Database.php");
require_once("Queries.php");

class Payment
{
    protected $id;
    protected $name;
    protected $pdo;
    protected $errors = [];

    public function __construct($id = null, $name = null)
    {
        $this->setId($id);
        $this->setName($name);
        $this->pdo = Database::getConnection();
    }

    public function setId($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            $this->errors['id'] = "ID must be a positive integer.";
        } else {
            $this->id = $id;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        if (empty($name) || !is_string($name)) {
            $this->errors['name'] = "Name must be a non-empty string.";
        } else {
            $this->name = $name;
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }

    public function getPaymentMethods()
    {
        $stmt = $this->pdo->prepare(Queries::$getPaymentMethods);
        $stmt->execute();
        $paymentMethods = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($paymentMethods, new Payment($row['id'], $row['payment_mode']));
        }
        return $paymentMethods;
    }
}
