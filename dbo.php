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
     public $Productname = '';

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

     $sql = "SELECT * FROM productvariations  as PV
      JOIN products AS P ON PV.ProductId = P.ProductsId
     WHERE ProductId = '" . $this->{"ProductId"} . "'"; // sql statementS

     $toGet = $pdo->prepare($sql); // prepared statement
     $toGet->execute(); // execute sql statement

     return $toGet;

 }

 public function get_productsBycategory() {
     $pdo = connect();

     $sql = "SELECT * FROM categorys as C
     JOIN products AS P ON P.CategoryId = C.CategoryId
     WHERE C.CategoryId = '" . $this->{"CategoryId"} . "'"; // sql statementS

     $toGet = $pdo->prepare($sql); // prepared statement
     $toGet->execute(); // execute sql statement

     return $toGet;

 } 
public $CategoryId = 0;
public $Categoryname = '';

 public function get_category() {
     $pdo = connect();

     $sql = "SELECT * FROM categorys
     WHERE CategoryId = '" . $this->{"CategoryId"} . "'"; // sql statementS

     $toGet = $pdo->prepare($sql); // prepared statement
     $toGet->execute(); // execute sql statement

     return $toGet;

 }

 public function get_categoryForHeader() {
     $pdo = connect();

     $sql = "SELECT * FROM categorys"; // sql statementS

     $toGet = $pdo->prepare($sql); // prepared statement
     $toGet->execute(); // execute sql statement

     return $toGet;

 }

public $ImageId = 0;
public $Image = '';

 public function get_images() {
     $pdo = connect();

     $sql = "SELECT * FROM images
     WHERE ProductsId = '" . $this->{"ProductsId"} . "'"; // sql statementS

     $toGet = $pdo->prepare($sql); // prepared statement
     $toGet->execute(); // execute sql statement

     return $toGet;

 } 
}

class Customer {
     public $CustomersId = 0;
     public $Birthday = 'HEj';
     public $Firstname = '';
     public $Lastname = '';
     public $Address = '';
     public $Zipcode = '';
     public $City = '';
     public $Mail = '';
     public $Phone = '';
     public $Password = '';
     

     public function get_customer() {
          $pdo = connect();

          $sql = "SELECT * FROM customers
          WHERE Mail  = '" . $this->{"Mail"} . "'" ;
             
     
          $toGet = $pdo->prepare($sql); // prepared statement
          $toGet->execute(); // execute sql statement
     
          return $toGet;
     
      }


     public function get_lastcreatedcustomer() {
          $pdo = connect();

          $sql = "SELECT * FROM customers
          ORDER BY CustomersId DESC
          LIMIT 1" ;
             
          $toGet = $pdo->prepare($sql); // prepared statement
          $toGet->execute(); // execute sql statement
     
          return $toGet;
     
      }

public function create_customer() {
     $pdo = connect();

     $sql = "INSERT INTO customers (CustomersId, Firstname, Lastname, Birthday, Address, Zipcode, City, Mail, Phone, Password)
             VALUES ('" . $this->{"CustomersId"} . "', '" . $this->{"Firstname"} . "', '" . $this->{"Lastname"} . "', '" . $this->{"Birthday"} . "', '" . $this->{"Address"} . "', '" . $this->{"Zipcode"} . "', '" . $this->{"City"} . "', '" . $this->{"Mail"} . "', '" . $this->{"Phone"} . "', '" . $this->{"Password"} . "')"; // sql statements

     $toCreate = $pdo->prepare($sql); // prepared statement
     $toCreate->execute(); // execute sql statement

     return $toCreate;
 }

}



class Order {
public $OrderId = 0;
public $OrderitemId = 0;
public $CustomersId = 0;
public $Date = '';

public $ProductvariationsId = 0;
public $Quantity = 0;



public function create_orderItem() {
          $pdo = connect();
     
          $sql = "INSERT INTO orderitem (OrderitemId, ProductvariationsId, Quantity, OrderId)
                  VALUES ('" . $this->{"OrderitemId"} . "', '" . $this->{"ProductvariationsId"} . "', '" . $this->{"Quantity"} . "', '" . $this->{"OrderId"} . "')
                    "; // sql statements
     
          $toCreate = $pdo->prepare($sql); // prepared statement
          $toCreate->execute(); // execute sql statement
     
          return $toCreate;
      }     

public function create_order() {
     $pdo = connect();

     $sql = "INSERT INTO orders (OrderId, CustomersId, Date)
             VALUES ('" . $this->{"OrderId"} . "', '" . $this->{"CustomersId"} . "', NOW())"; // sql statements

     $toCreate = $pdo->prepare($sql); // prepared statement
     $toCreate->execute(); // execute sql statement

     return $toCreate;
 }


public function get_order() {
     $pdo = connect();

     $sql = "SELECT O.OrderId, O.Date, 
     P.ProductName, PV.Size, OI.Quantity, P.Price 
     FROM orders AS O 
     JOIN orderitem AS OI ON OI.OrderId = O.OrderId 
     JOIN productvariations AS PV ON PV.PVId = OI.ProductvariationsId 
     JOIN products AS P ON P.ProductsId = PV.ProductId 
     WHERE OI.OrderId  = '" . $this->{"OrderId"} . "'" ;
        

     $toGet = $pdo->prepare($sql); // prepared statement
     $toGet->execute(); // execute sql statement

     return $toGet;

 }

 public function get_customerByorder() {
     $pdo = connect();

     $sql = "SELECT OrderId, Date, 
     C.Firstname, C.Lastname, C.Address, C.Zipcode, C.City 
     FROM orders AS O 
     JOIN customers AS C ON C.CustomersId = O.CustomersId 
     WHERE OrderId  = '" . $this->{"OrderId"} . "'" ;
        

     $toGet = $pdo->prepare($sql); // prepared statement
     $toGet->execute(); // execute sql statement

     return $toGet;

 }

 public function get_lastOrder() {
      $pdo = connect();

      $sql = "SELECT OrderId FROM orders
      ORDER BY OrderId DESC
      LIMIT 1";

$toGet = $pdo->prepare($sql); // prepared statement
$toGet->execute(); // execute sql statement

return $toGet;

 }

 public function get_orderItem() {
     $pdo = connect();

     $sql = "SELECT * FROM orderitem
     WHERE OrderitemId  = '" . $this->{"OrderitemId"} . "'" ;
        

     $toGet = $pdo->prepare($sql); // prepared statement
     $toGet->execute(); // execute sql statement

     return $toGet;

 }
}
?>