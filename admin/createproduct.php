<?php
include_once 'adminheader.php';
$product = New Product;

if(isset($_POST['saveVariation'])) {
    $Size = filter_input(INPUT_POST, 'sizeChart', FILTER_SANITIZE_MAGIC_QUOTES);
    $Title = filter_input(INPUT_POST, 'Title', FILTER_SANITIZE_MAGIC_QUOTES);

    $checkboxes = isset($_POST['sizeChart']) ? $_POST['sizeChart'] : array();
    foreach ($checkboxes as $select) { 
    $product->Size = $select;
    $product->ProductId = $Title;
    echo 'you have selected:' .$select .$Title;
    $product->create_productvariation();
    }
}

?>


<main id="main-admin">
<?php include_once 'adminsidebar.php'; ?>
<section>
<div class="admin-wrapper">
    <h3>Skapa produkt</h3>
    <hr>
<form method="post" action="createproduct.php?success" enctype="multipart/form-data">
<span class="createproduct">Kategori</span>
<select class="Category" name="selectCat"> 
<?php 
$catName = $product->get_categoryForHeader();
$category = $catName->fetchAll();
foreach ($category as $cat) {
?>
<option value="<?php echo $cat['CategoryId'];?>">
<?php echo $cat['CategoryName']; ?>
</option>
<?php }  ?>
</select>
    <span class="createproduct">Produktnamn</span>
    <input type="text" class="admin-input" name="ProductName">
    <div>
    <span class="createproduct">Beskrivning</span>
    <input type="text" class="admin-input" name="Description">
</div>
    <span class="createproduct">Pris</span>
    <input type="text" class="admin-input" name="Price">
    <span class="createproduct">Färg</span>
    <input type="text" class="admin-input" name="Color">
    <span class="createproduct">Huvudbild</span>
    <input type="file" class="admin-input" name="image" id="image">
    <!-- <span class="createproduct">Produktbild</span>
    <input type="file" name="image" id="image"> -->
    <input type="submit" class="standard-btn" name="saveproduct" value="Spara">
</form>
</div>

<div class="variationWrap">
<h3>Skapa produktvariation</h3>
    <hr>
<form method="post" action="createproduct.php?createproductvariationSuccess">
<span class="createproduct">Välj Produkt</span>
<select class="ProductName" name="Title"> 
<?php 
$result = $product->get_all_products();
$title = $result->fetchAll();
foreach ($title as $row) {
?>
<option value="<?php echo $row['ProductsId']; ?>">
<?php echo $row['ProductName']; ?>
</option>
<?php }  ?>
</select>
<?php 
$getSize = $product->get_sizechart();
$Sizes = $getSize->fetchAll();
foreach ($Sizes as $Size) { ?>
<input type="checkbox" class="admin-input" name="sizeChart[]" multiple value="<?php echo $Size['Size']; ?>">
<?php echo $Size['Size']; ?>
</option>
<?php }  ?>
<input type="submit" class="standard-btn" name="saveVariation" value="Spara">
</form>
</div>
</section>
</main>



<?php

if(isset($_POST['saveproduct'])) {
    $target_dir = "../img/";
    $name = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];

    $ProductName = filter_input(INPUT_POST, 'ProductName', FILTER_SANITIZE_STRING);
    $Description = filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_STRING);
    $Price = filter_input(INPUT_POST, 'Price', FILTER_SANITIZE_STRING);
    $Color = filter_input(INPUT_POST, 'Color', FILTER_SANITIZE_STRING);
    $Img = "img/".$_FILES['image']['name'];
    $selcat = filter_input(INPUT_POST, 'selectCat', FILTER_SANITIZE_MAGIC_QUOTES);
    $product->ProductName = $ProductName;
    $product->Description = $Description;
    $product->Price = $Price;
    $product->Color = $Color;
    $product->Img = $Img;
    $product->CategoryId = $selcat;
    $product->create_product();

// $product->create_images();
    if(isset($name) and !empty($name)) {
        if(move_uploaded_file($temp_name, $target_dir.$name)){
        echo 'File uploaded successfully';
        }
    } else {
        echo 'You should select a file to upload !!';
    }
}
 ?>