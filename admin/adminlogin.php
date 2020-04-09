<?php

$err_message = "";
$message = "";
$admin = New Admin;

// Call admin-login function
if(isset($_POST['login'])) {
    $username = $_POST['user'];
    $Password = $_POST['Pass'];
    $row = $admin->admin_login($username, $Password);
}
?>
<main>
    <div class="login-container">
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