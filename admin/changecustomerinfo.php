<?php 
// include_once '../resources/functions/fill_customerinfo.php';
include_once 'adminheader.php';
$message = '';
$customer = New Customer;
$pdo = connect();

// Update customerinfo
if(isset($_POST['save'])) {
    $CustomersId = filter_input(INPUT_POST, 'selectCustomerId', FILTER_SANITIZE_MAGIC_QUOTES);
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


    if($return) {
         $message = 'Dina uppgifter är sparade';
    } else {
        $message = 'Något gick fel, försök igen';
    }
}

if($_SESSION['Admin'] != "") { ?> 
<main id="customer-pages">
    <div class="updateCustomer">
        <a class="back-btn" href="home">Tillbaka</a>
        <form method="post" action="">
            <h4>Uppdatera uppgifter</h4>
            <span><?php echo $message; ?></span>
            <div class="CustomerInfo"> 
                <select class="CustomerId" name="selectCustomerId"> 
                    <?php 
                    // Get all customerId:s in a dropdown and fetch info on change from ajax and file function_fillcustomerinfo.php
                    $Id = $customer->get_customerById();
                    $customerId = $Id->fetchAll();
                        foreach ($customerId as $Idrow) { ?>
                        <option value="<?php echo $Idrow['CustomersId'];?>">
                            <?php echo $Idrow['CustomersId']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div id="results"></div>
        </form>
    </div>
</main>
<?php } else { ?>
    <main>
        <span>Du har ingen behörighet att se det här. Logga in först?!</span>
    </main>
<?php } ?>
