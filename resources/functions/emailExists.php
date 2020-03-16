<?php
// Checks if Email exists, used in checkout.php to return different else statement.
function emailExists($pdo, $Mail) {
    $stmt = $pdo->prepare("SELECT 1 FROM customers WHERE Mail=?");
    $stmt->execute([$Mail]); 
    return $stmt->fetchColumn();
}
?>