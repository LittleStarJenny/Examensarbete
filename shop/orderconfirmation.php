<?php // Create orderitems    
include_once 'header.php';
$order = New Order;
$product = New Product;


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
$sub = "Test";
//the message
$msg = "<h1>Orderbekräftelse</h1>";
$msg = $Ordercustomer['Mail'];
//recipient email here
$rec = "littlestarjenny6@gmail.com";
// $Ordercustomer['Mail'];
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//send email
mail($rec,$sub,$msg, $headers);

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
            <?php foreach($TestOrderId as $row) { ?>
            <div class="order-productdetails">
            <span><?php echo $row['ProductName'];?></span>
            <span><?php echo $row['Size'];?></span>
            <span><?php echo $row['Quantity'];?></span>
            <span><?php echo $row['Price'];?> SEK</span>
        </div>
        <?php } ?>
    </div>

</main>


