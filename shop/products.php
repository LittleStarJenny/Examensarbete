<?php 
$product = New Product;
$result = $product->get_all_products();
$rows = $result->fetchAll();
?>
    
<main id="product-content">
    <section class="product-container">
        <h3 class="category-title">Products</h3>
        <?php foreach($rows as $row) { ?>
        <div class="product-card">
            <a href="shop/product-detail.php?product=<?php echo $row['ProductsId']; ?>">
                <img class="product-image" src="<?php echo $row['Img'];?>" >
                <h2 class="title"><?php echo $row['ProductName']; ?></h2>
                <span class="price"><?php echo $row['Price'];?></span><span>:-</span>
            </a>
        </div>
        <?php } ?> 
    </section>
</main>