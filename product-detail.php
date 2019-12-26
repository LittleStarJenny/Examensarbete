<?php 
include_once "header.php";

$product = New Product;

?>
    
<main>
    <section class="productdetails-wrap">
    <?php
    if(isset($_GET['product'])) {
    $product->productId = $_GET['product'];
    } else {
    $product->productId = $_POST['productsId'];
    }
    $result = $product->get_product();
    while ($row = $result->fetch()) {
    ?>  
        <div class="product-card">
            <img class="product-image" src="<?php echo $row['Img'];?>" >
            <h2 class="title"><?php echo $row['ProductName']; ?></h2>
            <p class="description"><?php echo $row['Description']; ?></p>
            <span class="price"><?php echo $row['Price'];?></span><span>:-</span>
        </div>
        <?php } ?> 
    </section>
</main>
</body>
<?php
include_once "footer.php"?>