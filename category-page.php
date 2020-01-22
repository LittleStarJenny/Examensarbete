<?php 
include_once "header.php";
$productCat = New Product;

if(isset($_GET['category'])) {
    $productCat->CategoryId = $_GET['category'];
} else {
    $productCat->CategoryId = $_POST['CategoryId'];
    // $productCat->ProductsId = $_POST['productsid'];
}
$result = $productCat->get_productsBycategory();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
// var_dump($rows);
?>
    
<main>
    <!-- <div class="sidebar">
    <h3>Kategorier</h3>
    </div> -->
    <section class="product-container">
        <h3 class="category-title"><?php echo $row['CategoryName']; ?></h3>
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