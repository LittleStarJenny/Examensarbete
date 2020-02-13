<?php 
include_once 'header.php';
// session_start();
// var_dump($_SESSION);

$customer = New Customer;
$customer->Mail = $_SESSION['login'];
$result = $customer->get_customer();
$row = $result->fetch(); 
// var_dump($row);

$order = New Order;
$order->CustomersId = $row['CustomersId'];
$results = $order->get_customerOrder();
$orderResult = $results->fetchAll(PDO::FETCH_ASSOC);
//  var_dump($orderResult);



?>

<main id="customer-pages">
<h3> Välkommen <?php echo $row['Firstname']; ?>!</h3>
<input type ="hidden" name="CustomersId" value="<?php echo $row['CustomersId'] ?>">  
<?php foreach($orderResult as $rowResult) {
    $order->OrderId = $rowResult['OrderId'];
    $test = $order->get_order();
    $customersOrders = $test->fetchAll(PDO::FETCH_ASSOC);
    //  var_dump($customersOrders);?>
<!-- <p> OrderId: !</p> -->
<div class="Order">  <p> OrderId: <?php echo $rowResult['OrderId']; ?></p>
            <div class="order-productdetails">
      
            <?php foreach($customersOrders as $row) { ?>
                <div class="each-row">
            <span><?php echo $row['ProductName'];?></span>
            <span><?php echo $row['Size'];?></span>
            <span><?php echo $row['Quantity'];?></span>
            <span><?php echo $row['Price'];?> SEK</span>
           </div>
            <?php } ?>
            </div>
            <?php } ?>

<!-- </div> -->
</main>