<?php
include_once "../header.php";
// session_start(); 
$pdo = connect();
$err_message = "";
$message = "";
$admin = New Admin;
// if(isset($_POST['saveAdmin'])) {
//     $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
//     $Firstname = filter_input(INPUT_POST, 'Firstname', FILTER_SANITIZE_STRING);
//     $Passwords = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_MAGIC_QUOTES);
//     $passwordHashed = password_hash($Passwords, PASSWORD_DEFAULT);
//     $admin->username = $username;
//     $admin->Firstname = $Firstname;
//     $admin->Password = $passwordHashed;

//     $admin->create_admin();
//     $message ="Konto skapades";
// } else {
//     $message = "Något gick fel, försök igen";
// }

if(isset($_POST['login'])) {
    $username = $_POST['user'];
    // var_dump($Mail);
    $Password = $_POST['Pass'];
    // var_dump($Password);
//  $this->username = $username;
//  $this->Password = $Password;

$row = $admin->admin_login($username, $Password);
}

 var_dump($_SESSION);

?>
<main>
<div class="login-container">
<form method="post" action="adminlogin.php?success">
<span>username</span>
<input type="text" name="username">
<span>Firstname</span>
<input type="text" name="Firstname">
<span>Password</span>
<input type="password" name="Password">
<input type="submit" value="Spara" name="saveAdmin">
<span class="error"><?php echo $message ?></span>
</form>


        <h1>Välommen</h1>
        <h3>Login in by using your username and e-mail!</h3>
        <form method="post" action="">
            Username:<br>
            <input type="text" name="user"><br>
            Password:<br>
            <input type="password" name="Pass"><br>
            <input type="submit" name="login" value="Log in">
            <span class="error"><?php echo $err_message ?></span>
        </form>
        </div>
        </main>