<?php 
include_once "header.php";
$productCat = New Product;

// Get category from url that was passed from category-page.php 
if(isset($_GET['category'])) {
    $productCat->CategoryId = $_GET['category'];
} else {
    $productCat->CategoryId = $_POST['CategoryId'];
}
// Get all products by category
$result = $productCat->get_productsBycategory();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
?>
    
<main>
    <section class="product-container">
        <h3 class="category-title"><?php echo $row['CategoryName']; ?></h3>
        <!-- Display productcards foreach product  -->
        <?php foreach($rows as $row) { ?>
        <div class="product-card">
            <a href="product-detail.php?product=<?php echo $row['ProductsId']; ?>">
            <img class="product-image" src="<?php echo $row['Img'];?>" >
            <h2 class="title"><?php echo $row['ProductName']; ?></h2>
            <span class="price"><?php echo $row['Price'];?></span><span>:-</span>
        </div>
        <?php } ?> 
    </section>
</main>

<?php
include_once "footer.php"?>