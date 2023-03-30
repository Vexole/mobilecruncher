<?php
require_once('Database.php');
require_once('CartDetail.php');
require_once('Queries.php');

class Cart
{
    protected $userId;
    protected $status;
    protected $total;
    protected $cartDetail = [];

    protected $errors;
    protected $pdo;

    public function __construct($data)
    {
        if (!$this->pdo) $this->pdo = Database::getConnection();
        if (isset($data["userId"])) $this->userId = $data["userId"];
        if (isset($data["total"])) $this->total = $data["total"];
        if (isset($data["cartDetail"])) $this->cartDetail = $data["cartDetail"];
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function getCartDetail()
    {
        return $this->cartDetail;
    }

    public function setCartDetail($cartDetail)
    {
        $this->cartDetail = $cartDetail;
    }

    public function newCart()
    {
        $stmt = $this->pdo->prepare(Queries::$newCartEntry);
        $stmt->execute([
            "userId" => $this->userId,
            "total" => $this->total
        ]);

        $id = $this->pdo->lastInsertId();

        $stmt = $this->pdo->prepare(Queries::$newCartDetailEntry);
        $stmt->execute([
            "cartId" => $id,
            "productId" => $this->getCartDetail()->getProductId(),
            "quantity" => $this->getCartDetail()->getQuantity()
        ]);
        $_SESSION["Cart"] = $id;
    }

    public function insertCartDetails($quantity, $productId)
    {
        $stmt = $this->pdo->prepare(Queries::$newCartDetailEntry);
        $stmt->execute([
            "quantity" => $quantity,
            "productId" => $productId,
            "cartId" => $_SESSION["Cart"]
        ]);
    }

    public function getCart()
    {
        $stmt = $this->pdo->prepare(Queries::$cartByUser);
        $stmt->execute([
            "userId" => $this->userId
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (sizeOf($row) > 0) {
            $_SESSION["Cart"] = $row[0]['id'];
        }
    }

    public function getCartDetails()
    {
        $stmt = $this->pdo->prepare(Queries::$cartByUser);
        $stmt->execute([
            "userId" => $this->userId
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        var_dump($row);
        if ($row && sizeOf($row) > 0) {
            $cartId = $row['id'];
            $this->total = $row["total"];
            $_SESSION["Cart"] = $cartId;
            $stmt = $this->pdo->prepare(Queries::$cartDetailsByUser);
            $stmt->execute([
                "cartId" => $cartId
            ]);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->cartDetail[] = new CartDetail(
                    $cartId,
                    $row["product_id"],
                    $row["quantity"],
                    $row["name"],
                    $row["price"],
                    $row["image_path"]
                );
            }
        }
        return $this->cartDetail;
    }

    public function updateCart()
    {
        $stmt = $this->pdo->prepare(Queries::$updateCartById);
        $stmt->execute([
            "total" => $this->getTotal(),
            "status" => "IN_PROGRESS",
            "cartId" => $_SESSION["Cart"]
        ]);
    }

    public function updateCartDetails($quantity, $productId)
    {
        $stmt = $this->pdo->prepare(Queries::$updateCartDetailsById);
        $stmt->execute([
            "quantity" => $quantity,
            "productId" => $productId,
            "cartId" => $_SESSION["Cart"]
        ]);
    }
}
