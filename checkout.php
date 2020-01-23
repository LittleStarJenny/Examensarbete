<?php 
include_once "header.php";
$customer = New Customer;
$order = New Order;
$product = New Product;
$total = 0;
$totalwithshipping = 0;
$row = [];
$Date = date("Y-m-d");

if(isset($_COOKIE["cart"])) {
    $cookie_data = stripslashes($_COOKIE['cart']);
    $cart_data = json_decode($cookie_data, true);
  }
    
     if(isset($_POST["buy"])) {
// Create order
    $CustomersId = filter_input(INPUT_POST, 'CustomersId', FILTER_SANITIZE_STRING);
        if($order->CustomersId = $CustomersId) {
            $order->create_order();
            $lastOrder = $order->get_lastOrder();
            $OrderId = $lastOrder->fetch();
// Create orderitems   
        foreach($cart_data as $keys => $values) {
            $product->ProductId = $values['ProductsId'];
            $result = $product->get_productvariation();
            $showpID = $result->fetch();
 
 $ProductvariationsId = $showpID["PVId"];
$Quantity =  $values['quantity'];
$order->ProductvariationsId = $ProductvariationsId;
$order->Quantity = $Quantity;
$order->OrderId = $OrderId['OrderId'][0];
       print_r($order->create_orderItem());
    }
       header("location:orderconfirmation.php");
       setcookie("cart", "", time() - 3600);
    } else {
        echo 'Ordern kunde inte skapas';
    }
}

print_r($order);
?>
<main id="checkoutWrap">
<section id="cart-content">
    <div class="cart">
        <h3>Varukorg</h3>
        <?php
        if(empty($cart_data)) {
        echo $message = 'Cart is empty';
        } else {

        foreach($cart_data as $keys => $values){
            $ProductsId = $cart_data[$keys]['ProductsId'];

  
            // $product->ProductsId = $ProductsId;
            $product->ProductId = $ProductsId;

            $rowtotal = $values['Price'] * $values['quantity'];
            $total += $rowtotal;
            $totalwithshipping = $total + 59; 

            $result = $product->get_productvariation();
            $showpID = $result->fetch();
        ?>

        <div class="cartitem">   
            <form action="cart.php?action=update" method="post">
                <div class="cart-img-qty">
                    <img class="cart-img" src=<?php echo $values['Img'] ?>>
                </div>
                <div class="cart-textdetails">
                <span class="cart-prod-details"><?php echo $values['ProductName']; ?></span>
                <span class="cart-prod-size"><?php echo $values['Size']; ?></span>
                <span class="cart-qty"><?php echo $values["quantity"]?></span>
                <input type="text" name="ProductvariationsId" value="<?php echo $showpID["PVId"]?>">
                <input type="text" name="quantity" step="1" min="1" value="<?php echo $values["quantity"]?>">
                <input type ="hidden" name="ProductsId" value="<?php echo $values['ProductsId'] ?>">              
                <span class="cart-prod-price"><?php echo $values['Price']; ?> SEK</span>
                    <div class="prod-total">
                        <span>Totalt</span>
                        <span><?php echo $rowtotal; ?> SEK</span>
                    </div>
                </div>
            </form>
        <?php }  
            }
        ?>
    </div>
<hr>
<!-- Total Sum -->
<div class="Total">
    <h3>Summa</h3>        
        <div>
        <span colspan="3">Totalt</span>
        <span><?php echo $total; ?> SEK</span>
        </div>
        <div>
        <span>Frakt</span>
        <span> 59 SEK</span>
        </div>
        <div> 
        <span>Att betala</span>
        <span><?php echo $totalwithshipping ?> SEK</span>
    </div>
    </div>
        </section>

<!-- Customer Info -->
<section class="checkout">
    <div class="checkout-wrap">
<form method="post" action="checkout.php">
<div>
    <h2>Hämta adress eller registrera dig</h2>
        <span>Email: </span>    
        <input text name="checkCustomer" placeholder=""> 
        <input type="submit" name="submit" value="SÖK"/>
