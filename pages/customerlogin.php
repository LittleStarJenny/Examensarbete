<?php
include_once "header.php";
// session_start(); 
$pdo = connect();
$err_message = "";
$customer = New Customer;

if(isset($_POST['login'])) {
    $Mail = $_POST['Mail'];
    // var_dump($Mail);
    $Password = $_POST['Password'];
    // var_dump($Password);
 $customer->Mail = $Mail;
 $customer->Password = $Password;

$row = $customer->login($Mail, $Password);
}

 var_dump($_SESSION);


?>

<div class="login-container">
        <h1>Välommen</h1>
        <h3>Login in by using your username and e-mail!</h3>
        <form method="POST">
            Username:<br>
            <input type="text" name="Mail"><br>
            Password:<br>
            <input type="password" name="Password"><br>
            <button type="submit" name="login" value="Log in">Submit</button>
            <span class="error"><?php echo $err_message ?></span>
        </form>
        </div>