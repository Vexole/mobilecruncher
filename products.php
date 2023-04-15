<?php
require_once("./db/Product.php");
require_once('./utils/formValidationUtils.php');

unset($_SESSION['invoice']);
$_SESSION['invoice'] = null;

$products = new Product();
$searchKeyword = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_product'])) {
    $searchKeyword = FormValidationUtils::sanitizeFields($_POST["search_product"]);
    $productsList = $products->getFilteredProductList($searchKeyword);
} else {
    $productsList = $products->getProductList();
}
?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>

<body>
    <?php include_once('components/header.php') ?>

    <div class="container-fluid">
        <h1 class="text-center my-4">MobileCrunchers - Products</h1>
        <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="d-flex col-md-4 mx-auto">
                <input type="text" class="form-control" id="search_product" name="search_product" value="<?= $searchKeyword ?>" placeholder="Search Product" aria-label="Search Product" aria-describedby="Search Product" />
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
        <?php
        $html = "<div class='py-5'>";
        $html .= "<div class='container'>";
        $html .= "<div class='row hidden-md-up'>";
        foreach ($productsList as $product) {
            $id = $product->getId();
            $name = $product->getName();
            $price = $product->getPrice();
            $quantity = $product->getQuantity();
            $image_path = $product->getImagePath();
            $manufacturer = $product->getManufacturer();
            $os = $product->getOS();
            $html .= "<div class='col-md-4 mb-4'>";
            $html .= "<div class='card p-3 d-flex flex-column align-items-center'>";
            $html .= "<h3 class='text-center mc-color-secondary'>$name</h3>";
            $html .= "<div class='mb-3'>";
            $html .= "<span class='me-4 badge mc-bg-info'>$manufacturer</span>";
            $html .= "<span class='badge mc-bg-info'>$os</span>";
            $html .= "</div>";
            $html .= "<img class='product-image' src='images/{$image_path}' alt='{$image_path}'>";
            $html .= "<h4 class='mc-color-primary'>$$price</h4>";
            $html .= "<div class='d-grid col-6 mx-auto'>";
            $html .= "<a href='product_details.php?id=$id' class='btn btn-secondary'>View Details</a>";
            $html .= "</div>";
            $html .= "</div>";
            $html .= "</div>";
        }
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";
        echo $html;
        ?>
    </div>

    <?php include_once('components/footer.php') ?>
</body>

</html>