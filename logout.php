<?php 
         session_start();
         unset($_SESSION['authorized']);
         unset($_SESSION['Mail']);
         unset($_SESSION['Firstname']);
         session_destroy();
         header("Location:http://localhost/Stellasina/"); 
         exit;
         ?>