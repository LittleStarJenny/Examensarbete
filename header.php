<?php 
session_start();
 include_once 'resources/include.php';

$productCat = New Product;
$total = 0;
$message = '';
$result = $productCat->get_categoryForHeader(); 
$category = $result->fetchAll();

if(isset ($_SESSION['authorized']) && $_SESSION['authorized'] != false) {
  } else {
    $_SESSION['authorized'] = false;
  }

  if(isset ($_SESSION['Mail']) && $_SESSION['Mail'] != "") {
  } else {
    $_SESSION['Mail'] = "";
  }
?>

<!DOCTYPE html>
<html>
    <head>
      <title>
        <?php if(isset($title) && !empty($title)) {
          echo $title;
        } else {
          echo "Stellasina";
        } ?> </title>
                <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="https://fonts.googleapis.com/css?family=Alex+Brush" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Martel:300" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/v4-shims.css">
        <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="http://localhost/Stellasina/js.js"></script>
        <link rel="stylesheet" type="text/css" href="http://localhost/Stellasina/css/style.css?d=<?php echo time(); ?>">
        <link rel="stylesheet" type="text/css" href="http://localhost/Stellasina/css/admin.css?d=<?php echo time(); ?>">
        <link rel="stylesheet" type="text/css" href="http://localhost/Stellasina/css/customer.css?d=<?php echo time(); ?>">
        <link rel="stylesheet" type="text/css" href="http://localhost/Stellasina/css/shop.css?d=<?php echo time(); ?>">
    </head>

<body> 
    <header>
      <div class="header-logo">
        <a href="http://localhost/Stellasina/"><img src="http://localhost/Stellasina/img/logo.png"></a>
      </div>
      <?php if($_SESSION['authorized'] != true) { ?> 
        <a href="http://localhost/Stellasina/login" class="login-logout"><i class="far fa-user"></i> Logga in</a>
      <?php } else if(isset ($_SESSION['authorized']) && $_SESSION['authorized'] === true) { ?> 
        <a href="http://localhost/Stellasina/customerstart" class="my-account login-logout">Mitt konto</a> 
        <a href="http://localhost/Stellasina/logout" class="login-logout"><i class="far fa-user"></i> Logga ut</a>                                  
      <?php } ?>
    
      <nav class="main-nav">
        <div class="cart-button"> 
            <div class="qty-in-cart"></div>
            <i class="fas fa-shopping-cart"></i>
        </div>
        <ul>
            <li><a href="http://localhost/Stellasina/products">Butiken</a></li>
            <?php foreach($category as $row) { ?>
            <li><a href="http://localhost/Stellasina/category/<?php echo $row['CategoryName']; ?>"><?php echo $row['CategoryName'] ?></a></li>
            <?php } ?>
        </ul>
      </nav>
    </header>
    
    <?php   include_once 'headercart.php'; ?> 
    

