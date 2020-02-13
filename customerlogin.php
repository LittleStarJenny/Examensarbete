<?php
include_once "header.php";
// session_start(); 
$pdo = connect();

if (isset($_POST['action'])) {
    $Mail = filter_input(INPUT_POST, 'Mail', FILTER_SANITIZE_STRING);
    $Password = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_STRING);
   
$stmt = $pdo->prepare("SELECT * FROM customers WHERE Mail = ? AND Password = ? ;");
// $stmt = $pdo->prepare("SELECT * FROM classicmodels.admin WHERE username = '" . $this->user . "' "); 
$stmt->execute([$Mail, $Password]);
// $rowcount = $stmt->rowCount(PDO::FETCH_ASSOC);
 $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$userLoggedIn = ($rows > 0);

if ($userLoggedIn) {
    $_SESSION['login'] = $Mail && $Password;
    echo "Welcome $Mail, you are now logged in!<br>";
header("location:customerstart.php");
} else {
    echo "There is no such user!<br>";
}
print_r($_SESSION);
echo "<br>";
}

?>

<div class="login-container">
        <h1>Welcome to Classic Models!</h1>
        <h3>Login in by using your username and e-mail!</h3>
        <?php if (isset($_SESSION['logged_in'])): ?> Welcome <?php echo $_SESSION['name']; ?></strong>!<br>
        <?php else: ?>
        <form method="POST">
            Username:<br>
            <input type="text" name="Mail"><br>
            Password:<br>
            <input type="password" name="Password"><br>
            <button type="submit" name="action" value="Log in">Submit</button>
        </form>
        <?php endif; ?>
    </div>
        <!-- <?php if ($userLoggedIn): ?>
        <p>Welcome to our admin<a href="orders.php">ordersite</a></p>
        <?php endif; ?> -->