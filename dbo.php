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

function get_all_products($pdo, $limit, $offset) {
    $sql = "";
    if($offset>0){
    $sql = "SELECT * FROM products LIMIT $offset, $limit";
    } else {
         $sql = "SELECT * FROM products LIMIT $limit";
    }

    $toGet = $pdo->prepare($sql); // prepared statement
    $toGet->execute(); // execute sql statment

	return $toGet;
	
}

class Product {
     public $ProductsId = 0;

public function get_product() {
     $pdo = connect();

     $sql = "SELECT * FROM products
             WHERE ProductsId = '" . $this->{"ProductsId"} . "'"; // sql statementS

     $toGet = $pdo->prepare($sql); // prepared statement
     $toGet->execute(); // execute sql statment

     return $toGet;

 }

// ProductVariations
     public $ProductId = 0;
     public $Size = '';

public function get_productvariation() {
     $pdo = connect();

     $sql = "SELECT * FROM productvariations as PV
     JOIN products AS P ON PV.ProductId = P.ProductsId
     WHERE ProductId = '" . $this->{"ProductId"} . "'"; // sql statementS

     $toGet = $pdo->prepare($sql); // prepared statement
     $toGet->execute(); // execute sql statement

     return $toGet;

 }
}

class Customer {
     public $CustomersId = 0;
     public $Birthday = '';


     public function get_customer() {
          $pdo = connect();

          $sql = "SELECT * FROM customers
          WHERE Birthday  = '" . $this->{"Birthday"} . "'" ;
             
     
          $toGet = $pdo->prepare($sql); // prepared statement
          $toGet->execute(); // execute sql statement
     
          return $toGet;
     
      }

public function create_customer() {
     $pdo = connect();

     $sql = "INSERT INTO customers (CustomersId, Firstname, Lastname, Birthday, Address, Zipcode, City, Mail, Phone)
             VALUES ('" . $this->{"CustomersId"} . "', '" . $this->{"Firstname"} . "', '" . $this->{"Lastname"} . "', '" . $this->{"Birthday"} . "', '" . $this->{"Address"} . "', '" . $this->{"Zipcode"} . "', '" . $this->{"City"} . "', '" . $this->{"Mail"} . "', '" . $this->{"Phone"} . "')"; // sql statements

     $toCreate = $pdo->prepare($sql); // prepared statement
     $toCreate->execute(); // execute sql statement

     return $return;
 }
}

?>

