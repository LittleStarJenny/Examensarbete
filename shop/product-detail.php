<?php include_once '../header.php';

$message = '';
$product = New Product;
$cart_data = [];


// if the variables are set - run the following statement
if(isset($_POST["addtocart"])) {
  $message = "Varan lades till i varukorgen";
    if(isset($_COOKIE["cart"])) {
  
      // Removes backlashes and dont replace previous item, gives every item a new row.
      $cookie_data = stripslashes($_COOKIE['cart']); 
      $cart_data = json_decode($cookie_data, true);
    }
  
  // Returns the productid and Size in the array
  $item_list = array_column($cart_data, 'ProductsId');
  $size_list = array_column($cart_data, 'Size');
  
  // Returns the value if the statement is true
  if(in_array($_POST["ProductsId"], $item_list) && in_array($_POST['selectedSize'], $size_list)) {
    
    // A foreachloop that repeats the array value of the selected key variable. 
    foreach($cart_data as $keys => $values) {
      if($cart_data[$keys]["ProductsId"] == $_POST["ProductsId"] && $cart_data[$keys]["Size"] == $_POST["selectedSize"]) {
        $cart_data[$keys]["quantity"] = $cart_data[$keys]["quantity"] + $_POST["quantity"];
      }
    }
  }
    else {
  
      $item_array = array(
        
        'Img'             => $Img = filter_var($_POST["Img"], FILTER_SANITIZE_STRING),        
        'ProductName'     => $ProductName = filter_var($_POST["ProductName"], FILTER_SANITIZE_STRING),
        'Size'            => $Size = filter_var($_POST['selectedSize'], FILTER_SANITIZE_STRING),
        'ProductsId'      => $ProductsId = filter_var($_POST["ProductsId"], FILTER_SANITIZE_NUMBER_INT),
        'Price'           => $Price  = filter_var($_POST["Price"], FILTER_SANITIZE_NUMBER_INT),
        'quantity'        => $quantity = filter_var($_POST["quantity"], FILTER_SANITIZE_NUMBER_INT),
      );
    
      $cart_data[] = $item_array; 
    }
  
    $item_data = json_encode($cart_data);
    setcookie('cart', $item_data, time() +(3600),'/');
    // header("location: product-detail.php?product=".$_GET['product']);
    $message = "Varan lades till i varukorgen";

  }

?>
    
<main id="product-content">
  <section>
    <form method="post" action="product-detail.php?product=<?php echo $_GET['product']; ?>"> 
      <?php if(isset($_GET['product'])) {
        $product->ProductsId = $_GET['product'];
        $product->ProductId = $_GET['product'];
        $product->ProductsId = $_GET['product'];
      } else {
        $product->ProductsId = $_POST['ProductsId'];
      }
        $result = $product->get_product();
        $test = $product->get_productvariation(); 
      while ($row = $result->fetch()) { ?>   

      <div class="product-card-detail">
        <div class="product-image-wrapper">
          <img class="product-image" src="../<?php echo $row['Img'];?>" >
          <input type ="hidden" name="Img" value="../<?php echo $row['Img'] ?>">
          <?php $results = $product->get_images();
          $Images = $results->fetch();
          if(isset($Images['Image'])) { ?>
          <img class="product-image" src="../<?php echo $Images['Image'];?>">
          <?php } ?>
        </div>

        <div class="product-details-text">
          <h2 class="title"><?php echo $row['ProductName']; ?></h2>
          <input type ="hidden" name="ProductName" value="<?php echo $row['ProductName'] ?>">
          <span class="price"><?php echo $row['Price'];?> SEK</span>
          <input type ="hidden" name="Price" value="<?php echo $row['Price'] ?>">
          <span class="select-title">Storlek</span>
          
          <select class="size" name="selectedSize"> 
            <?php while ($sizeRow = $test->fetch()) { ?>
              <option>
                <?php echo $sizeRow['Size']; ?>
              </option>
            <?php } ?>
          </select>

          <input type="hidden" name="quantity" value="1"  />
          <input type="submit" class="addtocart-btn"  name="addtocart" value="Lägg i varukorgen"/>
          <div><?php echo $message;?></div>
          <input type ="hidden" name="ProductsId" value="<?php echo $row['ProductsId'] ?>">
          <span class="title-description">Beskrivning</span>
          <p class="description"><?php echo $row['Description']; ?></p>
        </div>
      </div>
      <?php } ?>              
    </form>
  </section>
</main>
<?php include_once "../footer.php";?>