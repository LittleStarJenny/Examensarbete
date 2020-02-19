<?php 
session_start();
if(isset ($_SESSION['authorized']) && $_SESSION['authorized'] != false){
  } else {
    $_SESSION['authorized'] = false;
  }


// var_dump($_SESSION);
include_once 'dbo.php';
$productCat = New Product;
$total = 0;
$message = '';


 $result = $productCat->get_categoryForHeader(); 
$category = $result->fetchAll();
?>

<!DOCTYPE html>
<html>
    <head>
        <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="../js.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css?d=<?php echo time(); ?>">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
        <a href="http://localhost/Examensarbete-Stellasina/"><img src="../img/logo.png"></a>
        </div>
        <?php if($_SESSION['authorized'] != true){?> 
     <a href="customerlogin.php" class="login-logout"><i class="far fa-user"></i> Logga in</a>
    <?php } else if(isset ($_SESSION['authorized']) && $_SESSION['authorized'] === true){ ?> 
            <a href="customerstart.php" class="login-logout">Mitt konto</a> 
            <a href="../logout.php" class="login-logout"><i class="far fa-user"></i> Logga ut</a>                                  
             <?php } ?>
    
        <nav class="main-nav">
            <ul>
                <li><a href="products">Butiken</a></li>
                <?php foreach($category as $row) { ?>
                <li><a href="category-page.php?category=<?php echo $row['CategoryId']; ?>"><?php echo $row['CategoryName'] ?></a></li>
                <?php } ?>
               <div class="cart-button"> 
                   <div class="qty-in-cart"></div>
                   <i class="fas fa-shopping-cart"></i></div>
            </ul>
    </nav>
    </header>
    

