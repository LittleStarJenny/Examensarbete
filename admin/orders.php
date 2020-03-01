<?php
include_once '../header.php';
$product = New Product;


$img= $_FILES['hey'];


?>

<main>
<form method="post" action="createproduct.php" enctype="multipart/form-data">
<span class="createproduct">Kategori</span>
<select class="Category" name="selectCat"> 
                        <?php 
                $catName = $product->get_categoryForHeader();
                       $category = $catName->fetchAll();
                       foreach ($category as $cat) {
                         
                            ?>
                        <option>
                            <?php echo $cat['CategoryId']; ?>
                        </option>
                       <?php }  ?>
                    </select>


    <!-- <input text="hidden" name="CategoryId" value="<?php echo $cat['CategoryId']; ?>"> -->
    <span class="createproduct">Produktnamn</span>
    <input type="text" name="ProductName">
    <span class="createproduct">Artikelnr</span>
    <input type="text" name="ArticleNr">
    <span class="createproduct">Beskrivning</span>
    <input type="text" name="Description">
    <span class="createproduct">Pris</span>
    <input type="text" name="Price">
    <span class="createproduct">Storlek</span>
    <input type="text" name="Size">
    <span class="createproduct">Färg</span>
    <input type="text" name="Color">
    <span class="createproduct">Produktbild</span>
    <input type="file" name="hey" id="hey">
    <!-- <span class="createproduct">Bilder</span>
    <input type="file" name="Image"> -->

    <input type="submit" name="saveproduct" value="Spara">
</form>
</main>

<?php
$target_dir = "img/";
$target_file = $target_dir . basename($_FILES["hey"]["name"]);

if(isset($_POST['saveproduct'])) {
    $ProductName = filter_input(INPUT_POST, 'ProductName', FILTER_SANITIZE_STRING);
    $ArticleNr = filter_input(INPUT_POST, 'ArticleNr', FILTER_SANITIZE_STRING);
    $Description = filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_STRING);
    $Price = filter_input(INPUT_POST, 'Price', FILTER_SANITIZE_STRING);
    $Size = filter_input(INPUT_POST, 'Size', FILTER_SANITIZE_STRING); 
    $Color = filter_input(INPUT_POST, 'Color', FILTER_SANITIZE_STRING);
    $Img = $_FILES['hey'];
    $selcat = filter_input(INPUT_POST, 'selectCat', FILTER_SANITIZE_MAGIC_QUOTES);
    $product->CategoryId = $selcat;
    $product->ProductName = $ProductName;
    // $product->ArticleNr = $ArticleNr;
    $product->Description = $Description;
    $product->Price = $Price;
    // $product->Size = $Size;
    $product->Color = $Color;
    $product->Img = $Img;
    // $product->Image = $Image;
    // $product->CategoryName = $CategoryName;
   $success = $product->create_product();
    // $product->create_productvariation();
    // $product->create_images();
if(move_uploaded_file($_FILES['hey']['tmp_name']['name'], $target_file));
 }
 ?>