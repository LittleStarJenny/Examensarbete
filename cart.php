<?php 
include_once "header.php";

$cart = [];
//$i = 0;
$products = new Product;
$sum = 0; 
if(isset($_COOKIE["cart"])) {
    // $cart = unserialize($_COOKIE["cart"])  ;
    $total = 0;
      $cookie_data = stripslashes($_COOKIE['cart']);
      $cart_data = json_decode($cookie_data, true);
}

// Removes item from cookie
if(isset($_GET["action"])) {
  
    if($_GET["action"] == "delete") {
  
      $cookie_data = stripslashes($_COOKIE['cart']);
      $cart_data = json_decode($cookie_data, true);
      
      foreach($cart_data as $keys => $values) {
      
        if($cart_data[$keys]['ProductsId'] == $_GET["id"]) {
          unset($cart_data[$keys]);
          $item_data = json_encode($cart_data);
          setcookie("cart", $item_data, time() + (3600));
          header("location: cart.php");
        }
      }
    }
  }

 ?>

  <main>
<div class="cart">
<h3>Varukorg</h3>
<table>
    <tr>
        <th>Titel</th>
        <th>Artnr</th>
        <th>Pris</th>
        <th>Antal</th>
        <th>Summa</th>
        <th>Ta bort</th>
    </tr>
<?php
    // foreach($cart as $cart_item) 
    foreach($cart_data as $keys => $values){
        // $products->ProductsId = $cart_item["id"];
        // $result = $products->get_product();
        // while ($row = $result->fetch()){
    
            $rowsum = $values['Price'] * $values['quantity'];
            $sum += $rowsum; 
?>
    <tr class="cartitem">
    <form action="" method="post">
        <td><?php echo $values['ProductName']; ?></td>
        <td><?php echo $values['ProductsId']; ?></td>
        <td><?php echo $values['Price']; ?></td>
        <td><input type="number" name="quantity" step="1" min="1" value="<?php echo $values["quantity"]?>"></td>
        <td><?php echo $rowsum; ?></td>
        <td><a href="?action=delete&id=<?php echo $values["ProductsId"]; ?>">Remove</a></td>
<?php   }
     ?>
       </form>
    <tr>
        <td colspan="3">Summa:</td>
        <td><?php echo $sum; ?></td>
        <td>&nbsp;</td>
    </tr>
</table>
<a href="checkout.php"><button class="tillkassan">Till kassan</button></a>
</div>
<?php include_once "footer.php" ?>
</html>