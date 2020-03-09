<?php
// include_once "header.php";
// session_start(); 
$pdo = connect();
$err_message = "";
// $Mail = '';
// $Password = '';
$customer = New Customer;

if(isset($_POST['login'])) {
    $Mail = $_POST['Mail'];
    $Password = $_POST['Password'];

    $row = $customer->login($Mail, $Password);
}

?>
<main>  
    <div class="login-container">
        <h1>Välkommen</h1>
        <div class="box-wrapper">
        <form method="POST" action="">
            <span class="form-label">Mail</span>
            <input type="mail" name="Mail">
            <span class="form-label">Lösenord</span>
            <input type="password" name="Password">
            <input class="submit-btn" type="submit" name="login" value="Logga in">
          <?php   ?>
        </form>
        </div>
    </div>
</main>