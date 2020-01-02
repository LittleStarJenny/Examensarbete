<?php 
include_once "header.php";

$product = New Product;

?>
    
<main>
    <section class="productdetails-wrap">
        <?php
        if(isset($_GET['product'])) {
            $product->ProductsId = $_GET['product'];
        } else {
            $product->ProductsId = $_POST['ProductsId'];
        }
            $result = $product->get_product();
            while ($row = $result->fetch()) {
        ?>    
            <div class="product-card-detail">
                <img class="product-image" src="<?php echo $row['Img'];?>" >
                <div class="product-details-text">
                    <h2 class="title"><?php echo $row['ProductName']; ?></h2>
                    <p class="description"><?php echo $row['Description']; ?></p>
                    <span class="price"><?php echo $row['Price'];?>:-</span>
                </div>
            </div>
        <?php } ?> 
    </section>
</main>
<?php
include_once "footer.php"?>