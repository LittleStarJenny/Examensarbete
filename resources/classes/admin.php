<?php 
class Admin {

    public $adminId = 0;
    public $username = '';
    public $Firstname = '';
    public $Password = '';


    public function create_admin() {
        $pdo = connect();

        $sql = "INSERT INTO admins (username, Firstname, Password)
        VALUES ('" . $this->{"username"} . "', '" . $this->{"Firstname"} . "', '" . $this->{"Password"} . "')"; // sql statements

        $toCreate = $pdo->prepare($sql); // prepared statement
        $toCreate->execute(); // execute sql statement

        return $toCreate;
    }

    public function admin_login($username, $Password) {
        $pdo = connect();

        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username=:username ");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0) {

            if(password_verify($Password, $row['Password'] )) {

                $this->username = $username;
                $this->Password = $Password;

                session_regenerate_id();
                $_SESSION['Admin'] = $row['username'];
                $_SESSION['Name'] = $row['Firstname'];
                session_write_close();
                header('location:home');
                $err_message = 'Konto skapat, nu är det bara att bekräfta ditt köp';
            } else {
                $err_message = 'Fel lösenord';
            }
        } 
        else $err_message = 'Fel mail';
    }

}

?>