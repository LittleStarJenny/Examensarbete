<?php 
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

    public function get_all_products() {
        $pdo = connect();

        $sql = "SELECT * FROM products"; // sql statementS

        $toGet = $pdo->prepare($sql); // prepared statement
        $toGet->execute(); // execute sql statment

        return $toGet;
    }

    public function create_product() {
        $pdo = connect();

        $sql = "INSERT INTO products (ProductName, Description, Price, Color, Img, CategoryId)
        VALUES ('" . $this->{"ProductName"} . "', '" . $this->{"Description"} . "', '" . $this->{"Price"} . "', '" . $this->{"Color"} . "', '" . $this->{"Img"} . "', '" . $this->{"CategoryId"} . "')"; // sql statements

        $toCreate = $pdo->prepare($sql); // prepared statement
        $toCreate->execute(); // execute sql statement

        return $toCreate;
    }


    // ProductVariations
    public $ProductId = 0;
    public $Size = '';

    public function get_productvariation() {
        $pdo = connect();

        $sql = "SELECT * 
        FROM productvariations  as PV
        JOIN products AS P ON PV.ProductId = P.ProductsId
        JOIN sizechart as S on PV.Size = S.SizeId
        WHERE ProductId = '" . $this->{"ProductId"} . "'"; // sql statementS

        $toGet = $pdo->prepare($sql); // prepared statement
        $toGet->execute(); // execute sql statement

        return $toGet;
    }

    public function create_productvariation() {
        $pdo = connect();

        $sql = "INSERT INTO productvariations (Size, ProductId)
        VALUES ('" . $this->{"Size"} . "', '" . $this->{"ProductId"} . "')"; // sql statements

        $toCreate = $pdo->prepare($sql); // prepared statement
        $toCreate->execute(); // execute sql statement

        return $toCreate;
    }

    public function get_sizeIdforProductvariation() {
        $pdo = connect();

        $sql = "SELECT * FROM sizechart
        WHERE Size = '" . $this->{"Size"} . "'"; // sql statementS

        $toGet = $pdo->prepare($sql); // prepared statement
        $toGet->execute(); // execute sql statement

        return $toGet;
    }

    public function get_productvariationForOrder() {
        $pdo = connect();

        $sql = "SELECT PVId FROM productvariations
        WHERE Size = '" . $this->{"Size"} . "'
        AND ProductId = '" . $this->{"ProductId"} . "'"; // sql statementS

        $toGet = $pdo->prepare($sql); // prepared statement
        $toGet->execute(); // execute sql statement

        return $toGet;
    }

    public function get_productsBycategory() {
        $pdo = connect();

        $sql = "SELECT * FROM categorys as C
        JOIN products AS P ON P.CategoryId = C.CategoryId
        WHERE C.CategoryName = '" . $this->{"CategoryName"} . "'"; // sql statementS

        $toGet = $pdo->prepare($sql); // prepared statement
        $toGet->execute(); // execute sql statement

        return $toGet;
    } 

    // Category
    public $CategoryId = 0;
    public $Categoryname = '';

    public function get_category() {
        $pdo = connect();

        $sql = "SELECT * FROM categorys
        WHERE CategoryName = '" . $this->{"CategoryName"} . "'"; // sql statementS

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


    // Images
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


    // Sizechart
    public $SizeId = 0;

    public function get_sizechart() {
        $pdo = connect();

        $sql = "SELECT * FROM sizechart"; // sql statementS

        $toGet = $pdo->prepare($sql); // prepared statement
        $toGet->execute(); // execute sql statement

        return $toGet;
    } 

    public function get_sizechartById() {
        $pdo = connect();

        $sql = "SELECT * FROM sizechart
        WHERE SizeId = '" . $this->{"SizeId"} . "'"; // sql statementS

        $toGet = $pdo->prepare($sql); // prepared statement
        $toGet->execute(); // execute sql statement

        return $toGet;
    } 

}
?>