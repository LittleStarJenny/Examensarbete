<?php
include_once 'adminheader.php';
// session_start(); 
// $pdo = connect();
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

//  var_dump($_SESSION);

?>
<main>
<div class="login-container">
<!-- <form method="post" action="adminlogin.php?success">
<span>username</span>
<input type="text" name="username">
<span>Firstname</span>
<input type="text" name="Firstname">
<span>Password</span>
<input type="password" name="Password">
<input type="submit" value="Spara" name="saveAdmin">
<span class="error"><?php echo $message ?></span>
</form> -->


        <h1>Admin</h1>
        <div class="box-wrapper">
        <form method="post" action="">
            <span class="form-label">Användarnamn</span>
            <input type="text" name="user">
            <span class="form-label">Lösenord</span>
            <input type="password" name="Pass">
            <input class="submit-btn" type="submit" name="login" value="Logga in">
            <span class="error"><?php echo $err_message ?></span>
        </form>
        </div>
        </div>
        </main>