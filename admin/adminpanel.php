<?php if($_SESSION['Admin'] != "") { ?>
<main>
    <h3 class="adminpanel-title">Hej <?php echo $_SESSION["Name"]; ?></h3>
    <nav class="admin-nav">
        <a href="http://localhost/Stellasina/skapa-admin">Skapa Användare</a>
        <a href="http://localhost/Stellasina/skapa-produkt">Skapa Produkt</a>
        <a href="http://localhost/Stellasina/kunder">Ändra kundinfo</a>
        <a href="http://localhost/Stellasina/orders">Kundorder</a>
    </nav>
</main>
<?php } else { ?>
    <main>
        <span>Du har ingen behörighet att se det här. Logga in först?!</span>
    </main>
<?php } ?>
