<?php

function connect() {
    /* Establish a connection to the database */
     $host = 'localhost';
     $db   = 'stellasina';
     $user = 'root';
     $pass = '';
     $charset = 'utf8';

     $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

     try {
          $pdo = new PDO($dsn, $user, $pass);
     } catch (\PDOException $e) {
          throw new \PDOException($e->getMessage(), (int)$e->getCode());
     }

     return $pdo;
}

define('ROOT_PATH', dirname(__DIR__) . '/');
// $config = array(
//     "paths" => array(
//         "images" => array(
//             "img" => $_SERVER["DOCUMENT_ROOT"] . "img/"
//         )
//     )
// );
// return $config;


?>