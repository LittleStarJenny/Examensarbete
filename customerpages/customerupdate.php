<?php 

// session_start();
// var_dump($_SESSION);
$message = '';
$customer = New Customer;
$customer->Mail = $_SESSION['Mail'];
$result = $customer->get_customer();
$row = $result->fetch(); 

if(isset($_POST['save'])) {
    $CustomersId = filter_input(INPUT_POST, 'CustomersId', FILTER_SANITIZE_MAGIC_QUOTES);
    $Firstname = filter_input(INPUT_POST, 'Firstname', FILTER_SANITIZE_STRING);
    $Lastname = filter_input(INPUT_POST, 'Lastname', FILTER_SANITIZE_STRING);
    $Birthday = filter_input(INPUT_POST, 'Birthday', FILTER_SANITIZE_STRING);
    $Address = filter_input(INPUT_POST, 'Address', FILTER_SANITIZE_STRING);
    $Zipcode = filter_input(INPUT_POST, 'Zipcode', FILTER_SANITIZE_STRING);
    $City = filter_input(INPUT_POST, 'City', FILTER_SANITIZE_STRING);
    $Mail = filter_input(INPUT_POST, 'Mail', FILTER_SANITIZE_STRING);
    $Phone = filter_input(INPUT_POST, 'Phone', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_MAGIC_QUOTES);
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
    $customer->Firstname = $Firstname;

    $customer->Lastname = $Lastname;
    $customer->Birthday = $Birthday;
    $customer->Address  = $Address;
    $customer->Zipcode = $Zipcode;
    $customer->City = $City;
    $customer->Mail = $Mail;
    $customer->Phone = $Phone;
    $customer->Password = $passwordHashed;
    $customer->CustomersId = $CustomersId;
    $return = $customer->update_customer();


 if($return){
      header('location:customerstart');
        $message = 'Dina uppgifter är sparade';
        }
    }
?>

<main id="customer-pages">
<span><?php echo $message;?></span>
<h3> Välkommen <?php echo $row['Firstname']; echo " "; echo $row['Lastname']; ?>!</h3>
<input type ="hidden" name="CustomersId" value="<?php echo $row['CustomersId'] ?>">
<span><?php echo $message; ?></span>
   

<!-- Update Customer -->
<div class="updateCustomer">
<a class="back-btn" href="customerstart">Tillbaka</a>      
<form method="post" action="">
<h4>Uppdatera uppgifter</h4>
<div class="CustomerInfo"> 
<input type ="hidden" name="CustomersId" value="<?php echo $row['CustomersId'] ?>">
<br><span>Förnamn</span> 
<input text name="Firstname" pattern="[a-zåäöA-ZÅÄÖ]+"  value="<?php if(isset($row['Firstname'])) { echo $row['Firstname']; } ?>">
<span>Efternamn</span>     
<input text name="Lastname" value="<?php if(isset($row['Lastname'])) { echo $row['Lastname']; } ?>">
<span>Adress</span>    
<input text name="Address" pattern="[a-zåäöA-ZÅÄÖ0-9\s]+"  value="<?php if(isset($row['Address'])) { echo $row['Address']; } ?>">
<span>Postnr</span>    
<input tel name="Zipcode" pattern="[0-9]{3} [0-9]{2}" value="<?php if(isset($row['Zipcode'])) { echo $row['Zipcode']; } ?>">
<span>Postadress</span>    
<input text name="City" pattern="[a-zåäöA-ZÅÄÖ]+" value="<?php if(isset($row['City'])) { echo $row['City']; } ?>">
<span>Mobil</span>    
<input tel name="Phone" pattern="[0-9]{3}-[0-9]{3} [0-9]{2} [0-9]{2}" value="<?php if(isset($row['Phone'])) { echo $row['Phone']; } ?>">
<span>Mail</span>
<input mail name="Mail" required placeholder="your@email.com" value="<?php if(isset($row['Mail'])) { echo $row['Mail']; } ?>">
<input class="standard-btn" type="submit" name="save" value="Spara">
</div> 
</form> 
</div>