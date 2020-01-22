<?php 
include_once 'dbo.php';
$productCat = New Product;
$total = 0;
$message = '';

if(isset($_COOKIE["cart"])) {
    $cookie_data = stripslashes($_COOKIE['cart']);
    $cart_data = json_decode($cookie_data, true); 
  }

 $result = $productCat->get_categoryForHeader(); 
$category = $result->fetchAll();

?>

<!DOCTYPE html>
<html>
    <head>
        <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css?d=<?php echo time(); ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Alex+Brush" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Martel:300" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/v4-shims.css">
            </head>

<body> 
    <header>
        <div class="header-logo">
        <!-- <h1>Stellasina</h1> -->
        <a href="index.php"><img src="img/logo.png"></a>
</div>
        <nav class="main-nav">
            <ul>
                <li><a href="products.php">Butiken</a></li>
                <?php foreach($category as $row) { ?>
                <li><a href="category-page.php?category=<?php echo $row['CategoryId']; ?>"><?php echo $row['CategoryName'] ?></a></li>
                <?php } ?>
               <div class="cart-button"> <i class="fas fa-shopping-cart"></i></div>
            </ul>
    </nav>
    </header>
    
<div class='cart-content'>
    <h2>Min varukorg</h2>
<div class="productsIncart">
<?php  
if(empty($cart_data)) {
    echo $message = 'Varukorgen är tom';
  } else {
foreach($cart_data as $keys => $values){ 
    $rowtotal = $values['Price'] * $values['quantity'];
      $total += $rowtotal; ?>
    <img class="cart-img" src=<?php echo $values['Img'] ?>>
    <div class="cart-text-content">
        <span class='cart-prod-prize'><?php echo $values['Price']; ?> SEK </span>
        <span class="title"><?php echo $values['ProductName']; ?></span>
            <div class="cartRow">
                <span class="cart-prod-size">Storlek <?php echo $values['Size']; ?></span>
                <span class="cart-prod-qty">Antal <?php echo $values["quantity"]?></span>
            </div>
</div>

    <hr>
    <?php  
} 
} 
?>  
    </div>
    <div class="cartSum">
        <span class="total">Totalsumma <?php echo $total ?> SEK</span>
    </div>
    <div class='btn-wrap'>
        <a href="cart.php"><div class='shopping-btn'>Till varukorgen</div></a>
        <a href="checkout.php"><div class='shopping-btn'>Gå till kassan</div></a>
    </div>
</div>
