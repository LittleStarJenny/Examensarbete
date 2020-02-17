<?php // Create orderitems    
include_once 'header.php';
$order = New Order;
$product = New Product;


// error_reporting(-1);
// ini_set('display_errors', 'On');
// set_error_handler("var_dump");

// mail("littlestarjenny6@gmail.com","Success","Send mail from localhost using PHP");
// $fromName = 'Jenny';
// $fromEmail = 'littlestarjenny6@gmail.com';

// $to = 'littlestarjenny6@gmail.com';
// $subject = 'Hello from XAMPP!';
// $message = 'This is a test';
// $headers = "From: littlestarjenny6@gmail.com\r\n";
// if (mail($to, $subject, $message, $headers)) {
//    echo "SUCCESS";
// } else {
//    echo "ERROR";
// }
// function sanitize_my_email($field) {
//     $field = filter_var($field, FILTER_SANITIZE_EMAIL);
//     if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
//         return true;
//     } else {
//         return false;
//     }
// }
// $to_email = 'littlestarjenny6@gmail.com';
// $subject = 'Testing PHP Mail';
// $message = 'This mail is sent using the PHP mail ';
// $headers = 'From:  ' . $fromName . ' <' . $fromEmail .'>' . " \r\n" .
// 'MIME-Version: 1.0' . "\r\n" . 
// 'Content-Type: text/html; charset-utf-8';
// //check if the email address is invalid $secure_check
// // $secure_check = sanitize_my_email($to_email);
// // if ($secure_check == false) {
// //     echo "Invalid input";
// // } else { //send email 
//  $result = mail("littlestarjenny6@gmail.com", "Hi there", "Här kommer text", $headers);
//  var_dump($result);
//     echo "This email is sent using PHP Mail";
// }

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
//  var_dump($TestOrderId);
  var_dump($Ordercustomer);

?>

<!-- <form action="orderconfirmation.php?order=<?php echo $OrderId; ?>" method="post"> -->
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


