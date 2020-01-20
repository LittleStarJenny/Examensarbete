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

// Create orders
    $CustomersId = filter_input(INPUT_POST, 'CustomersId', FILTER_SANITIZE_STRING);
 }  
    if($order->CustomersId = $CustomersId) {
        $order->create_order();
        //   header("location:orderconfirmation.php");
    } else {
        echo 'Ordern kunde inte skapas';
    }


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

            $rowtotal = $values['Price'] * $values['quantity'];
            $total += $rowtotal;
            $totalwithshipping = $total + 59; 
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
// Check if Mail exist in database and fetch customer info
if (isset($_POST["checkCustomer"])) {
    $Mail = $_POST["checkCustomer"];
}
if(isset($_POST["checkCustomer"])) {
    $customer->Mail = $Mail;
    $result = $customer->get_customer();
    $row = $result->fetch(); ?>
    <div class="CustomerInfo">
        <span><?php if( isset( $row['Firstname'] ) ) { echo $row["Firstname"]; } echo " "; if( isset( $row['Lastname'] ) ) { echo $row["Lastname"]; } ?></span>
        <span><?php if( isset( $row['Address'] ) ) { echo $row["Address"]; } ?></span>
        <span><?php  if( isset( $row['Zipcode'] ) ) { echo $row["Zipcode"]; }echo " "; if( isset( $row['City'] ) ) { echo $row["City"]; } ?></span>
        <span><?php if( isset( $row['Mail'] ) ) { echo $row["Mail"]; } ?></span>
        <span><?php if( isset( $row['Phone'] ) ) { echo $row["Phone"]; ?></span>
        <input type ="hidden" name="CustomersId" value="<?php echo $row['CustomersId'] ?>">
        <!-- <input type="submit" name="buy" value="Bekräfta köp"> -->
        </div>
        <?php
} else {
    echo "Kund hittades inte fyll i nedan!"; ?>
    <div class="CustomerInfo">
    <span>Förnamn</span>    
    <input text name="Firstname" value="<?php if( isset( $row['Firstname'] ) ) { echo $row["Firstname"]; } ?>">
    <span>Efternamn</span>    
    <input text name="Lastname" value="<?php if( isset( $row['Lastname'] ) ) { echo $row["Lastname"]; }?>">
    <span>Adress</span>    
    <input text name="Address" value="<?php if( isset( $row['Address'] ) ) { echo $row["Address"]; } ?>">
    <span>Postnr</span>    
    <input text name="Zipcode" value="<?php if( isset( $row['Zipcode'] ) ) { echo $row["Zipcode"]; }?>">
    <span>Postadress</span>    
    <input text name="City" value="<?php if( isset( $row['City'] ) ) { echo $row["City"]; }?>">
    <span>Mail</span>    
    <input text name="Mail" value="<?php if( isset( $row['Mail'] ) ) { echo $row["Mail"]; }?>">
    <span>Telefon</span>    
    <input text name="Phone" value="<?php if( isset( $row['Phone'] ) ) { echo $row["Phone"]; }?>">
    <input type="submit" name="buy" value="Skapa kund">
</div>
</form>
<?php

    }
} ?>
</div>
</section>
</main>
<?php include_once 'footer.php' ?>