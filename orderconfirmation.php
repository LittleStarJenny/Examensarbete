<?php // Create orderitems    
include_once 'header.php';
$order = New Order;
$product = New Product;

if(isset($_COOKIE["cart"])) {
    $cookie_data = stripslashes($_COOKIE['cart']);
    $cart_data = json_decode($cookie_data, true);
    //    var_dump($cart_data);
  }

// Create orderitems    
$ProductvariationsId = filter_input(INPUT_POST, 'ProductvariationsId', FILTER_SANITIZE_STRING);
$Quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_STRING);
$OrderId = filter_input(INPUT_POST, 'OrderId', FILTER_SANITIZE_STRING);

$order->ProductvariationsId = $ProductvariationsId;
$order->Quantity = $Quantity;
$order->OrderId = $OrderId;

$lastOrder = $order->get_lastOrder();



// if(
    $OrderId = $lastOrder->fetch();
    var_dump($OrderId);
if($OrderId == $OrderId) {
    
 }

?>

<form action="orderconfirmation.php?order=<?php echo $OrderId; ?>" method="post">
<?php echo $OrderId['OrderId'] ;
if(empty($OrderId)) {
        echo 'There is nothing on order';
        } else {
        foreach($cart_data as $keys => $values){
            $ProductsId = $cart_data[$keys]['ProductsId'];
            // $product->ProductsId = $ProductsId;
            $product->ProductId = $ProductsId;
            // $test = $product->get_product();
            $result = $product->get_productvariation();
            $showpID = $result->fetch();

            
            // $getProd = $test->fetch(); 
            ?>
<div class="orderdetails">   
            <form action="orderconfirmation.php" method="post">
                <span class="cart-prod-details"><?php echo $values['ProductName']; ?></span>
                <span class="cart-prod-size"><?php echo $values['Size']; ?></span>
                <span class="cart-qty"><?php echo $values["quantity"]?></span>
                <input type="text" name="quantity" step="1" min="1" value="<?php echo $values["quantity"]?>">
                <input type="text" name="ProductvariationsId" value="<?php echo $showpID["PVId"]?>">
                <input type ="hidden" name="ProductsId" value="<?php echo $values['ProductsId'] ?>">
                <input type="hidden" name="Size" value="<?php echo $values['Size']; ?>">
</div>
        <?php
         $order->create_orderitem();
         }

    } ?>

