<?php  
include_once '../../resources/config.php';

    if(isset($_POST['CustomersId'])) {
    $pdo = connect();
     $output = '';  
    
     $result = $pdo->prepare("SELECT * FROM customers
     WHERE CustomersId = '".$_POST["CustomersId"]."'");  
            $result->execute(); // execute sql statment
             while($row = $result->fetch()) {
                $output .= '<form method="post" action="">
                        <h4>Uppdatera uppgifter</h4>
                        <span><?php echo $message; ?></span>
                        <div class="CustomerInfo"> 
                        <br><span>Förnamn</span> 
                        <input text name="Firstname" pattern="[a-zåäöA-ZÅÄÖ]+"  value="'.$row['Firstname'].'">';
                $output .= '<span>Efternamn</span>     
                    <input text name="Lastname" value="'.$row['Lastname'].'">';
                $output .= '<span>Adress</span>    
                    <input text name="Address" pattern="[a-zåäöA-ZÅÄÖ0-9\s]+"  value="'.$row['Address'].'">';
                $output .= '<span>Postnr</span>    
                    <input tel name="Zipcode" pattern="[0-9]{3} [0-9]{2}" value="'.$row['Zipcode'].'">';
                $output .= '<span>Postadress</span>    
                    <input text name="City" pattern="[a-zåäöA-ZÅÄÖ]+" value="'.$row['City'].'">';
                $output .= '<span>Mobil</span>    
                    <input tel name="Phone" pattern="[0-9]{3}-[0-9]{3} [0-9]{2} [0-9]{2}" value="'.$row['Phone'].'">';
                $output .= '<span>Mail</span>
                    <input mail name="Mail" required placeholder="your@email.com" value="'.$row['Mail'].'">';
                $output .= '<span>Lösenord</span>
                    <input type="password" name="Password">
                    <input class="standard-btn" type="submit" name="save" value="Spara">
                    </div> 
                </form> ';

             echo $output;
             }
}  
?>