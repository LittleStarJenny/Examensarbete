<?php 
include_once 'adminheader.php';
$order = New Order;
$all = $order->get_all_orders_fromNewest();
$allOrders = $all->fetchAll();
?>


<main id="main-admin">
    <div class="orderWrapper">
        <?php foreach($allOrders as $orders) { ?>
        <div class="perOrder">
        <div class="ordergeneral">
            <span><?php echo $orders['Date']; ?></span>
            <span><?php echo $orders['OrderId']; ?></span>
            </div>
            <?php  
            $order->OrderId = $orders['OrderId'];
            $getOrder = $order->get_order();
            $orderItems = $getOrder->fetchAll(PDO::FETCH_ASSOC);;
            $getCustomer = $order->get_customerByorder();
            $customerInfo = $getCustomer->fetch(); ?>
            <div class="customer">
            <span><?php echo $customerInfo['Firstname']; echo " "; echo $customerInfo['Lastname']; ?></span>
            </div>
           <?php foreach($orderItems as $row) {  ?>
            <div class="products">
                <span><?php echo $row['ProductName']; ?></span>
                <span>Storlek: <?php echo $row['Size']; ?></span>
                <span>Antal: <?php echo $row['Quantity']; ?></span>
                </div>
            <?php } ?>
            </div>
     <?php   } ?>
    </div>
</main>
