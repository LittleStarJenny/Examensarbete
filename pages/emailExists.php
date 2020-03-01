<?php
function emailExists($pdo, $Mail) {
    $stmt = $pdo->prepare("SELECT 1 FROM customers WHERE Mail=?");
    $stmt->execute([$Mail]); 
    return $stmt->fetchColumn();
}
?>