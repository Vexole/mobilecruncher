<?php
require_once("./db/Product.php");

$products = new Product();
$productsList = $products->getProductList();

foreach ($productsList as $product) {
    $id = $product->getId();
    $name = $product->getName();
    $price = $product->getPrice();
    $quantity = $product->getQuantity();
    $image_path = $product->getImagePath();
    $manufacturer = $product->getManufacturer();
    $os = $product->getOS();
    $html = "<div>";
    $html .= "<h1>$name</h1>";
    $html .= "<p>$price</p>";
    $html .= "<p>$manufacturer</p>";
    $html .= "<p>$os</p>";
    $html .= "<p>$image_path</p>";
    $html .= "<a href='productDetails.php?id=$id'>View</a>";
    $html .= "</div>";
    echo $html;
}
