<?php 
include_once 'adminheader.php';

$admin = New Admin;
$message = "";

// Call create admin function
if(isset($_POST['saveAdmin'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $Firstname = filter_input(INPUT_POST, 'Firstname', FILTER_SANITIZE_STRING);
    $Passwords = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_MAGIC_QUOTES);
    $passwordHashed = password_hash($Passwords, PASSWORD_DEFAULT);
    // var_dump($username);
    $admin->username = $username;
    $admin->Firstname = $Firstname;
    $admin->Password = $passwordHashed;

    if($admin->create_admin()) {
        $message ="Konto skapades";
    } else {
        $message = "Något gick fel, försök igen";
    }
}
?>
<main id="main-admin">
    <?php include_once 'adminsidebar.php'; ?>
    <div class="login-container">
        <form method="post" action="skapa-admin/success">
        <span class="form-label">Användarnamn</span>
            <input type="text" name="username">
            <span class="form-label">Namn</span>
            <input type="text" name="Firstname">
            <span class="form-label">Lösenord</span>
            <input type="password" name="Password">
            <input class="submit-btn" type="submit" value="Spara" name="saveAdmin">
            <span class="error"><?php echo $message ?></span>
        </form>
    </div>
</main>
