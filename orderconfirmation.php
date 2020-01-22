<?php // Create orderitems    
include_once 'header.php';
$order = New Order;
$product = New Product;



    setcookie("cart", "", time() - 3600);
  



// Get last inserted OrderId
  $lastOrder = $order->get_lastOrder();
  $LastOrderID = $lastOrder->fetch();
  var_dump($LastOrderID['OrderId']);

// Get Products for last Order
    $order->OrderId = $LastOrderID['OrderId'];
    $lastOrder = $order->get_order();
    $TestOrderId = $lastOrder->fetchAll();
// Get Customer for last Order
    $customer = $order->get_customerByorder();
    $Ordercustomer = $customer->fetch();    
// var_dump($TestOrderId);
// var_dump($Ordercustomer);

?>

<!-- <form action="orderconfirmation.php?order=<?php echo $OrderId; ?>" method="post"> -->
<main>
    <h1>Tack för din beställning</h1>
<div class="orderdetails">
    <div class="Customer-Info">
    <span><?php echo $Ordercustomer['Firstname']; echo " "; echo $Ordercustomer['Lastname']; ?></span>
    <span><?php echo $Ordercustomer['Address']; ?></span>
    <span><?php echo $Ordercustomer['Zipcode']; echo " "; echo $Ordercustomer['City']; ?></span>
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
</div>
<!-- <input type="text" name="OrderId" value="<?php echo $LastOrderID['OrderId']?>"> -->

</div>
        </main>


