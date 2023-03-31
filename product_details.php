<?php
require_once('./db/Product.php');
require_once('./db/Cart.php');
require_once('./db/CartDetail.php');
require_once('./utils/formValidationUtils.php');

$html = "";

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $productId = FormValidationUtils::sanitizeFields($_GET["id"]);
    $product = new Product();
    try {
        $productDetail = $product->getProductById($productId);
        if ($productDetail) {
            $id = $productDetail->getId();
            $name = $productDetail->getName();
            $price = $productDetail->getPrice();
            $quantity = $productDetail->getQuantity();
            $imagePath = $productDetail->getImagePath();
            $RAM = $productDetail->getRAM();
            $storageCapacity = $productDetail->getStorageCapacity();
            $screenSize = $productDetail->getScreenSize();
            $processorType = $productDetail->getProcessorType();
            $processorSpeed = $productDetail->getProcessorSpeed();
            $opticalSensorResolution = $productDetail->getOpticalSensorResolution();
            $weight = $productDetail->getWeight();
            $dimension = $productDetail->getDimension();
            $manufacturer = $productDetail->getManufacturer();
            $os = $productDetail->getOS();
            $html = "<div>";
            $html .= "<p>$id</p>";
            $html .= "<h1>$name</h1>";
            $html .= "<p>$price</p>";
            $html .= "<p>$quantity</p>";
            $html .= "<p>$imagePath</p>";
            $html .= "<p>$RAM</p>";
            $html .= "<p>$storageCapacity</p>";
            $html .= "<p>$screenSize</p>";
            $html .= "<p>$processorType</p>";
            $html .= "<p>$processorSpeed</p>";
            $html .= "<p>$opticalSensorResolution</p>";
            $html .= "<p>$weight</p>";
            $html .= "<p>$dimension</p>";
            $html .= "<p>$manufacturer</p>";
            $html .= "<p>$os</p>";
            $html .= "</div>";
        } else {
            $html = "<div>Product Not Found!</div>";
        }
    } catch (Exception $e) {
        $html = "<div>ERROR!! " . $e->getMessage() . "</div>";
    }
} else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!$_SESSION['userId']) {
        header('location: login.php');
        exit();
    }
    $productId = FormValidationUtils::sanitizeFields($_POST["productId"]);
    $quantity = FormValidationUtils::sanitizeFields($_POST["quantity"]);
    $product = new Product();
    $productDetail = $product->getProductById($productId);
    $price = $productDetail->getPrice();
    $imagePath = $productDetail->getImagePath();
    $name = $productDetail->getName();

    if (isset($_SESSION["Cart"])) {
        $cart = new Cart(["userId" => $_SESSION["userId"]]);
        $cartDetails = $cart->getCartDetails();
        $cartProductIds = [];
        foreach ($cartDetails as $cartDetail) {
            $cartProductIds[] = $cartDetail->getProductId();
        }

        if (in_array($productId, $cartProductIds)) {
            foreach ($cartDetails as $cartDetail) {
                if ($cartDetail->getProductId() == $productId) {
                    $cart->setTotal($cart->getTotal() + ($quantity * $cartDetail->getPrice()));
                    $cartDetail->setQuantity($cartDetail->getQuantity() + $quantity);
                    $cart->updateCart();
                    $cart->updateCartDetails($cartDetail->getQuantity(), $cartDetail->getProductId());
                    break;
                }
            }
        } else {
            $cart->setTotal($cart->getTotal() + ($quantity * $price));
            $cart->updateCart();
            $cart->insertCartDetails($quantity, $productId);
        }
    } else {
        addNewCart(
            $productId,
            $quantity,
            $name,
            $price,
            $imagePath
        );
    }
    $html = "<script>alert('Product added to cart!');</script>";
    header('location: cart.php');
} else {
    $html = "<div>Invalid Page Request</div>";
}

function addNewCart(
    $productId,
    $quantity,
    $name,
    $price,
    $imagePath
) {
    $cartDetail = new CartDetail(
        null,
        $productId,
        $quantity,
        $name,
        $price,
        $imagePath
    );
    $cart = new Cart(array(
        "userId" => $_SESSION["userId"],
        "total" => $price * $quantity,
        "cartDetail" => $cartDetail
    ));
    $cart->newCart();
}

echo $html;
?>

<form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="hidden" value="<?= $productId ?>" name="productId" />
    Quantity
    <select name="quantity">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
    <input type="submit" value="Add to Cart">
</form>