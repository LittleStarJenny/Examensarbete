<?php
include_once 'adminheader.php';
var_dump($_SESSION);

?>

<main>
Hej <?php echo $_SESSION["Name"]; ?>
<nav class="admin-nav">
    <a href="createproduct.php">Skapa Produkt</a>
    <a href="orders.php">Kundorder</a>
</nav>
</main>
