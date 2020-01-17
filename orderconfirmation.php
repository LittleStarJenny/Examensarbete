<?php // Create orderitems    
include_once 'header.php';
$order = New Order;

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
// ) {
    // $order->create_orderitem();
// }

?>

<form action="orderconfirmation.php?order=<?php echo $OrderId; ?>" method="post">
<?php echo $OrderId['OrderId'] ?>

