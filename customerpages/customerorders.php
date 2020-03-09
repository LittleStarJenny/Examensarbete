<?php 

// session_start();
// var_dump($_SESSION);
$message = '';
$customer = New Customer;
$customer->Mail = $_SESSION['Mail'];
$result = $customer->get_customer();
$row = $result->fetch(); 
// var_dump($row);

if($_SESSION['Mail'] != "") { 


$order = New Order;
$order->CustomersId = $row['CustomersId'];
$results = $order->get_customerOrder();
$orderResult = $results->fetchAll(PDO::FETCH_ASSOC);
//  var_dump($orderResult);
?>


<!-- Customer Orders -->
 <?php foreach($orderResult as $rowResult) {
    $order->OrderId = $rowResult['OrderId'];
    $test = $order->get_order();
    $customersOrders = $test->fetchAll(PDO::FETCH_ASSOC); ?>

<main id="customer-pages">
<span><?php echo $message;?></span>
<h3> Välkommen <?php echo $row['Firstname']; echo " "; echo $row['Lastname']; ?>!</h3>
<div class="Order">  
    <a class="back-btn" href="customerstart">Tillbaka</a>         
<div class="order-productdetails">
      
            <?php foreach($customersOrders as $row) { ?>
                <div class="orders">
           <h4> Ordernr: <?php echo $rowResult['OrderId']; ?></h4>
           <span>Orderdatum: <?php echo $row['Date']; ?></span>
            <span><?php echo $row['ProductName'];?></span>
            <span>Storlek: <?php echo $row['Size'];?></span>
            <span>Antal: <?php echo $row['Quantity'];?></span>
            <span>Pris: <?php echo $row['Price'];?> SEK</span>
           </div>
            <?php } ?>
            </div>
            <?php } ?> 
</main>
            <?php } else { ?>
            <main>
            <span>Du har ingen behörighet att se det här. Logga in först?!</span>
            </main>
<?php 
            } ?>
