<?php 
session_start();

include_once '../resources/include.php';
$productCat = New Product;
$message = '';

$result = $productCat->get_categoryForHeader(); 
$category = $result->fetchAll();
?>

<!DOCTYPE html>
<html>
    <head>
        <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js.js"></script>
        <link rel="stylesheet" type="text/css" href="http://localhost/Stellasina/css/style.css?d=<?php echo time(); ?>">
        <link rel="stylesheet" type="text/css" href="http://localhost/Stellasina/css/admin.css?d=<?php echo time(); ?>">
        <link rel="stylesheet" type="text/css" href="http://localhost/Stellasina/css/customer.css?d=<?php echo time(); ?>">
        <link rel="stylesheet" type="text/css" href="http://localhost/Stellasina/css/shop.css?d=<?php echo time(); ?>">
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
        <div class="admin-header">
            <a href="http://localhost/Stellasina/"><img src="http://localhost/Stellasina/img/logo.png"></a>
        </div>
        <!-- If Session admin not is empty show Link Logga ut -->
        <?php if(isset ($_SESSION['Admin']) && $_SESSION['Admin'] != "") { ?> 
            <a href="http://localhost/Stellasina/admin/adminlogout.php" class="login-logout"><i class="far fa-user"></i> Logga ut</a>                                  
        <?php } ?>
    
        <nav class="main-nav">
            <ul>
                <li><a href="http://localhost/Stellasina/admin">Butiken</a></li>
                <?php foreach($category as $row) { ?>
                <li><a href="http://localhost/Stellasina/category/<?php echo $row['CategoryName']; ?>"><?php echo $row['CategoryName'] ?></a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>
    

