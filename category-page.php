<?php 
include_once "header.php";
 $request = $_SERVER['REQUEST_URI'];
 $url = $request;
 $url = trim($url, "/");
 $url = explode("/", $url);
$id = $url[2];
var_dump($id);
  $urls = explode("?", $id);
 var_dump($urls[0]);

$productCat = New Product;

// Get category from url that was passed from category-page.php 
// if(isset($_GET['category'])) {
//     $productCat->CategoryId = $_GET['category'];
// } else {
//     $productCat->CategoryId = $_POST['CategoryId'];
// }
$productCat->CategoryName = $urls[0];
// Get all products by category
$result = $productCat->get_productsBycategory();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);

$try = $productCat->get_category();
$categorylabel = $try->fetch();
?>
    
<main>
    <section class="product-container">
        <h3 class="category-title"><?php echo $categorylabel['CategoryName']; ?></h3>
        <!-- Display productcards foreach product  -->
        <?php foreach($rows as $row) { ?>
        <div class="product-card">
            <a href="http://localhost/Examensarbete-Stellasina/product-detail.php?product=<?php echo $row['ProductsId']; ?>">
            <img class="product-image" src="../<?php echo $row['Img'];?>" >
            <h2 class="title"><?php echo $row['ProductName']; ?></h2>
            <span class="price"><?php echo $row['Price'];?></span><span>:-</span>
            </a>
        </div>
        <?php } ?> 
    </section>
</main>

<?php
include_once "footer.php"?>