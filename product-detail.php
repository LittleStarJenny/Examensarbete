<?php 
include_once "header.php";
// $cart = [];
// $inCart = false;

$message = '';
$product = New Product;

// if the variables are set - run the following statement
if(isset($_POST["addtocart"])) {
    if(isset($_COOKIE["cart"])) {
     
      // Removes backlashes and dont replace previous item, gives every item a new row.
      $cookie_data = stripslashes($_COOKIE['cart']); 
      $cart_data = json_decode($cookie_data, true);
    }
  
  // Returns the productcode in the array
  $item_list = array_column($cart_data, 'ProductsId');
  
  // Returns the value if the statement is true
  if(in_array($_POST["ProductsId"], $item_list)) {
    
    // A foreeachloop that repeats the array value of the selected key variable. 
    foreach($cart_data as $keys => $values) {
    
      if($cart_data[$keys]["ProductsId"] == $_POST["ProductsId"]) {
        $cart_data[$keys]["quantity"] = $cart_data[$keys]["quantity"] + $_POST["quantity"];
      }
    }
  }
    else {
  
      $item_array = array(
  
        'ProductName'      => $ProductName = filter_var($_POST["ProductName"], FILTER_SANITIZE_STRING),
        'ProductsId'      => $ProductsId = filter_var($_POST["ProductsId"], FILTER_SANITIZE_NUMBER_INT),
        'Price'         => $Price  = filter_var($_POST["Price"], FILTER_SANITIZE_NUMBER_INT),
        'quantity'            => $quantity = filter_var($_POST["quantity"], FILTER_SANITIZE_NUMBER_INT),
      );
    
      $cart_data[] = $item_array; 
    }
  
   
    $item_data = json_encode($cart_data);
    setcookie('cart', $item_data, time() + (3600));
    //  header("location: product-detail.php");
  
  }



?>
    
<main>
    <section class="productdetails-wrap">
    <form method="post" action="product-detail.php"> 
        <?php
            if(isset($_GET['product'])) {
                $product->ProductsId = $_GET['product'];
                $product->ProductId = $_GET['product'];
            } else {
                $product->ProductsId = $_POST['ProductsId'];
                // $product->ProductsId = $_POST['productid'];
            }
                $result = $product->get_product();
                $test = $product->get_productvariation();
                    while ($row = $result->fetch()) {
        ?>    
            <div class="product-card-detail">
                <img class="product-image" src="<?php echo $row['Img'];?>" >
                <div class="product-details-text">
                    <h2 class="title"><?php echo $row['ProductName']; ?></h2>
                    <input type ="hidden" name="ProductName" value="<?php echo $row['ProductName'] ?>">

                    <p class="description"><?php echo $row['Description']; ?></p>
                    <span class="price"><?php echo $row['Price'];?>:-</span>
                    <input type ="hidden" name="Price" value="<?php echo $row['Price'] ?>">

                    <select class="size" name="selectedSize"> 
                        <?php 
                        while ($sizeRow = $test->fetch()) {
                            ?>
                        <option>
                            <?php echo $sizeRow['Size']; ?>
                        </option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="quantity" value="1"  />
                    <input type="submit" name="addtocart" value="Add to Cart"/>
                    <input type ="hidden" name="ProductsId" value="<?php echo $row['ProductsId'] ?>">
                </div>
            </div>
        <?php } ?> 
                        </form>
    </section>
</main>
<?php
include_once "footer.php"?>