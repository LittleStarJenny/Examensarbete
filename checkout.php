<?php 
include_once "header.php";
include_once "emailExists.php";
$pdo = connect();
$customer = New Customer;
$order = New Order;
$product = New Product;
$total = 0;
$totalwithshipping = 0;
$row = [];
$Date = date("Y-m-d");
$err_message = '';
var_dump($_SESSION);

if(isset($_COOKIE["cart"])) {
    $cookie_data = stripslashes($_COOKIE['cart']);
    $cart_data = json_decode($cookie_data, true);
}

if(isset ($_SESSION['Mail']) && $_SESSION['Mail'] != ''){
} else {
  $_SESSION['Mail'] = '';
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
                $product->ProductId = $ProductsId;
                // Calculate all sum on page
                $rowtotal = $values['Price'] * $values['quantity'];
                $total += $rowtotal;
                $totalwithshipping = $total + 59; 

                $result = $product->get_productvariation();
                $showpID = $result->fetch();
            ?>

                <div class="cartitem">   
                    <form action="" method="post">
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
                </div>
                <hr>
                <?php }  
                        }
                    ?>
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
        </div>        
    </section>

    <!-- Customer Info -->
<section class="checkout">
    <div class="checkout-wrap">
        <div id="wrap">
        <form method="POST" action="">
            <span>Mail</span>    
            <input mail id="mail" name="Mail" required placeholder="your@email.com" value="<?php if(isset($_POST['Mail'])) { echo $_POST['Mail']; } ?>">
            <input type="submit" name="check" value="Check">
        </form>
    </div>

<?php 
if(isset($_POST['check'])) {
    $Mail = $_POST['Mail'];
    if (emailExists($pdo, $Mail)) {
        $customer->Mail = $Mail;
        $result = $customer->get_customer();
        $row = $result->fetch(); 
        $err_message = 'Mailen finns redan registrerad, logga in istället?! <a href="customerlogin.php">Logga in</a>'; ?>
<?php 
    } else { 
        $err_message = 'Email hittades inte, registrera dig nedan!
        <form method="post" action="">
        <h4>Registrera dig</h4> 
        <div class="CustomerInfo"> 
        <br><span>Förnamn</span> 
        <input text name="Firstname" pattern="[a-zåäöA-ZÅÄÖ]+"  value="">
        <span>Efternamn</span>     
        <input text name="Lastname" value="">
        <span>Adress</span>    
        <input text name="Address" pattern="[a-zåäöA-ZÅÄÖ0-9\s]+"  value="">
        <span>Postnr</span>    
        <input tel name="Zipcode" pattern="[0-9]{3} [0-9]{2}" placeholder="555 55">
        <span>Postadress</span>    
        <input text name="City" pattern="[a-zåäöA-ZÅÄÖ]+" value="">
        <span>Mobil</span>    
        <input tel name="Phone" pattern="[0-9]{3}-[0-9]{3} [0-9]{2} [0-9]{2}" placeholder="073-555 66 88">
        <span>Lösenord</span> 
        <input type="password" name="Password">
        <input type="submit" name="save" value="Spara">
        </div> 
        </form>'; ?> 
<?php   
    } 
} ?>

<p><?php  echo $err_message; ?></p>

<?php
if(isset($_POST['save'])) {
    $Firstname = filter_input(INPUT_POST, 'Firstname', FILTER_SANITIZE_STRING);
    $Lastname = filter_input(INPUT_POST, 'Lastname', FILTER_SANITIZE_STRING);
    $Birthday = filter_input(INPUT_POST, 'Birthday', FILTER_SANITIZE_STRING);
    $Address = filter_input(INPUT_POST, 'Address', FILTER_SANITIZE_STRING);
    $Zipcode = filter_input(INPUT_POST, 'Zipcode', FILTER_SANITIZE_STRING);
    $City = filter_input(INPUT_POST, 'City', FILTER_SANITIZE_STRING);
    $Mail = filter_input(INPUT_POST, 'Mail', FILTER_SANITIZE_STRING);
    $Phone = filter_input(INPUT_POST, 'Phone', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_MAGIC_QUOTES);
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
    $customer->Firstname = $Firstname;
    $customer->Lastname = $Lastname;
    $customer->Birthday = $Birthday;
    $customer->Address  = $Address;
    $customer->Zipcode = $Zipcode;
    $customer->City = $City;
    $customer->Mail = $Mail;
    $customer->Phone = $Phone;
    $customer->Password = $passwordHashed;
    $customer->create_customer();
    $lastCustomerCreated = $customer->get_lastCreatedcustomer();
    $rows = $lastCustomerCreated->fetch(); 
}


if(isset($_POST['login'])) {
    $Mail = $_POST['Mail'];
    $Password = $_POST['Password'];
    $customer->Mail = $Mail;
    $customer->Password = $Password;

    $row = $customer->login($Mail, $Password);
}

if($_SESSION['Mail'] != '') {
    $customer->Mail = $_SESSION['Mail'];
    $result = $customer->get_customer();
    $rows = $result->fetch(); ?>
<form method="POST" action="">
    <div class="CustomerInfo">
        <span><?php if( isset( $rows['Firstname'] ) ) { echo $rows["Firstname"]; } echo " "; if( isset( $rows['Lastname'] ) ) { echo $rows["Lastname"]; } ?></span>
        <span><?php if( isset( $rows['Address'] ) ) { echo $rows["Address"]; } ?></span>
        <span><?php if( isset( $rows['Zipcode'] ) ) { echo $rows["Zipcode"]; } echo " "; if( isset( $rows['City'] ) ) { echo $rows["City"]; } ?></span>
        <span><?php if( isset( $rows['Mail'] ) ) { echo $rows["Mail"]; } ?></span>
        <span><?php if( isset( $rows['Phone'] ) ) { echo $rows["Phone"]; } ?></span>
        <input type="submit" name="buy" value="Bekräfta köp">
    </div> 
</form>
<input type ="text" name="CustomersId" value="<?php echo $rows['CustomersId']; ?>">
<?php }
if(isset($_POST["buy"])) {
    // Create order
          $CustomersId = $rows['CustomersId'];
        //  $CustomersId = filter_input(INPUT_POST, 'CustomersId', FILTER_SANITIZE_STRING);
        var_dump($CustomersId);
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
                $order->OrderId = $OrderId['OrderId'];
                $order->create_orderItem();
               
            } 
            header('location:orderconfirmation.php');
            setcookie("cart", "", time() - 3600);
        } else {
            echo 'Ordern kunde inte skapas';
        }
      
    } ?> 
            
    </div>
</section>
</main>
<?php include_once 'footer.php' ?>