</div>
<?php
if(isset($_POST["save"])) {
    
    $Firstname = filter_input(INPUT_POST, 'Firstname', FILTER_SANITIZE_STRING);
    $Lastname = filter_input(INPUT_POST, 'Lastname', FILTER_SANITIZE_STRING);
    $Birthday = filter_input(INPUT_POST, 'Birthday', FILTER_SANITIZE_STRING);
    $Address = filter_input(INPUT_POST, 'Address', FILTER_SANITIZE_STRING);
    $Zipcode = filter_input(INPUT_POST, 'Zipcode', FILTER_SANITIZE_STRING);
    $City = filter_input(INPUT_POST, 'City', FILTER_SANITIZE_STRING);
    $Mail = filter_input(INPUT_POST, 'Mail', FILTER_SANITIZE_STRING);
    $Phone = filter_input(INPUT_POST, 'Phone', FILTER_SANITIZE_STRING);

    $customer->Firstname = $Firstname;
    $customer->Lastname = $Lastname;
    $customer->Birthday = $Birthday;
    $customer->Address  = $Address;
    $customer->Zipcode = $Zipcode;
    $customer->City = $City;
    $customer->Mail = $Mail;
    $customer->Phone = $Phone;

    $customer->create_customer();
    $lastCustomerCreated = $customer->get_lastCreatedcustomer();
    $row = $lastCustomerCreated->fetch(); }  ?>
    <div class="CustomerInfo">
        <span><?php if( isset( $row['Firstname'] ) ) { echo $row["Firstname"]; } echo " "; if( isset( $row['Lastname'] ) ) { echo $row["Lastname"]; } ?></span>
        <span><?php if( isset( $row['Address'] ) ) { echo $row["Address"]; } ?></span>
        <span><?php  if( isset( $row['Zipcode'] ) ) { echo $row["Zipcode"]; }echo " "; if( isset( $row['City'] ) ) { echo $row["City"]; } ?></span>
        <span><?php if( isset( $row['Mail'] ) ) { echo $row["Mail"]; } ?></span>
        <span><?php if( isset( $row['Phone'] ) ) { echo $row["Phone"];  ?></span>
        <input type ="hidden" name="CustomersId" value="<?php echo $row['CustomersId'] ?>">
        <input type="submit" name="buy" value="Bekräfta köp">
        </div>
 <?php } else {
     echo 'Kunde inte skapa kund';
 }
// Check if Mail exist in database and fetch customer info
if (isset($_POST["checkCustomer"])) {
    $Mail = $_POST["checkCustomer"];
}
if(isset($_POST["checkCustomer"])) {
    $customer->Mail = $Mail;
    $result = $customer->get_customer();
    $row = $result->fetch();  ?>
    <div class="CustomerInfo">
        <span><?php if( isset( $row['Firstname'] ) ) { echo $row["Firstname"]; } echo " "; if( isset( $row['Lastname'] ) ) { echo $row["Lastname"]; } ?></span>
        <span><?php if( isset( $row['Address'] ) ) { echo $row["Address"]; } ?></span>
        <span><?php  if( isset( $row['Zipcode'] ) ) { echo $row["Zipcode"]; }echo " "; if( isset( $row['City'] ) ) { echo $row["City"]; } ?></span>
        <span><?php if( isset( $row['Mail'] ) ) { echo $row["Mail"]; } ?></span>
        <span><?php if( isset( $row['Phone'] ) ) { echo $row["Phone"];  ?></span>
        <input type ="hidden" name="CustomersId" value="<?php echo $row['CustomersId']; ?>">
        <input type="submit" name="buy" value="Bekräfta köp">
        </div>
        <?php
} else {
    echo "Kund hittades inte fyll i nedan!"; ?>
    <div class="CustomerInfo">
    <span>Förnamn</span>    
    <input text name="Firstname" pattern="[a-zåäöA-ZÅÄÖ]+" required value="">
    <span>Efternamn</span>    
    <input text name="Lastname" pattern="[a-zåäöA-ZÅÄÖ]+" required value="">
    <span>Adress</span>    
    <input text name="Address" pattern="[a-zåäöA-ZÅÄÖ0-9\s]+" required value="">
    <span>Postnr</span>    
    <input tel name="Zipcode" required pattern="[0-9]{3} [0-9]{2}" required placeholder="555 55">
    <span>Postadress</span>    
    <input text name="City" pattern="[a-zåäöA-ZÅÄÖ]+" required value="">
    <span>Mail</span>    
    <input mail name="Mail" required placeholder="your@email.com">
    <span>Mobil</span>    
    <input tel name="Phone" pattern="[0-9]{3}-[0-9]{3} [0-9]{2} [0-9]{2}" required placeholder="073-555 66 88">
    <input type="submit" name="save" value="Spara">
    </div>

<?php }
 }   
 ?>
 </form>
</div>
</section>
</main>
<?php include_once 'footer.php' ?>