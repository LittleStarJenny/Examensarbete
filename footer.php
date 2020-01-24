<div class='cart-content'>
    <h2>Min varukorg</h2>
<div class="productsIncart">
<?php  
if(empty($cart_data)) {
    echo $message = 'Varukorgen är tom';
  } else {
foreach($cart_data as $keys => $values){ 
    $rowtotal = $values['Price'] * $values['quantity'];
      $total += $rowtotal; ?>
    <img class="cart-img" src=<?php echo $values['Img'] ?>>
    <div class="cart-text-content">
        <span class='cart-prod-prize'><?php echo $values['Price']; ?> SEK </span>
        <span class="title"><?php echo $values['ProductName']; ?></span>
            <div class="cartRow">
                <span class="cart-prod-size">Storlek <?php echo $values['Size']; ?></span>
                <span class="cart-prod-qty">Antal <?php echo $values["quantity"]?></span>
            </div>
</div>

    <hr>
    <?php  
} 
} 
?>  
    </div>
    <div class="cartSum">
        <span class="total">Totalsumma <?php echo $total ?> SEK</span>
    </div>
    <div class='btn-wrap'>
        <a href="cart"><div class='shopping-btn'>Till varukorgen</div></a>
        <a href="checkout"><div class='shopping-btn'>Gå till kassan</div></a>
    </div>
</div>
  
  <footer>
<ul>
    <li>Köpvillkor</li>
    <li>Kontakt</li>
</ul>
</footer>
  
  </body>
</html>