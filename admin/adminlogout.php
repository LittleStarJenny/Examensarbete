<?php 
    unset($_SESSION['Admin']);
    unset($_SESSION['Name']);
    session_destroy();
    header("Location:http://localhost/Stellasina/"); 
    exit;
?>