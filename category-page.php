<?php 
include_once "header.php";
$productCat = New Product;

// $getProduct = $result->get_product();
// $


?>
    
<main>
    <div class="sidebar">
        <h3>Kategorier</h3>
</div>
    <section class="product-container">
    <form method="post" action="category-page.php?category=<?php echo $_GET['category']; ?>">
  <?php 
   if(isset($_GET['category'])) {
                $productCat->CategoryId = $_GET['category'];
            } else {
                $productCat->CategoryId = $_POST['CategoryId'];
                // $product->ProductsId = $_POST['productid'];
            }
            $result = $productCat->get_category(); 
           
            while ($row = $result->fetch()) {
          
            echo $row['CategoryName']; ?>
                 <div class="product-card">
        <a href="product-detail.php?product=<?php echo $row['ProductsId']; ?>">
            <img class="product-image" src="<?php echo $row['Img'];?>" >
            <h2 class="title"><?php echo $row['ProductName']; ?></h2>
            <span class="price"><?php echo $row['Price'];?></span><span>:-</span>
        </div>
        <?php } ?> 
            </form>
    </section>
</main>
</body>
<?php
include_once "footer.php"?>