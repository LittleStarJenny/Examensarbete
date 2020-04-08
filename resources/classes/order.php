<?php

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
        C.Firstname, C.Lastname, C.Address, C.Zipcode, C.City, C.Mail
        FROM orders AS O 
        JOIN customers AS C ON C.CustomersId = O.CustomersId 
        WHERE OrderId  = '" . $this->{"OrderId"} . "'" ;


        $toGet = $pdo->prepare($sql); // prepared statement
        $toGet->execute(); // execute sql statement

        return $toGet;
    }

    public function get_customerOrder() {
        $pdo = connect();

        $sql = "SELECT * from orders
        WHERE CustomersId  = '" . $this->{"CustomersId"} . "'" ;


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

    public function get_lastOrderByCustomer() {
        $pdo = connect();

        $sql = "SELECT * FROM orders
        WHERE CustomersId  = '" . $this->{"CustomersId"} . "' 
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

    public function get_all_orders_fromNewest() {
        $pdo = connect();

        $sql = "SELECT O.OrderId, O.Date, O.CustomersId,
        P.ProductName, PV.Size, OI.Quantity, P.Price 
        FROM orders AS O 
        JOIN orderitem AS OI ON OI.OrderId = O.OrderId 
        JOIN productvariations AS PV ON PV.PVId = OI.ProductvariationsId 
        JOIN products AS P ON P.ProductsId = PV.ProductId 
        GROUP BY OrderId
        ORDER BY Date DESC" ;


        $toGet = $pdo->prepare($sql); // prepared statement
        $toGet->execute(); // execute sql statement

        return $toGet;
    }  

}
?>