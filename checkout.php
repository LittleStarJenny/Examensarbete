<?php 
include_once "header.php";
$customer = New Customer;
$order = New Order;
$product = New Product;
$total = 0;
$row = [];
$Date = date("Y-m-d");


if(isset($_COOKIE["cart"])) {
    $cookie_data = stripslashes($_COOKIE['cart']);
    $cart_data = json_decode($cookie_data, true);
    //    var_dump($cart_data);
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

    $testmailtest = $customer->get_customer();
    $testmail = $testmailtest->fetch();

// Check if email exist otherwise create customer
if( $testmail ) {
        echo "Email found!";
    } else {
        echo "Email not found!";
        $customer->create_customer(); 
    }

// Create orders
    $CustomersId = filter_input(INPUT_POST, 'CustomersId', FILTER_SANITIZE_STRING);
    if($order->CustomersId = $CustomersId) {
        $order->create_order();
          header("location:orderconfirmation.php");
    } else {
        echo 'Ordern kunde inte skapas';
    }
}

// Check if Birthday exist in database and fetch customer info
if (isset($_POST["Birthday"])) {
    $Birthday = $_POST["Birthday"];
}

if(isset($_POST["Birthday"])) {
    $customer->Birthday = $Birthday;
    $result = $customer->get_birthday();
    $row = $result->fetch();
} 

?>
<main id="cart-content">
    <div class="cart">
        <h3>Varukorg</h3>
        <?php
        if(empty($cart_data)) {
        echo $message = 'Cart is empty';
        } else {

        foreach($cart_data as $keys => $values){
            $ProductsId = $cart_data[$keys]['ProductsId'];
            
            $product->ProductsId = $ProductsId;
            $product->ProductId = $ProductsId;
            $test = $product->get_product();
            $result = $product->get_productvariation();
            $showpID = $result->fetch();
            $getProd = $test->fetch();
            // var_dump($showpID);


            $rowtotal = $values['Price'] * $values['quantity'];
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
                <input type="hidden" name="quantity" step="1" min="1" value="<?php echo $values["quantity"]?>">
                <input type="hidden" name="ProductvariationsId" value="<?php echo $showpID["PVId"]?>">
                <input type ="hidden" name="ProductsId" value="<?php echo $values['ProductsId'] ?>">
                <input type="hidden" name="Size" value="<?php echo $values['Size']; ?>">
                <input type="text" name="OrderId" value="<?php echo $OrderId; ?>">
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

<!-- Total Sum -->
    <div class="Total">
        <h3>Summa</h3>
        <span colspan="3">Totalt</span>
        <?php 
            $total += $rowtotal;
            $totalwithshipping = $total += $rowtotal + 59; 
        ?>
        <span><?php echo $total; ?> SEK</span>
        <span>Frakt 59 SEK</span>
        <span><?php echo $totalwithshipping ?> SEK</span>
    </div>
    </div>
</main>



        <main class="checkout">
    <div class="checkout-wrap">
<table class="cart-table">
<form method="post" action="checkout.php">

<input type ="hidden" name="CustomersId" value="<?php echo $row['CustomersId'] ?>">
<span>Personnr: (YYYY-MM-DD) </span>    
<input text name="Birthday" placeholder=""> 
<input type="submit" name="submit" value="Hämta adress"/>
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
<input type="submit" name="buy" value="Bekräfta köp">
</form>
