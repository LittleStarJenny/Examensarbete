<?php
class Customer {

    public $CustomersId = 0;
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

    public function get_customerById() {
        $pdo = connect();

        $sql = "SELECT * FROM customers" ;


        $toGet = $pdo->prepare($sql); // prepared statement
        $toGet->execute(); // execute sql statement

        return $toGet;
    }

    public function update_customer() {
        $pdo = connect();

        $sql = "UPDATE customers
        SET Firstname = '" . $this->{"Firstname"} . "', Lastname = '" . $this->{"Lastname"} . "', 
        Address = '" . $this->{"Address"} . "', 
        Zipcode = '" . $this->{"Zipcode"} . "', City = '" . $this->{"City"} . "', 
        Mail = '" . $this->{"Mail"} . "', Phone = '" . $this->{"Phone"} . "', Password = '" . $this->{"Password"} . "'
        WHERE CustomersId = '" . $this->{"CustomersId"} . "'"; // sql statements

        $toSave = $pdo->prepare($sql); // prepared statement
        $return = $toSave->execute(); // execute sql statment

        return $return;
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

        $sql = "INSERT INTO customers (CustomersId, Firstname, Lastname, Address, Zipcode, City, Mail, Phone, Password)
        VALUES ('" . $this->{"CustomersId"} . "', '" . $this->{"Firstname"} . "', '" . $this->{"Lastname"} . "', '" . $this->{"Address"} . "', '" . $this->{"Zipcode"} . "', '" . $this->{"City"} . "', '" . $this->{"Mail"} . "', '" . $this->{"Phone"} . "', '" . $this->{"Password"} . "')"; // sql statements

        $toCreate = $pdo->prepare($sql); // prepared statement
        $toCreate->execute(); // execute sql statement

        return $toCreate;
    }

    public function login($Mail, $Password) {
        $pdo = connect();

        // var_dump($Password);
        $stmt = $pdo->prepare("SELECT * FROM customers WHERE Mail=:Mail ");
        $stmt->bindParam(':Mail', $Mail);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0) {

            if(password_verify($Password, $row['Password'] )) {
                $this->Mail = $Mail;
                $this->Password = $Password;

                session_regenerate_id();
                $_SESSION['authorized'] = true;
                $_SESSION['Mail'] = $row['Mail'];
                $_SESSION['Firstname'] = $row['Firstname'];
                session_write_close();
                header('location:customerstart');
                $message = 'Konto skapat, nu är det bara att bekräfta ditt köp';
            } else {
           
                echo $message = '<div class="Message"><div>Ditt lösenord är fel, försök igen</div></div>';
            }
        } 
        else echo $message = '<div class="Message"><div>Kolla om du angett rätt Mail</div></div>';
    }


    public function loginFromCheckout($Mail, $Password) {
        $pdo = connect();

        // var_dump($Password);
        $stmt = $pdo->prepare("SELECT * FROM customers WHERE Mail=:Mail ");
        $stmt->bindParam(':Mail', $Mail);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0) {

            if(password_verify($Password, $row['Password'] )) {
                $this->Mail = $Mail;
                $this->Password = $Password;

                session_regenerate_id();
                $_SESSION['authorized'] = true;
                $_SESSION['Mail'] = $row['Mail'];
                $_SESSION['Firstname'] = $row['Firstname'];
                session_write_close();
                header('location:checkout');
                $err_message = 'Konto skapat, nu är det bara att bekräfta ditt köp';
            } else {
                //    header('locaton:customerlogin.php');
                $err_message = 'Fel lösenord';
            }
        } 
        else $err_message = 'Fel mail';
    }

} 
?>