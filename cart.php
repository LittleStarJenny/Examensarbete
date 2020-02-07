<?php 
include_once "header.php";

$cart = [];
//$i = 0;
$products = new Product;
$total = 0;
$message = "";

if(isset($_COOKIE["cart"])) {
  $cookie_data = stripslashes($_COOKIE['cart']);
  $cart_data = json_decode($cookie_data, true);

}

// Remove item from cookie and cart
if(isset($_GET["action"])) {
  if($_GET["action"] == "delete") {
    $cookie_data = stripslashes($_COOKIE['cart']);
    $cart_data = json_decode($cookie_data, true);
    foreach($cart_data as $keys => $values) {
      if($cart_data[$keys]['ProductsId'] == $_GET["id"] && $cart_data[$keys]['Size'] == $_GET["Size"]) {
        unset($cart_data[$keys]);
        $item_data = json_encode($cart_data);
        setcookie("cart", $item_data, time() +(3600));
        header("location: cart.php");
      }
    }
  }
}

// Update product quantity
if(isset($_GET["action"])) {
  if($_GET["action"] == "update") {
    $cookie_data = stripslashes($_COOKIE['cart']);
    $cart_data = json_decode($cookie_data, true);
    $arrQuantity = $_POST['quantity'];
    foreach($cart_data as $keys => $values) {
      if($cart_data[$keys]["ProductsId"] == $_POST["ProductsId"] && $cart_data[$keys]["Size"] == $_POST["Size"]) {
        $cart_data[$keys]["quantity"] = $_POST["quantity"];
    }
  }
    $item_data = json_encode($cart_data);
    setcookie("cart", $item_data, time() +(3600));
    header("location: cart.php"); 
  }
}

?>

<main id="cart-content">
  <div class="cart">
    <h3>Varukorg</h3>
<?php
if(empty($cart_data)) {
  echo $message = 'Cart is empty';
} else {

  foreach($cart_data as $keys => $values){
    $rowtotal = $values['Price'] * $values['quantity'];
      $total += $rowtotal; 


?>
<!-- Title row -->
<div class="title-row">
  <div class="col-1"></div>
  <div class="col-2">
    <label>Produkter</label>
  </div>
  <div class="col-3">
    <label>Storlek</label>
    <label>Antal</label>
  </div>
  <div class="col-4">
    <label>Pris</label>
  </div>
  <div class="col-5"></div>
  </div>
    <!-- Each cart item -->
    <div class="cartitem">
      <div><a href="?action=delete&id=<?php echo $values["ProductsId"]?>&Size=<?php echo $values['Size'];?>"><i class="fas fa-trash-alt"></i></a>
      </div>
      <form action="cart.php?action=update" method="post">
        <div class="cart-img-qty">
          <img class="cart-img" src=<?php echo $values['Img'] ?>>
        </div>
        <div class="cart-textdetails">
          <span class="cart-prod-details"><?php echo $values['ProductName']; ?></span>
          <span class="cart-prod-size"><?php echo $values['Size']; ?></span>
          <span class="cart-qty">
            <input type="number" name="quantity" step="1" min="1" value="<?php echo $values["quantity"]?>">
            <input type="hidden" name="Size" step="1" min="1" value="<?php echo $values["Size"]?>">
            <input type="hidden" name="ProductsId" step="1" min="1" value="<?php echo $values["ProductsId"]?>">
            <button><i class="fas fa-sync"></i></button>
          </span> 
          <span class="cart-prod-price"><?php echo $values['Price']; ?> SEK</span>
        </div>
        <hr>  
        <div class="prod-total">
            <span>Totalt</span>
            <span><?php echo $rowtotal; ?> SEK</div><span>
        </div>
      </form>
  <?php }  
        }
      ?>
    </div>


  <!-- Total Sum -->
    <div class="Total">
      <h3>Summa</h3>
        <span colspan="3">Totalt</span>
        <span><?php echo $total; ?> SEK</span>
      <div class="toCheckout">
        <a href="checkout">Till kassan</a>
      </div>
    </div>
  </div>
</main>

<?php include_once "footer.php" ?>