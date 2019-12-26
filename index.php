<?php 
include_once "header.php";
// include_once "dbo.php";
$pdo = connect();
$limit = 20;
$offset = 0;
$stmt = get_all_products($pdo, $limit, $offset);

$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    
<main>
    <section class="product-container">
        <?php foreach($rows as $row) { ?>
        <div class="product-card">
            <img class="product-image" src="<?php echo $row['Img'];?>" >
            <h2 class="title"><?php echo $row['ProductName']; ?></h2>
            <span class="price"><?php echo $row['Price'];?></span><span>:-</span>
            <a href="product-detail.php?product=<?php echo $row['productsId']; ?>"><button class="readmore">Läs mer</button></a>

        </div>
        <?php } ?> 
    </section>
</main>
</body>
<?php
include_once "footer.php"?>