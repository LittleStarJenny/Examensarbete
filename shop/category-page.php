<?php 
// include_once "header.php";

$productCat = New Product;
// Get products from Clean Url
$request = $_SERVER['REQUEST_URI'];
$url = $request;
$url = trim($url, "/");
$url = explode("/", $url);
$id = $url[2];
$urls = explode("?", $id);


$productCat->CategoryName = $urls[0];
$result = $productCat->get_productsBycategory();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);

$try = $productCat->get_category();
$categorylabel = $try->fetch();
?>
    
<main id="product-content">
    <section class="product-container">
        <h3 class="category-title"><?php echo $categorylabel['CategoryName']; ?></h3>
        <!-- Display productcards foreach product  -->
        <?php foreach($rows as $row) { ?>
        <div class="product-card">
            <a href="http://localhost/Stellasina/shop/product-detail.php?product=<?php echo $row['ProductsId']; ?>">
            <img class="product-image" src="../<?php echo $row['Img'];?>" >
            <h2 class="title"><?php echo $row['ProductName']; ?></h2>
            <span class="price"><?php echo $row['Price'];?></span><span>:-</span>
            </a>
        </div>
        <?php } ?> 
    </section>
</main>
<!-- 
<?php
include_once "footer.php"?> -->