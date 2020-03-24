<?php

$product = New Product;
if(isset($_GET['product'])) {
    $product->ProductsId = $_GET['product'];
header("location: product-detail.php?product=".$_GET['product']);
};