<?php 

$message = '';
$customer = New Customer;
$order = New Order;
$customer->Mail = $_SESSION['Mail'];
$result = $customer->get_customer();
$row = $result->fetch(); 

$get = $order->get_lastOrder();
$LastOrderID = $get->fetch();
$order->OrderId = $LastOrderID['OrderId'];
$lastOrder = $order->get_order();
$Order = $lastOrder->fetchAll();

if($_SESSION['Mail'] != "") { ?>
    <main id="customer-pages">
        <span><?php echo $message;?></span>
        <h3> Välkommen <?php echo $row['Firstname']; echo " "; echo $row['Lastname']; ?>!</h3>
        <section class="customer-latest-info">
            <div class="address-update">
                <h4>Dina uppgifter</h4>
                <span><?php echo $row['Firstname']; echo " "; echo $row['Lastname']; ?></span>
                <span><?php echo $row['Address']; ?></span>
                <span><?php echo $row['Zipcode']; echo " "; echo $row['City']; ?></span>
                <span><?php echo $row['Mail']; ?></span>
                <span><?php echo $row['Phone']; ?></span>
                <a href="update">Uppdatera dina uppgifter</a>
            </div>
            <div class="orders">
                <h4>Senaste beställning</h4>
                <?php foreach($Order as $orderRow) { ?>
                    <span><?php echo $orderRow['ProductName'];?></span>
                    <span>Storlek: <?php echo $orderRow['Size'];?></span>
                    <span>Antal: <?php echo $orderRow['Quantity'];?></span>
                    <span>Pris: <?php echo $orderRow['Price'];?> SEK</span>
                <?php } ?>
                <a href="yourorders">Dina beställningar</a>
            </div>
        </section>       
    </main>
<?php } else { ?>
    <main>
        <span>Du har ingen behörighet att se det här. Logga in först?!</span>
    </main>
<?php } ?>