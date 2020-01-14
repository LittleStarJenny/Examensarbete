<?php 
include_once "header.php";

 

// if (isset($_POST['search'])) {
//     $search = $_POST['search'];
//     $data1 = []; 

//     // prepares the dtaabase.. if the statement is true we'll get the wanted info otherwise the message will appear.
//     $stmt = $pdo->prepare("SELECT * FROM customers WHERE Birthday LIKE '$search'");
//     if($stmt->execute()) {
//         if($stmt->rowCount() > 0) { 
//             while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
//                 $data1[] = $row; 
//             }
//         } else {        
//             $message = "No orders found!";
//         }
//     }
// }
// $query = $pdo->prepare("SELECT * FROM customers "); 
//     if($query->execute()) { 
//             while($row = $query->fetch(PDO::FETCH_ASSOC)) {
//                 $data[] = $row;
//             }
//         }
    
//     // $customers->create_customer(); 
?>




   

                 
<?php 
$customer = New Customer;
$Birthday = $_POST['Birthday'];

    if(isset($_POST["Birthday"])) {
        // if($customer->Birthday == $_POST["Birthday"]) {
            // get CustomersId
            // if(isset($_GET['customer'])) {
                $customer->Birthday = $Birthday;
                $result = $customer->get_customer();
                $test = $result->fetch();
                     $row = $test;
                    var_dump($test);
            // } else {
            //     $customer->CustomersId = $_POST['CustomersId'];
            //     $result = $customer->create_customer();
            // }

            // }

        }
    

  

        ?>
        <main class="checkout">
    <div class="checkout-wrap">
<table class="cart-table">
<form method="post" action="checkout.php">
<input type ="hidden" name="CustomersId" value="<?php echo $row['CustomersId'] ?>">
<span>Personnr: (YYYY-MM-DD) </span>    
<input text name="Birthday" placeholder=""> 
<input type="submit" name="submit" value="Hämta adress"/>
<span>Förnamn</span>    
<input text name="Firstname" value="<?php echo $row['Firstname']; ?>">
<span>Efternamn</span>    
<input text name="Lastname" value="<?php echo $row['Lastname']; ?>">
<span>Adress</span>    
<input text name="Address" value="<?php echo $row['Address']; ?>">
<span>Postnr</span>    
<input text name="Zipcode" value="<?php echo $row['Zipcode']; ?>">
<span>Postadress</span>    
<input text name="City" value="<?php echo $row['City']; ?>">
<span>Mail</span>    
<input text name="Mail" value="<?php echo $row['Mail']; ?>">
<span>Telefon</span>    
<input text name="Phone" value="<?php echo $row['Phone']; ?>">
</form>
