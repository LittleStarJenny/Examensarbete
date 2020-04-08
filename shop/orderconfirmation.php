<?php // Create orderitems    
include_once 'header.php';
$order = New Order;
$product = New Product;
$total = 0;

// Get last inserted OrderId
$lastOrder = $order->get_lastOrder();
$LastOrderID = $lastOrder->fetch();

// Get Products for last Order
$order->OrderId = $LastOrderID['OrderId'];
$lastOrder = $order->get_order();
$TestOrderId = $lastOrder->fetchAll();

// Get Customer for last Order
$customer = $order->get_customerByorder();
$Ordercustomer = $customer->fetch(); 

//the subject
$sub = "Orderbekräftelse";
//the message
$msg = 
"<html>
  <body> 
    <h1>Orderbekräftelse</h1>
    <hr>
    <h4>Leveransadress</h4>
    <div>
    <div>" . $Ordercustomer['Firstname'] . " " . $Ordercustomer['Lastname'] . "</div>
    <div>" . $Ordercustomer['Address'] . "</div>
    <div>" . $Ordercustomer['Zipcode'] . " " . $Ordercustomer['City'] . "</div>
</div>
    <h4>Orderdetaljer</h4>
    <div>
      <label>Produkter</label>
      <label>Storlek</label>
      <label>Antal</label>
      <label>Pris</label>
    </div>";

    foreach($TestOrderId as $row) {
      // Get Size for matching ID
      $product->SizeId = $row['Size'];
      $sizechart = $product->get_sizechartById();
      $SizeName = $sizechart->fetch();
    $msg .= 
    "<div>
      <span>" . $row['ProductName'] . "</span>
      <span>" . $SizeName['Size'] . "</span>
      <span>" . $row['Quantity'] . "</span>
      <span>" . $row['Price'] . "</span>
    </div>";
    $rowtotal = $row['Price'] * $row['Quantity'];
    $total += $rowtotal;
    $totalwithshipping = $total + 59; 
    };

$msg .= "<span>Totalt " . $total . " SEK</span>
  </body>
</html>";

//recipient email here
$rec = "littlestarjenny6@gmail.com";

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=utf-8\r\n";

//send email
mail($rec,$sub,$msg, $headers);

// Delete cookie
setcookie("cart", "", time() -3600, '/');

?>

<main id="orderform">
  <div>
    <h1>Tack för din beställning</h1>
  </div>
  <div class="orderdetails">
    <div class="Customer-Info">
      <span><?php echo $Ordercustomer['Firstname']; echo " "; echo $Ordercustomer['Lastname']; ?></span>
      <span><?php echo $Ordercustomer['Address']; ?></span>
      <span><?php echo $Ordercustomer['Zipcode']; echo " "; echo $Ordercustomer['City']; ?></span>
    </div>
    <hr>
    <div class="title-row">
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

  <div class="Order">
    <?php foreach($TestOrderId as $row) { 
        // Get Size for matching ID
        $product->SizeId = $row['Size'];
        $sizechart = $product->get_sizechartById();
        $SizeName = $sizechart->fetch();?>
        
      <div class="order-productdetails">
      <span><?php echo $row['ProductName'];?></span>
      <span><?php echo $SizeName['Size'];?></span>
      <span><?php echo $row['Quantity'];?></span>
      <span><?php echo $row['Price'];?> SEK</span>
      </div>
      <?php 
      $rowtotal = $row['Price'] * $row['Quantity'];
      $total += $rowtotal;
      $totalwithshipping = $total + 59;
    } ?>
      <span>Totalt <?php echo $total;?> SEK</span>
    </div>
  </div>
</main>


