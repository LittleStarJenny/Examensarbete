<?php 
include_once "header.php";

$pdo = connect();
$limit = 20;
$offset = 0;
$stmt = get_all_products($pdo, $limit, $offset);

$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    
<main>
    <div class="sidebar">
        <h3>Kategorier</h3>
</div>
    <section class="product-container">
        <?php foreach($rows as $row) { ?>
        <div class="product-card">
            <img class="product-image" src="<?php echo $row['Img'];?>" >
            <h2 class="title"><?php echo $row['ProductName']; ?></h2>
            <span class="price"><?php echo $row['Price'];?></span><span>:-</span>
        </div>
        <?php } ?> 
    </section>
</main>
</body>
<?php
include_once "footer.php"?>