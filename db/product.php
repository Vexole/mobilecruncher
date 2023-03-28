<?php
require_once('database.php');
require_once('queries.php');
session_start();

class Product
{
    protected $pdo;
    protected $product;
    protected $products;

    public function __construct()
    {
        if (!$this->pdo) $this->pdo = Database::getConnection();
    }

    public function getProductList()
    {
        try {
            $stmt = $this->pdo->prepare(Queries::$productListQuery);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $products[] = $row;
            }
        } catch (Exception $ex) {
        }
    }

    public function getProductById($argProductId)
    {
        try {
            $stmt = $this->pdo->prepare(Queries::$productDetailQuery);
            $stmt->execute(["productId" => $argProductId]);
            if ($stmt->rowCount() == 1) {
                $this->product = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        } catch (Exception $ex) {
        }
    }

    public function getfilterProductsByManufacturer($argManufacturerId)
    {
        try {
            $stmt = $this->pdo->prepare(Queries::$productListQuery);
            $stmt->execute(["manufacturereId" => $argManufacturerId]);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $products[] = $row;
            }
        } catch (Exception $ex) {
        }
    }

    public function getfilterProductsByOs($argOsId)
    {
        try {
            $stmt = $this->pdo->prepare(Queries::$productListQuery);
            $stmt->execute(["osId" => $argOsId]);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $products[] = $row;
            }
        } catch (Exception $ex) {
        }
    }
}
